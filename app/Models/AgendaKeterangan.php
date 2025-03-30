<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgendaKeterangan extends Model
{
    protected $fillable = ['name'];

    public function agendaDetails(): HasMany
    {
        return $this->hasMany(AgendaDetail::class, 'keterangan_id');
    }

}
