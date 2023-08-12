<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';
    protected $fillable = [
        'asal_surat',
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'status',
        'jenis',
        'sifat',
        'catatan',
        'tindakan',
        'lampiran',
        'file',
    ];
    protected $attributes = [
        'tindakan' => 'tidak-teruskan',
     ];
     public function disposisi()
    {
        return $this->hasOne(Disposisi::class);
    }
}


