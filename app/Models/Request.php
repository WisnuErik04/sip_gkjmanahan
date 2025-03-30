<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use App\Filament\Resources\RequestResource;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemohon_nama',
        'pemohon_hp_telepon',
        'pemohon_email',
        'pemohon_warga_blok',
        'pemohon_alamat',
        // 'user_id',
        'form_id',
        'form_answers',
        'form_file_path',
        'request_status_id',
        'telah_dijadwalkan_sidang',
    ];
    protected $casts = [
        'form_answers' => 'array',
    ];

    protected $with = ['requestStatus', 'form'];


    public function requestStatus(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    // public function uploadFile(): HasMany
    // {
    //     return $this->hasMany(UploadFile::class, 'request_id');
    // }

    // public function files(): HasMany
    // {
    //     return $this->hasMany(UploadFile::class, 'request_id');
    // }

    // public function listUploadForms(): HasManyThrough
    // {
    //     return $this->hasManyThrough(ListUploadForm::class, Form::class, 'id', 'form_id', 'form_id', 'id')->orderBy('order', 'asc');
    // }

    public function listUploadForms(): HasManyThrough
    {
        return $this->hasManyThrough(
            ListUploadForm::class,
            Form::class,
            'id', // Foreign key di Form
            'form_id', // Foreign key di ListUploadForm
            'form_id', // Foreign key di Request
            'id'  // Primary key di Form
        )->orderBy('order', 'asc')
         ->select(['id', 'form_id', 'name', 'upload_type', 'is_required']);
    }

    public function verification(): HasMany
    {
        return $this->hasMany(Verification::class, 'request_id');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($request) {
    //         $request->handleFileUploads();
    //     });

    //     static::updated(function ($request) {
    //         $request->handleFileUploads();
    //     });
    // }

    // public function handleFileUploads()
    // {
    //     dd(request()->all());
    //     $listUploads = ListUploadForm::where('form_id', $this->form_id)->get();

    //     foreach ($listUploads as $upload) {
    //         $fileKey = 'file_' . $upload->id;

    //         // Cek apakah file ada dalam request
    //         if (request()->hasFile($fileKey)) {
    //             foreach (request()->file($fileKey) as $file) {
    //                 $filePath = $file->store('uploads/form_permohonan', 'public');

    //                 UploadFile::create([
    //                     'request_id'         => $this->id,
    //                     'list_upload_form_id' => $upload->id,
    //                     'file_path'          => $filePath,
    //                     'file_name'          => $file->getClientOriginalName(),
    //                     'file_type'          => $file->getClientOriginalExtension(),
    //                     'file_size'          => $file->getSize(),
    //                 ]);
    //             }
    //         }
    //     }
    // }

    public function delete()
    {
        try {
            // Hapus semua file terkait terlebih dahulu
            $uploadFiles = UploadFile::where('request_id', $this->id)->get();

            foreach ($uploadFiles as $file) {
                if ($file->file_path && Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path); // Hapus file dari storage
                }
                $file->delete(); // Hapus data file dari database
            }

            parent::delete(); // Jalankan penghapusan request
            return redirect()->to(RequestResource::getUrl('index'));

        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                Notification::make()
                    ->title('Gagal menghapus!')
                    ->body('Data ini masih terkait dengan entitas lain. Hapus data terkait terlebih dahulu.')
                    ->danger()
                    ->send();
            }

            return false; // Batalkan penghapusan
        }
    }
}
