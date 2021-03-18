<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Fasilitas extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'kode_fasilitas',
        'nama_fasilitas',
        'status_fasilitas',
        'keterangan',
        'image'
    ];
}
