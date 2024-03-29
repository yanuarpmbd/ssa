<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    use HasFactory;

    protected $fillable = ['kode_arsip', 'rak_id', 'jenis_arsip', 'retensi_inaktif', 'retensi_musnah', 'deskripsi'];

    public function arsip(){
        return $this->hasMany(Arsip::class, 'kode_arsip');
    }
}
