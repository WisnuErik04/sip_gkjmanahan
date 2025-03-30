<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Filament\Resources\FormResource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaDetail extends Model
{
    protected $fillable = ['no_surat', 'perihal', 'dari', 'tanggal_masuk', 'usulan_keputusan', 'keterangan', 'jenis_id', 'agenda_id', 'keterangan_id', 'request_id'];

    protected $with = ['agendaKeterangan', 'agenda', 'agendaJenis', 'request'];

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function agendaJenis(): BelongsTo
    {
        return $this->belongsTo(AgendaJenis::class, 'jenis_id');
    }

    public function agendaKeterangan(): BelongsTo
    {
        return $this->belongsTo(AgendaKeterangan::class, 'keterangan_id');
    }

    public function agenda(): BelongsTo
    {
        return $this->belongsTo(Agenda::class);
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
