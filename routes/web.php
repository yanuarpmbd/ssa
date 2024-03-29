<?php

use App\Filament\Resources\ArsipResource\Pages\ListArsips;
use App\Http\Livewire\BukuTamu;
use App\Http\Livewire\PengeluaranPersediaan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/buku-tamu', BukuTamu::class);
Route::get('/persediaan', PengeluaranPersediaan::class);
//Route::get('/downloadND/{record}', [ListArsips::class, 'generateND'])->name('downloadND');