<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    
    protected $fillable = ['kode_rak', 'nama_rak', 'kode_nama', 'deskripsi', 'qr_path'];

    public function arsip(){
        return $this->hasMany(Arsip::class);
    }

    public function dus(){
        return $this->hasMany(Dus::class);
    }
}
