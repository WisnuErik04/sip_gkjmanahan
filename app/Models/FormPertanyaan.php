<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormPertanyaan extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'pertanyaan', 'tipe_jawaban', 'opsi_jawaban', 'order', 'required'];
    protected $with = ['form'];
    protected $casts = [
        'opsi_jawaban' => 'array', // Pastikan data otomatis di-cast ke array
    ];
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
