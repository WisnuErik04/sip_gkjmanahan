<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListUploadForm extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'order', 'upload_type', 'is_required'];

    protected $with = ['form'];

    
    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function form() : BelongsTo {
        return $this->belongsTo(Form::class);
    }
    
    public function uploadFiles() : BelongsTo {
        return $this->belongsTo(UploadFile::class);
    }

    public function delete()
    {
        try {
            parent::delete(); // Jalankan penghapusan normal
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
