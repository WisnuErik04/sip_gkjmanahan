<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $defaultRole = 'Admin Sekretariat'; // Ganti sesuai kebutuhan
            $defaultRole = Role::where('id', $user->role_id)->value('name');
            dd($defaultRole);
            if (Role::where('name', $defaultRole)->exists()) {
                $user->assignRole($defaultRole);
            }
        });

        static::updated(function ($user) {
            // Ambil role berdasarkan role_id yang baru
            $newRole = Role::where('id', $user->role_id)->value('name');
    
            // Cek apakah role berubah
            if ($newRole && !$user->hasRole($newRole)) {
                // Hapus role lama sebelum menambahkan yang baru
                $user->roles()->detach();
                $user->assignRole($newRole);
            }
        });
    }
}
