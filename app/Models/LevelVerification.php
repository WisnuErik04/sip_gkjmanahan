<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;
use App\Filament\Resources\LevelVerificationResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelVerification extends Model
{
    use HasFactory;
    
    protected $table = 'level_verifications'; // Sesuai dengan nama tabel
    protected $fillable = ['name', 'order']; // Field yang bisa diisi

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($LevelVerification) {
    //         try {
    //             // dd("qwqwqw");
    //             return true; // Lanjutkan penghapusan
    //         } catch (QueryException $e) {
    //             if ($e->getCode() == "23000") {
    //                 Notification::make()
    //                     ->title('Gagal menghapus!')
    //                     ->body('Data ini masih digunakan di bagian lain. Hapus data terkait terlebih dahulu.')
    //                     ->danger()
    //                     ->send();
    //             } else {
    //                 Notification::make()
    //                     ->title('Terjadi Kesalahan!')
    //                     ->body('Silakan coba lagi atau hubungi admin.')
    //                     ->danger()
    //                     ->send();
    //             }

    //             return false; // Batalkan penghapusan
    //         }
    //     });
    // }

    public function delete()
    {
        try {
            parent::delete(); // Jalankan penghapusan normal
            return redirect()->to(LevelVerificationResource::getUrl('index'));
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