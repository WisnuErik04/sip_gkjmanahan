<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Filament\Resources\FormResource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agenda extends Model
{
    protected $fillable = ['tgl_rapat'];

    public function agendaDetails(): HasMany
    {
        return $this->hasMany(AgendaDetail::class);
    }

    public function delete()
    {
        try {
            // parent::delete(); // Jalankan penghapusan normal
            // \DB::transaction(function () {
            //     \DB::table('list_upload_forms')->where('form_id', $this->id)->delete();
                parent::delete(); // Hapus data di forms
            // });
            return redirect()->to(FormResource::getUrl('index'));

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
