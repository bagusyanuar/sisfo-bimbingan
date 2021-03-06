<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id');
    }

    public function pengajuan_success()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')->where('status', 'terima');
    }

    public function laporan_acc()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')->where('status', 'terima');
    }

    public function laporan_menunggu()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')->where('status', 'menunggu');
    }

    public function laporan_selesai()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')->where('status', 'selesai');
    }

    public function pengajuan_terakhir()
    {
        return $this->hasOne(Pengajuan::class, 'user_id')->orderBy('id', 'DESC');
    }
}
