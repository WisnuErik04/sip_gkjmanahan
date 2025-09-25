<?php

namespace App\Filament\Resources\AgendaResouceResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AgendaJenis;
use Illuminate\Support\Str;
use App\Models\AgendaDetail;
use App\Models\RequestStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Resources\Components\Tab;
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
                            ->relationship('agendaJenis', 'name', fn(Builder $query) => $query->orderBy('id', 'asc'))
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
                // Tables\Columns\TextColumn::make('no_surat')->sortable(),
                Tables\Columns\TextInputColumn::make('no_surat')->rules(['required', 'max:255'])->sortable()->searchable(),
                Tables\Columns\TextColumn::make('dari')
                    ->label('Dari / Tanggal Masuk')
                    ->formatStateUsing(fn($record) => "{$record->dari} / " . \Carbon\Carbon::parse($record->tanggal_masuk)->locale('id')->translatedFormat('d F Y'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('usulan_keputusan')->label('Usulan Keputusan'),
                Tables\Columns\TextColumn::make('agendaKeterangan.name')->label('Ket'),
                // Tables\Columns\TextColumn::make('dari')
                //     ->summarize(Count::make()->label('Total')),
            ])
            ->groups([
                Group::make('agendaJenis.name')
                    ->label('Jenis Agenda'),
            ])
            ->defaultSort('jenis_id', 'asc') // Mengurutkan berdasarkan tanggal terbaru
            ->defaultSort('no_surat', 'asc') // Mengurutkan berdasarkan tanggal terbaru
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
                Tables\Actions\CreateAction::make(),

                Action::make('Export PDF')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->exportToPdf())
                    ->color('info'),

                Action::make('Export Excel')
                    ->label('Excel')
                    ->url(fn($record) => route('laporan.agenda.excel', $this->ownerRecord->id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            ->sortBy(function ($agendaDetail) { // Di sini $agendaDetail muncul
                return optional($agendaDetail->agendaJenis)->id;
            })
            ->groupBy('agendaJenis.name');

        // dd($records);
        $pdf = Pdf::loadView('pdf.agenda_details', compact('agenda', 'records'));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Agenda_rapat_' . Carbon::parse($agenda->tgl_rapat)->format('Y-m-d') . '.pdf'
        );
    }
}
