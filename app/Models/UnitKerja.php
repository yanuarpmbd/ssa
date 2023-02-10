<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $fillable = ['nama_unit_kerja'];

    public function arsip(){
        return $this->hasMany(Arsip::class);
    }
}
