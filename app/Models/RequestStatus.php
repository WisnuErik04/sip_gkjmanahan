<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestStatus extends Model
{
    use HasFactory;

    protected $fillable =['name', 'order'];

    public function request() : HasMany {
        return $this->hasMany(Request::class);
    }
}
