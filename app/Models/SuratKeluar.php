<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'surat_keluar';
    protected $fillable = [
        'alamat_tujuan',
        'nomor_surat',
        'tanggal_surat',
        'sifat',
        'perihal',
        'lampiran',
        'status',
        'file',
        'id_bidang',
    ];
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
}
