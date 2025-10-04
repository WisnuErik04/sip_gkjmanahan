<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Request;
use Filament\Forms\Form;
use App\Models\UploadFile;
use Filament\Tables\Table;
use App\Models\HapusDokumen;
use App\Models\RequestStatus;
use App\Models\ListUploadForm;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HapusDokumenResource\Pages;
use App\Filament\Resources\HapusDokumenResource\RelationManagers;

class HapusDokumenResource extends Resource
{
    protected static ?string $model = Request::class;

    public static function getNavigationLabel(): string
    {
        return 'Hapus Dokumen';
    }
    public static function getPluralLabel(): string
    {
        return 'Hapus Dokumen';
    }

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationGroup = 'Form Permohonan';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $requestStatusSetuju = RequestStatus::where('name', 'Disetujui')->pluck('id')->first();
        $requestStatusTidakSetuju = RequestStatus::where('name', 'Tidak Disetujui')->pluck('id')->first();
        $requestStatusAgenda = RequestStatus::where('name', 'Agenda')->pluck('id')->first();

        return $table
            ->modifyQueryUsing(
                fn(Builder $query) => $query
                    // Kriteria 1: Status Harus Disetujui ATAU Tidak Disetujui
                    ->where(function (Builder $q) use ($requestStatusSetuju, $requestStatusTidakSetuju) {
                        $q->where('request_status_id', $requestStatusSetuju)
                            ->orWhere('request_status_id', $requestStatusTidakSetuju)
                            // ->orWhere('request_status_id', $requestStatusAgenda)
                        ;
                    })

                    // Kriteria 2: Hanya tampilkan Request yang memiliki file upload.
                    // Memastikan setidaknya ada 1 ListUploadForm yang terhubung.
                    // CATATAN: Karena listUploadForms adalah HasManyThrough, kita TIDAK bisa memfilter 
                    // isi file di sini. Kita akan lakukan filtering kolom 'file' di Bulk Action.
                    // Namun, kita pastikan ada entry ListUploadForm.
                    ->has('uploadFile')
            )
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
                    ->label('Warga Blok/ Pepanthan/ Komisi/ Panitia/ Tim')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('form.name')
                    ->label('Jenis')
                    ->numeric()->wrap()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('requestStatus.name')
                //     ->numeric()
                //     ->label('Status')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('requestStatus.name')
                    ->label('Status')
                    ->sortable()
                    ->badge() // Mengaktifkan tampilan badge
                    ->color(fn($state) => match ($state ?? '') {
                        'Pengajuan' => 'gray',
                        'Diproses'  => 'warning',
                        'Disetujui' => 'success',
                        'Tidak Disetujui'   => 'danger',
                        'Agenda'   => 'info',
                        default     => 'secondary',
                    })
                    ->icon(fn($state) => match ($state) {
                        'Pengajuan' => 'heroicon-o-clock',
                        'Diproses'  => 'heroicon-o-arrow-path',
                        'Disetujui' => 'heroicon-o-check-circle',
                        'Tidak Disetujui'   => 'heroicon-o-x-circle',
                        default     => 'heroicon-o-question-mark-circle',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime()
                    ->sortable()
                // ->toggleable(isToggledHiddenByDefault: true)
                ,
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc') // Mengurutkan berdasarkan tanggal terbaru
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

                // Tables\Actions\EditAction::make()->label('Verifikasi')->size(ActionSize::Medium),


            ])
            ->bulkActions([
                BulkAction::make('delete_uploaded_files')
                    ->label('Hapus File Fisik & Bersihkan Database')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (Collection $requests) {
                        $deletedFileCount = 0;
                        // Gunakan disk 'local' sesuai dengan kode yang Anda berikan
                        $disk = 'local';

                        foreach ($requests as $requestRecord) {

                            // 1. Iterasi melalui setiap ListUploadForm yang terhubung ke Request
                            // $requestRecord->uploadFiles->each(function (UploadFile $file) use ($disk, &$deletedFileCount) {
                            $requestRecord->uploadFile()->each(function (UploadFile $file) use ($disk, &$deletedFileCount) {
                            // $requestRecord->listUploadForms()->each(function (ListUploadForm $uploadForm) use ($disk, &$deletedFileCount) {


                                // Asumsi: ListUploadForm memiliki kolom yang mengarah ke UploadFile ID (misalnya, 'upload_file_id')
                                // $uploadFileId = $uploadForm->upload_file_id ?? null; // GANTI DENGAN NAMA KOLOM ID YANG BENAR

                                // if ($uploadFileId) {

                                    try {
                                        // Mencari record UploadFile
                                        $filePath = $file->file_path; // Ambil path file

                                        // 2. Hapus File Fisik
                                        if ($filePath && Storage::disk($disk)->exists($filePath)) {
                                            Storage::disk($disk)->delete($filePath);
                                        }

                                        // 3. Hapus Record UploadFile (data path file)
                                        $file->delete();
                                        $deletedFileCount++;

                                        // 4. Bersihkan Foreign Key di ListUploadForm
                                        // Anda mungkin perlu membersihkan kolom di ListUploadForm jika masih ada.
                                        // $uploadForm->update(['upload_file_id' => null]);
                                    } catch (\Exception $e) {
                                        // Abaikan jika UploadFile tidak ditemukan (sudah dihapus atau ID salah)
                                        // Lanjutkan ke record berikutnya
                                    }
                                // }
                            });
                        }

                        // Notifikasi Sukses
                        Notification::make()
                            ->title("Berhasil membersihkan {$deletedFileCount} file.")
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ListHapusDokumens::route('/'),
            // 'create' => Pages\CreateHapusDokumen::route('/create'),
            // 'edit' => Pages\EditHapusDokumen::route('/{record}/edit'),
        ];
    }
}
