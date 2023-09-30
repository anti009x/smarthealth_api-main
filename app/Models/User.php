<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [''];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRole()
    {
        return $this->belongsTo("App\Models\Master\Role", "id_role", "id_role");
    }

    public function getApotek()
    {
        return $this->belongsTo("App\Models\Akun\OwnerApotek", "id", "user_id");
    }

    public function getProfilApotek()
    {
        return $this->belongsTo("App\Models\Apotek\Pengaturan\ProfilApotek", "id", "id_user");
    }

    public function getOwnerRs()
    {
        return $this->belongsTo("App\Models\Akun\OwnerRumahSakit", "id", "user_id");
    }

    public function getDokter()
    {
        return $this->belongsTo("App\Models\Akun\Dokter", "id", "user_id");
    }

    public function getPerawat()
    {
        return $this->belongsTo("App\Models\Akun\Perawat", "id", "user_id");
    }

    public function konsumen()
    {
        return $this->belongsTo("App\Models\Akun\Konsumen", "id", "user_id");
    }

    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'user_id');
    }

    public function getAdminApotek()
    {
        return $this->belongsTo("App\Models\Apotek\Pengaturan\ProfilApotek", "id", "user_penanggung_jawab_id");
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'user_id');
    }
}
