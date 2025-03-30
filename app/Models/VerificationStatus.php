<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VerificationStatus extends Model
{

    public function verification(): HasMany
    {
        return $this->hasMany(Verification::class, 'verification_status_id');
    }
}
