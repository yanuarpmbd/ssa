<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranPersediaanItem extends Model
{
    use HasFactory;
    
    /**
     * @var string
     */
    protected $table = 'pengeluaran_persediaan_items';

    protected $fillable = ['persediaan_id', 'jumlah'];
}
