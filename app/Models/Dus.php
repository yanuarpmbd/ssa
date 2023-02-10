<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dus extends Model
{
    use HasFactory;

    protected $fillable = ['nama_dus', 'rak_id', 'qr_path'];

    public function rak(){
        return $this->belongsTo(Rak::class);
    }

    public function arsip(){
        return $this->hasMany(Arsip::class);
    }

}
