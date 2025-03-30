<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Filament\Notifications\Notification;
use App\Filament\Resources\RolesResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = ['name', 'guard_name', 'level_verification_id'];

    protected $with = ['levelVerification'];

    public function levelVerification(): BelongsTo
    {
        return $this->belongsTo(LevelVerification::class, 'level_verification_id');
    }
    
    public function delete()
    {
        try {
            parent::delete(); // Jalankan penghapusan normal
            return redirect()->to(RolesResource::getUrl('index'));
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
