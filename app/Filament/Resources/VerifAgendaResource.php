<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Role;
use Filament\Tables;
use App\Models\Agenda;
use App\Models\Request;
use Filament\Forms\Form;
use App\Models\UploadFile;
use Filament\Tables\Table;
use App\Models\AgendaJenis;
use App\Models\AgendaDetail;
use App\Models\Verification;
use App\Models\RequestStatus;
use App\Models\ListUploadForm;
use App\Services\FonnteService;
use App\Models\AgendaKeterangan;
use Filament\Resources\Resource;
use App\Mail\RequestStatusesMail;
use App\Models\Form as FormModel;
use App\Models\LevelVerification;
use App\Models\VerificationStatus;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Filters\Indicator;
use Filament\Forms\Components\Textarea;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VerifAgendaResource\Pages;
use App\Filament\Resources\VerifAgendaResource\RelationManagers;

class VerifAgendaResource extends Resource
{
    protected static ?string $model = Request::class;

    public static function getNavigationLabel(): string
    {
        return 'Agenda Rapat';
    }
    public static function getPluralLabel(): string
    {
        return 'Agenda Rapat';
    }

    protected static ?int $requestStatusAwal = null;
    protected static ?int $roleValidator1 = null;
    protected static function setRequestStatusAwal(): void
    {
        $role_id = auth()->user()->role_id;
        $verifikator = Role::select('name', 'level_verification_id')->with(['levelVerification' => function ($query) {
            $query->select('id', 'order');
        }])->where('id', $role_id)->first();

        $levelValidator = $verifikator->levelVerification->order ?? null;
        switch ($levelValidator) {
            case '1': // Verifikator 1
                static::$roleValidator1 = $role_id ?? null;
                static::$requestStatusAwal = RequestStatus::where('name', 'Agenda')->pluck('id')->first();
                break;
            case '2': // Verifikator 2
                // static::$requestStatusAwal = RequestStatus::where('name', 'Diproses')->pluck('id')->first();
                break;
            default:
                // static::$requestStatusAwal = RequestStatus::where('name', 'Pending')->pluck('id')->first();
                break;
        }
    }

    public static function canAccess(): bool
    {
        if (is_null(static::$roleValidator1)) {
            static::setRequestStatusAwal();
        }
        // dd(static::$roleValidator1);
        return auth()->user()->role_id === static::$roleValidator1;
    }

    public static function getRequestStatusAwal(): ?int
    {
        if (is_null(static::$requestStatusAwal)) {
            static::setRequestStatusAwal();
        }
        return static::$requestStatusAwal;
    }

    public static function getNavigationBadge(): ?string
    {
        $requestStatusAwal = static::getRequestStatusAwal();

        return static::getModel()::where('request_status_id', $requestStatusAwal)->where('telah_dijadwalkan_sidang', 0)->count();
    }
    // public static function query(EloquentBuilder $query): EloquentBuilder
    // {
    //     return $query->with(['form.listUploadForms']); // Pastikan relasi sudah di-load
    // }


