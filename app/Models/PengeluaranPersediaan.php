<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PengeluaranPersediaan extends Model
{
    use HasFactory, Uuid;

    protected $fillable = ['identifier', 'pegawai_id', 'barang_id', 'jumlah', 'tgl_pengeluaran'];

    public function pegawai(){
        return $this->belongsTo(User::class);
    }

    public function barang(){
        return $this->belongsTo(Persediaan::class);
    }
}
