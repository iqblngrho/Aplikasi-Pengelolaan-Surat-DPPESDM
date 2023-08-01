<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';

    protected $fillable = [
        'id_surat',
        'id_user',
        'tanggal_disposisi',
        'sifat',
        'catatan',
        'diteruskan_ke',
        'file'
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat');
    }

    public function user()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat');
    }
}


/**
 * 
 * 
 * 
 * 
 * 
 * 
 */