    protected static ?string $navigationIcon = 'heroicon-o-queue-list';
    protected static ?string $navigationGroup = 'Form Permohonan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pemohon ')
                    ->description('Data diri pemohon')
                    ->schema([
                        TextInput::make('pemohon_nama')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pemohon_hp_telepon')
                            ->tel()
                            ->label('No Hp/telepon')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pemohon_email')
                            ->email()
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('pemohon_warga_blok')
                            ->label('Warga blok')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('pemohon_alamat')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Select::make('form_id')
                    ->label('Jenis Permohonan')
                    ->relationship('form', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive(), // Agar bisa mendeteksi perubahan langsung di form

                Forms\Components\Section::make('Cetak Formulir')
                    ->schema([
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('view_form')
                                ->label('View Form')
                                ->url(fn ($get) => Storage::url($get('form_file_path')))
                                ->openUrlInNewTab(),
    
                            Forms\Components\Actions\Action::make('view_form')
                                ->label('Download')
                                ->color('success')
                                ->url(fn ($get) => route('file.downloadForm', ['id' => $get('id')]))
                                ->openUrlInNewTab(false),
                        ]),
                    ]),

                Section::make('Dokumen yang Diupload')
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

                                    return [
                                        Forms\Components\Actions::make([
                                            Forms\Components\Actions\Action::make('download_' . $upload->id)
                                                ->label('View ' . $upload->name)
                                                ->url($filePath)
                                                // ->url(route('file.download', ['id' => $existingFile->id])) // Arahkan ke route
                                                ->openUrlInNewTab(),
                                            Forms\Components\Actions\Action::make('download_' . $upload->id)
                                                ->label('Download')
                                                ->color('success')
                                                ->url(route('file.download', ['id' => $existingFile->id])) // Arahkan ke route
                                                ->openUrlInNewTab(false),
                                        ]),


                                    ];
                                } else {
                                    return Forms\Components\Placeholder::make('no_file_' . $upload->id)
                                        ->label($upload->name)
                                        ->content('Tidak ada file yang diupload.');
                                }
                            }

                            // Jika dalam mode Create, tampilkan input untuk upload
                            return Forms\Components\FileUpload::make('file_' . $upload->id)
                                ->label($upload->name)
                                ->directory('uploads/form_permohonan')
                                ->acceptedFileTypes($upload->upload_type === 'pdf' ? ['application/pdf'] : ['image/*'])
                                ->maxSize(2048) // 2MB
                                ->required($upload->is_required === true ? true : false);
                        })->flatten()->toArray(); // Pakai flatten() agar array tidak bersarang
                    })
                    ->hidden(fn($get) => !$get('form_id')),

                // Forms\Components\TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),

                Select::make('request_status_id')
                    ->label('Jenis Permohonan')
                    ->relationship('requestStatus', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->where('request_status_id', '1');
    // }

    public static function table(Table $table): Table
    {
        // $role_id = auth()->user()->role_id;
        // $verifikator = Role::with(['levelVerification' => function ($query) {
        //     $query->select('id', 'order'); 
        // }])->where('id', $role_id)->first();
        // $levelValidator = $verifikator->levelVerification->order;

        // switch ($levelValidator) {
        //     case '1':
        //         $requestStatusAwal = RequestStatus::where('name', 'Pengajuan')->pluck('id')->first();
        //         break;
        //     case '2':
        //         $requestStatusAwal = RequestStatus::where('name', 'Diproses')->pluck('id')->first();
        //         break;
        //     default:
        //         $requestStatusAwal = RequestStatus::where('name', 'Pending')->pluck('id')->first(); // Default jika tidak 1 atau 2
        //         break;
        // }
        // return static::$requestStatusAwal;
        $requestStatusAwal = static::getRequestStatusAwal();
        // dd($requestStatusAwal);
        return $table
            ->modifyQueryUsing(fn(Builder $query) =>  $query->where('request_status_id', $requestStatusAwal)->where('telah_dijadwalkan_sidang', 0))
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
                // Tables\Columns\TextColumn::make('requestStatus.name')
                //     ->numeric()
                //     ->label('Status')
                //     ->sortable(),
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
            ->filters([
                SelectFilter::make('form')
                    ->relationship('form', 'name')
                    ->label('Jenis')
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

                Tables\Actions\Action::make('agendakan')
                    ->form([
                        Section::make('Informasi Surat')
                            ->schema([
                                TextInput::make('no_surat')
                                    ->label('Nomor Surat')
                                    ->required(),

                                TextInput::make('dari')
                                    ->label('Dari')
                                    ->default(fn($record) => $record->pemohon_nama)
                                    ->required(),
                                    
                                DatePicker::make('tanggal_masuk')
                                    ->label('Tanggal Masuk')
                                    ->default(fn($record) => $record->created_at)
                                    ->required(),
                            ])
                            ->columns(3),

                        Section::make('Detail Agenda')
                            ->schema([
                                Select::make('agenda_id')
                                    ->label('Agenda')
                                    ->options(Agenda::pluck('tgl_rapat', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        DatePicker::make('tgl_rapat')->required(),
                                    ])
                                    ->createOptionUsing(fn($data) => Agenda::create(['tgl_rapat' => $data['tgl_rapat']])->id),

                                Select::make('jenis_id')
                                    ->label('Jenis Agenda')
                                    ->options(AgendaJenis::pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->default(fn($record) => 
                                        AgendaJenis::where('name', 'Surat Dibahas')->value('id')
                                    )                                    
                                    ->preload(),

                                Select::make('keterangan_id')
                                    ->label('Keterangan Agenda')
                                    ->options(AgendaKeterangan::pluck('name', 'id'))
                                    ->required()
                                    ->searchable()
                                    ->default(fn($record) => 
                                        AgendaKeterangan::where('name', 'Kew')->value('id')
                                    )
                                    ->preload(),
                            ])
                            ->columns(3),

                        Section::make('Keterangan Tambahan')
                            ->schema([
                                Textarea::make('perihal')
                                    ->label('Perihal')
                                    ->default(fn($record) => 'Permohonan '.$record->form->name. ', nama; '.$record->pemohon_nama)
                                    ->required(),

                                Textarea::make('usulan_keputusan')
                                    ->label('Usulan Keputusan')
                                    ->nullable(),
                            ]),
                    ])
                    ->action(function (array $data, Request $record) {
                        // Simpan ke tabel `verifications`
                        AgendaDetail::create([
                            'request_id' => $record->id,
                            'no_surat' => $data['no_surat'],
                            'dari' => $data['dari'],
                            'tanggal_masuk' => $data['tanggal_masuk'],
                            'agenda_id' => $data['agenda_id'],
                            'jenis_id' => $data['jenis_id'],
                            'keterangan_id' => $data['keterangan_id'],
                            'perihal' => $data['perihal'],
                            'usulan_keputusan' => $data['usulan_keputusan'],
                        ]);
                       
                        $record->update([
                            'telah_dijadwalkan_sidang' => true,
                        ]);

                        $JenisPermohonan = FormModel::where('id', $record->form_id)->value('name');
                        $notes = "Permohonan disetujui, menunggu hasil sidang pleno";
                        $status = $record->requestStatus->name;
                        // Kirim email
                        $data = [
                            'pemohon_nama' => $record->pemohon_nama,
                            'pemohon_warga_blok' => $record->pemohon_warga_blok,
                            'pemohon_alamat' => $record->pemohon_alamat,
                            'form' => $JenisPermohonan,
                            'status' => $status,
                            'notes' => $notes,
                        ];
                        Mail::to($record->pemohon_email)->send(new RequestStatusesMail($data));
                        
                        $fonnteService = new FonnteService();
                        $message = "Detail Permohonan:\n";
                        $message .= "Nama: $record->pemohon_nama\n";
                        $message .= "Warga Blok/Pepanthan: $record->pemohon_warga_blok\n";
                        $message .= "Jenis Permohonan: $JenisPermohonan\n";
                        $message .= "Status: $status\n";
                        $message .= "Keterangan: ".$notes."\n";
                        $message .= "\nTerima kasih,\nAdmin Sekretariat GKJ Manahan Surakarta";
                        $fonnteService->sendMessage($record->pemohon_hp_telepon, $message);
                    })
                    ->label('Agendakan')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size(ActionSize::Medium)
                    ->color('primary')
                    ->button(),
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
            'index' => Pages\ListVerifAgendas::route('/'),
            // 'create' => Pages\CreateVerifAgenda::route('/create'),
            // 'view' => Pages\ViewVerifAgenda::route('/{record}'),
            // 'edit' => Pages\EditVerifAgenda::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
