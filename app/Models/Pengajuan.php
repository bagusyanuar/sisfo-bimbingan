<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'tanggal',
        'user_id',
        'pembimbing_id',
        'judul',
        'file',
        'status',
        'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'pengajuan_id');
    }
}
