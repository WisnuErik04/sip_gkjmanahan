<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    protected $fillable = ['request_id', 'verification_status_id', 'user_id', 'notes', 'approved_by'];

    protected $with = ['request', 'verificationStatus'];

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function verificationStatus(): BelongsTo
    {
        return $this->belongsTo(VerificationStatus::class);
    }
}
