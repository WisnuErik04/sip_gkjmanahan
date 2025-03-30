<?php

namespace App\Filament\Resources\TindakLanjutResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Role;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AgendaJenis;
use Illuminate\Support\Str;
use App\Models\AgendaDetail;
use App\Models\Verification;
use App\Models\RequestStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\VerificationStatus;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Resources\Components\Tab;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AgendaDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'agendaDetails';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Surat')
                    ->schema([
                        TextInput::make('no_surat')
                            ->label('Nomor Surat')
                            ->maxLength(255)
                            ->required(),

                        TextInput::make('dari')
                            ->label('Dari')
                            ->maxLength(255)
                            ->required(),

                        DatePicker::make('tanggal_masuk')
                            ->label('Tanggal Masuk')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make('Detail Agenda')
                    ->schema([
                        // Select::make('agenda_id')
                        //     ->label('Agenda')
                        //     ->options(Agenda::pluck('tgl_rapat', 'id'))
                        //     ->required()
                        //     ->searchable()
                        //     ->preload()
                        //     ->createOptionForm([
                        //         DatePicker::make('tgl_rapat')->required(),
                        //     ])

                        Select::make('jenis_id')
                            ->label('Jenis Agenda')
                            ->relationship('agendaJenis', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('keterangan_id')
                            ->label('Keterangan Agenda')
                            ->relationship('agendaKeterangan', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),

                Section::make('Keterangan Tambahan')
                    ->schema([
                        Textarea::make('perihal')
                            ->label('Perihal')
                            ->required(),

                        Textarea::make('usulan_keputusan')
                            ->label('Usulan Keputusan')
                            ->nullable(),
                    ]),

            ]);
    }

    public function getTabs(): array
    {
        $parentId = $this->ownerRecord->id;
        $tabs = [
            'Semua' => Tab::make(),
        ];

        $jenisList = AgendaJenis::all();

        $counts = AgendaDetail::where('agenda_id', $parentId)
        ->selectRaw('jenis_id, COUNT(*) as total')
        ->groupBy('jenis_id')
        ->pluck('total', 'jenis_id');

        foreach ($jenisList as $jenis) {
            $tabs[Str::slug($jenis->name)] = Tab::make()
                ->label($jenis->name)
                ->modifyQueryUsing(fn(Builder $query) => $query->where('jenis_id', $jenis->id))
                // ->badge(fn() => AgendaDetail::query()->where('jenis_id', $jenis->id)
                //     ->where('agenda_id', $parentId)
                //     ->count()
                // )
                ->badge($counts[$jenis->id] ?? 0); // Ambil dari hasil query sebelumnya
            ;
        }

        return $tabs;
    }

    public function table(Table $table): Table
    {
        
        return $table
            ->recordTitleAttribute('no_surat')
            ->columns([

    //             Tables\Columns\TextColumn::make('request.requestStatus.name')
    // ->label('Status Permohonan')
    // ->sortable()
    // ->searchable()
    // ->formatStateUsing(fn ($record) => optional($record->request?->requestStatus)->name ?? '-'),
                Tables\Columns\TextColumn::make('no_surat')->sortable(),
                Tables\Columns\TextColumn::make('dari')
                    ->label('Dari / Tanggal Masuk')
                    ->formatStateUsing(fn($record) => "{$record->dari} / ". \Carbon\Carbon::parse($record->tanggal_masuk)->locale('id')->translatedFormat('d F Y'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('usulan_keputusan')->label('Usulan Keputusan'),
                Tables\Columns\TextInputColumn::make('hasil_keputusan')->label('Hasil Keputusan'),
                Tables\Columns\TextColumn::make('agendaKeterangan.name')->label('Ket'),
                // Tables\Columns\TextColumn::make('dari')
                //     ->summarize(Count::make()->label('Total')),
            ])
            ->groups([
                Group::make('agendaJenis.name')
                    ->label('Jenis Agenda'),
            ])
            ->filters([
                Filter::make('tanggal_masuk')
                    ->form([
                        DatePicker::make('tanggal_masuk_dari'),
                        DatePicker::make('tanggal_masuk_hingga'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tanggal_masuk_dari'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_masuk', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_masuk_hingga'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_masuk', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['tanggal_masuk_dari'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan dari ' . Carbon::parse($data['tanggal_masuk_dari'])->toFormattedDateString())
                                ->removeField('tanggal_masuk_dari');
                        }

                        if ($data['tanggal_masuk_hingga'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan hingga ' . Carbon::parse($data['tanggal_masuk_hingga'])->toFormattedDateString())
                                ->removeField('tanggal_masuk_hingga');
                        }

                        return $indicators;
                    })
            ])

            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Action::make('Export PDF')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->exportToPdf())
                    ->color('info'),

                Action::make('Export Excel')
                    ->label('Excel')
                    ->url(fn ($record) => route('laporan.pleno.excel', $this->ownerRecord->id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success'),
            
                // Action::make('Export CSV')
                //     ->label('Cetak CSV')
                //     ->icon('heroicon-o-arrow-down-tray')
                //     ->action(fn() => $this->exportToCsv())
                //     ->color('success'),
            ])
            // ->actions([
            //     // Tables\Actions\EditAction::make(),
            //     Tables\Actions\Action::make('approve')
            //         ->form([
            //             Forms\Components\ToggleButtons::make('verification_status_id')
            //                 ->label('Status Permohonan')
            //                 ->options(VerificationStatus::pluck('name', 'id'))
            //                 ->colors(VerificationStatus::all()->mapWithKeys(function ($status) {
            //                     return [$status->id => match ($status->name) {
            //                         'Disetujui' => 'success',
            //                         'Ditolak' => 'danger',
            //                         default => 'gray',
            //                     }];
            //                 }))
            //                 ->inline()
            //                 ->required(),
            //             Forms\Components\Textarea::make('keterangan')
            //                 ->label('Keterangan')
            //                 ->placeholder('Tambahkan catatan jika diperlukan'),
            //         ])
            //         ->action(function (array $data, Request $record) {
            //             // Simpan ke tabel `verifications`
            //             Verification::create([
            //                 'request_id' => $record->id,
            //                 'verification_status_id' => $data['verification_status_id'],
            //                 'user_id' => auth()->user()->id,
            //                 'notes' => $data['keterangan'],
            //                 'approved_by' => auth()->user()->name,
            //             ]);
            //             $sendEmail = 'n';
            //             $verifName = VerificationStatus::where('id', $data['verification_status_id'])->pluck('name')->first();
            //             if ($verifName == 'Disetujui') {
            //                 $requestStatusUpdate = RequestStatus::where('name', 'Disetujui')->pluck('id')->first();
            //             } else {
            //                 // DITOLAK
            //                 $requestStatusUpdate = RequestStatus::where('name', $verifName)->pluck('id')->first();
            //             }
            //             // Update status permohonan
            //             $record->update([
            //                 'request_status_id' => $requestStatusUpdate,
            //             ]);

                       
            //         })
            //         ->label('Verifikasi')
            //         ->icon('heroicon-m-ellipsis-vertical')
            //         ->size(ActionSize::Medium)
            //         ->color('primary')
            //         ->button(),
            //     Tables\Actions\DeleteAction::make(),
            // ])
            

            ->actions([

                Tables\Actions\Action::make('approve')
                    ->label('Permohonan')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Medium)
                    ->color('primary')
                    ->button()
                    ->form([
                        Forms\Components\ToggleButtons::make('verification_status_id')
                            ->label('Status Permohonan')
                            ->options(VerificationStatus::pluck('name', 'id')->toArray())
                            ->colors(VerificationStatus::all()->mapWithKeys(fn($status) => [
                                $status->id => match ($status->name) {
                                    'Disetujui' => 'success',
                                    'Ditolak' => 'danger',
                                    default => 'gray',
                                }
                            ])->toArray())
                            ->inline()
                            ->required(),
                        Forms\Components\Textarea::make('keterangan')
                            ->label('Keterangan')
                            ->placeholder('Tambahkan catatan jika diperlukan'),
                    ])
                    ->action(function (array $data, $record) {
                        // Simpan data verifikasi
                        Verification::create([
                            'request_id' => $record->request_id,
                            'verification_status_id' => $data['verification_status_id'],
                            'user_id' => auth()->user()->id,
                            'notes' => $data['keterangan'],
                            'approved_by' => auth()->user()->name,
                        ]);
            
                        // Tentukan status permohonan
                        $verifName = VerificationStatus::where('id', $data['verification_status_id'])->value('name');
            
                        $requestStatusUpdate = ($verifName === 'Disetujui')
                            ? RequestStatus::where('name', 'Disetujui')->value('id')
                            : RequestStatus::where('name', $verifName)->value('id');
            
                        // Update status permohonan
                        $record->request->update([
                            'request_status_id' => $requestStatusUpdate,
                        ]);
                    })
                    ->visible(fn ($record) => 
                        !is_null($record->request_id) && 
                        $record->request->requestStatus->name === 'Agenda' // Hanya muncul jika request masih "Pending"
                    ),
                    
                // Tables\Actions\DeleteAction::make(),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
            
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function exportToPdf()
    {
        
        $parentId = $this->ownerRecord->id;
        $agenda = Agenda::findOrFail($parentId);
        $records = AgendaDetail::where('agenda_id', $parentId)
                    ->get()
                    ->groupBy('agendaJenis.name');

        // dd($records);
        $pdf = Pdf::loadView('pdf.tindak_lanjut', compact('agenda', 'records'));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Hasil_rapat_' . Carbon::parse($agenda->tgl_rapat)->format('Y-m-d'). '.pdf'
        );
    }

}
