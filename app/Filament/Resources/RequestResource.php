<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Request;
use Filament\Forms\Form;
use App\Models\UploadFile;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v2;
use App\Models\FormPertanyaan;
use App\Models\ListUploadForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;

use Filament\Forms\Components\View;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\RequestResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RequestResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Hugomyb\FilamentMediaAction\Forms\Components\Actions\MediaAction;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    public static function getNavigationLabel(): string
    {
        return 'Daftar Pengajuan';
    }
    public static function getPluralLabel(): string
    {
        return 'Daftar Pengajuan';
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Form Permohonan';
    protected static ?int $navigationSort = 1;

    
    // public static function resolveRecord($record)
    // {
    //     $record->loadMissing(['requestStatus', 'form']);
    //     return $record;
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pemohon ')
                    ->description('Data diri pemohon')
                    ->schema([
                        Forms\Components\TextInput::make('pemohon_nama')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pemohon_hp_telepon')
                            ->tel()
                            ->label('No Hp/telepon')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pemohon_email')
                            ->email()
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pemohon_warga_blok')
                            ->label('Warga blok')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('pemohon_alamat')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Select::make('form_id')
                    ->label('Jenis Permohonan')
                    ->relationship('form', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive(), // Agar bisa mendeteksi perubahan langsung di form

                Forms\Components\Select::make('request_status_id')
                    ->label('Status')
                    // ->options(fn () => \App\Models\RequestStatus::pluck('name', 'id'))
                    ->relationship('requestStatus', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Forms\Components\Section::make('Cetak Formulir')
                    ->schema([
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('view_form')
                                ->label('View Form')
                                ->url(fn ($get) => route('file.viewForm', ['id' => $get('id')]))
                                // ->url(fn ($get) => Storage::url($get('form_file_path')))
                                ->openUrlInNewTab(),
    
                            Forms\Components\Actions\Action::make('view_form')
                                ->label('Download')
                                ->color('success')
                                ->url(fn ($get) => route('file.downloadForm', ['id' => $get('id')]))
                                ->openUrlInNewTab(false),
                        ]),
                    ]),
                
                // Action::make('Export PDF')
                //     ->label('PDF')
                //     ->icon('heroicon-o-arrow-down-tray')
                //     ->action(fn() => $this->exportToPdf())
                //     ->color('info'),
                // Forms\Components\Section::make('Dokumen yang Diupload')
                //     ->schema(function (Forms\Get $get) {
                //         $formId = $get('form_id');
                //         if (!$formId) return [];

                //         $listUploads = ListUploadForm::where('form_id', $formId)->get();
                //         $isViewMode = !is_null($get('id')); // Cek apakah sedang dalam mode View/Edit

                //         return $listUploads->map(function ($upload) use ($get, $isViewMode) {
                //             $existingFile = UploadFile::where('request_id', $get('id'))
                //                 ->where('list_upload_form_id', $upload->id)
                //                 ->first();
                //             if ($isViewMode) {
                //                 if ($existingFile) {
                //                     $filePath = Storage::url($existingFile->file_path);

                //                     return [
                //                         Forms\Components\Actions::make([
                //                             Forms\Components\Actions\Action::make('download_' . $upload->id)
                //                                 ->label('View ' . $upload->name)
                //                                 ->url($filePath)
                //                                 // ->url(route('file.download', ['id' => $existingFile->id])) // Arahkan ke route
                //                                 ->openUrlInNewTab(),
                //                             Forms\Components\Actions\Action::make('download_' . $upload->id)
                //                                 ->label('Download')
                //                                 ->color('success')
                //                                 ->url(route('file.download', ['id' => $existingFile->id])) // Arahkan ke route
                //                                 ->openUrlInNewTab(false),
                //                         ]),


                //                     ];
                //                 } else {
                //                     return Forms\Components\Placeholder::make('no_file_' . $upload->id)
                //                         ->label($upload->name)
                //                         ->content('Tidak ada file yang diupload.');
                //                 }
                //             }

                //             // Jika dalam mode Create, tampilkan input untuk upload
                //             return Forms\Components\FileUpload::make('file_' . $upload->id)
                //                 ->label($upload->name)
                //                 ->directory('uploads/form_permohonan')
                //                 ->acceptedFileTypes($upload->upload_type === 'pdf' ? ['application/pdf'] : ['image/*'])
                //                 ->maxSize(2048) // 2MB
                //                 ->required($upload->is_required === true ? true : false);
                //         })->flatten()->toArray(); // Pakai flatten() agar array tidak bersarang
                //     })
                //     ->hidden(fn($get) => !$get('form_id')),

                Forms\Components\Section::make('Dokumen yang Diupload')
                    ->schema(function (Forms\Get $get) {
                        $formId = $get('form_id');
                        if (!$formId) return [];
                        $requestId = $get('id');
                        $isViewMode = !is_null($get('id')); // Cek apakah dalam mode View/Edit

                        // Ambil semua list upload yang berkaitan dengan form
                        $listUploads = ListUploadForm::where('form_id', $formId)
                            ->select(['id', 'name', 'upload_type', 'is_required']) // Pilih hanya kolom tertentu
                            ->get();

                        // Ambil semua file yang sudah diupload sekaligus, lalu index berdasarkan list_upload_form_id
                        $existingFiles = UploadFile::whereIn('request_id', [$requestId])
                            ->select(['file_path', 'id', 'list_upload_form_id']) // Pilih hanya kolom tertentu
                            ->get()
                            ->keyBy('list_upload_form_id'); // Gunakan keyBy agar pencarian lebih cepat
                    

                        return $listUploads->map(function ($upload) use ($existingFiles, $isViewMode) {
                            $existingFile = $existingFiles->get($upload->id); // Mengambil data dari koleksi, bukan query baru
                            
                            if ($isViewMode) {
                                if ($existingFile) {
                                    $filePath = Storage::url($existingFile->file_path);

                                    return Forms\Components\Actions::make([
                                        Forms\Components\Actions\Action::make('view_' . $upload->id)
                                            ->label('View ' . $upload->name)
                                            ->url(route('file.view', ['id' => $existingFile->id]))
                                            // ->url($filePath)
                                            ->openUrlInNewTab(),

                                        Forms\Components\Actions\Action::make('download_' . $upload->id)
                                            ->label('Download')
                                            ->color('success')
                                            ->url(route('file.download', ['id' => $existingFile->id]))
                                            ->openUrlInNewTab(false),
                                    ]);
                                } else {
                                    return Forms\Components\Placeholder::make('no_file_' . $upload->id)
                                        ->label($upload->name)
                                        ->content('Tidak ada file yang diupload.');
                                }
                            }

                            // Mode Create: Upload file baru
                            return Forms\Components\FileUpload::make('file_' . $upload->id)
                                ->label($upload->name)
                                ->directory('uploads/form_permohonan')
                                ->acceptedFileTypes($upload->upload_type === 'pdf' ? ['application/pdf'] : ['image/*'])
                                ->maxSize(2048)
                                ->required($upload->is_required);
                        })->toArray();
                    })
                    ->hidden(fn($get) => !$get('form_id')),

                // Forms\Components\TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['requestStatus', 'form']) // Tambahkan eager loading
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pemohon_nama')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pemohon_hp_telepon')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pemohon_email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pemohon_warga_blok')
                    ->label('Warga Blok/Pepanthan')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('form.name')
                    ->label('Jenis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('requestStatus.name')
                    ->label('Status')
                    ->sortable()
                    ->badge() // Mengaktifkan tampilan badge
                    ->color(fn($state) => match ($state ?? '') {
                        'Pengajuan' => 'gray',
                        'Diproses'  => 'warning',
                        'Disetujui' => 'success',
                        'Ditolak'   => 'danger',
                        'Agenda'   => 'info',
                        default     => 'secondary',
                    })
                    ->icon(fn($state) => match ($state) {
                        'Pengajuan' => 'heroicon-o-clock',
                        'Diproses'  => 'heroicon-o-arrow-path',
                        'Disetujui' => 'heroicon-o-check-circle',
                        'Ditolak'   => 'heroicon-o-x-circle',
                        default     => 'heroicon-o-question-mark-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->filters([
                SelectFilter::make('form')
                    ->label('Jenis')
                    ->relationship('form', 'name')
                    ->multiple()
                    ->preload(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('tgl_pengajuan_dari'),
                        DatePicker::make('tgl_pengajuan_hingga'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tgl_pengajuan_dari'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['tgl_pengajuan_hingga'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['tgl_pengajuan_dari'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan dari ' . Carbon::parse($data['tgl_pengajuan_dari'])->toFormattedDateString())
                                ->removeField('tgl_pengajuan_dari');
                        }

                        if ($data['tgl_pengajuan_hingga'] ?? null) {
                            $indicators[] = Indicator::make('Tgl pengajuan hingga ' . Carbon::parse($data['tgl_pengajuan_hingga'])->toFormattedDateString())
                                ->removeField('tgl_pengajuan_hingga');
                        }

                        return $indicators;
                    })

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('riwayatApproval')
                    ->label('Riwayat Approval')
                    ->icon('heroicon-o-document-text')
                    ->modalHeading('Riwayat Approval')
                    ->modalSubheading('Daftar approval yang telah dilakukan.')
                    ->modalContent(function ($record) {
                        return view('filament.modals.riwayat-approval', [
                            'verifications' => $record->verification()->with('verificationStatus')->get(),
                        ]);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            // 'view' => Pages\ViewRequest::route('/{record}'),
            // 'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }

    public function exportFormulirToPdf($formId)
    {
     
        $form = Request::where('form_id', $formId)->first();
        // Ambil pertanyaan dari form_pertanyaan
        $pertanyaans = FormPertanyaan::where('form_id', $formId)->get();
        $answers = json_decode($form->form_answers, true);

        // Tentukan template PDF
        // $view = $formId == 1 ? 'pdf.baptis' : 'pdf.nikah';
        $view = 'pdf.baptis';

        // Generate PDF
        $pdf = Pdf::loadView($view, compact('pertanyaans', 'answers'));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Formulir.pdf'
        );
    }
}
