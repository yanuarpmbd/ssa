<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_telp', 'asal_instansi', 'user_id', 'keperluan', 'file_upload'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
