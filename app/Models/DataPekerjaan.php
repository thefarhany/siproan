<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kotama',
        'pembayaran',
        'nama_pekerjaan',
        'no_tgl_spmk',
        'nilai_kontrak',
        'penyedia_jasa',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_hari',
        'lapju_rencana',
        'lapju_ril',
        'lapju_deviasi',
        'daya_serap',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'img_awal',
        'img_progress',
        'img_akhir',
    ];
}
