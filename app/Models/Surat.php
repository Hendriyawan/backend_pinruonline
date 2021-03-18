<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Surat extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id_user',
        'username',
        'validator',
        'kode_surat',
        'tanggal_masuk_surat',
        'nomor_surat',
        'lampiran',
        'perihal',
        'nama_kegiatan',
        'tanggal_surat',
        'waktu',
        'tempat',
        'tanggal_pinjam',
        'tanggal_kembali',
        'up_surat',
        'status_surat',
        'update_by',
        'notes',
        'lembaga'
    ];
}
