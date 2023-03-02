<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;

class BukuTamuController extends Controller
{
    public function storeDataTamu(Request $request){
        $nama = $request->input('nama');
        $no_telp = $request->input('no_telp');
        $asal_instansi = $request->input('asal_instansi');
        $user_id = $request->input('user_id');
        $keperluan = $request->input('keperluan');
        $file_upload = $request->input('file_upload');

        $store = new BukuTamu();
        $store->nama = $nama;
        $store->no_telp = $no_telp;
        $store->asal_instansi = $asal_instansi;
        $store->user_id = $user_id;
        $store->keperluan = $keperluan;
        $store->file_upload = $file_upload;
        dd($store);
        $store->save();

        return view
    }

}
