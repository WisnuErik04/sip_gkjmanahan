<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadFile extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'list_upload_form_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size'];

    protected $with = ['request', 'listUploadForm'];

    public function request() : BelongsTo {
        return $this->belongsTo(Request::class);
    }

    public function listUploadForm(): BelongsTo{
        return $this->belongsTo(ListUploadForm::class);
    }
}
