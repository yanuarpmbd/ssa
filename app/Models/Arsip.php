<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maher\Counters\Traits\HasCounter;
use App\Traits\Uuid;


class Arsip extends Model
{
    use HasFactory, HasCounter, Uuid;

    protected $fillable = ['identifier', 'user_id', 'kode_arsip', 'unit_kerja_id', 'tingkat_perkembangan', 'nama_arsip', 'rak_id', 'dus_id', 'status', 'deskripsi', 'tahun', 'upload_arsip'];

    public function jenisArsip(){
        return $this->belongsTo(JenisArsip::class, 'kode_arsip');
    }

    public function dus(){
        return $this->belongsTo(Dus::class);
    }

    public function rak(){
        return $this->belongsTo(Rak::class);
    }

    public function unitKerja(){
        return $this->belongsTo(UnitKerja::class);
    }
}
