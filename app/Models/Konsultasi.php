<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = [
        'pengajuan_id',
        'tanggal',
        'deadline',
        'judul',
        'file_konsultasi',
        'file_revisi',
        'keterangan',
        'status'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }
}
