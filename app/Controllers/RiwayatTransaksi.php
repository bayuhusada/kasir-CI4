<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\BarangModel;

class RiwayatTransaksi extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $barangModel = new BarangModel();

        // Ambil semua transaksi dan barang terkait
        $data['transaksi'] = $transaksiModel
            ->select('transaksi.*, barang.nama_barang')
            ->join('barang', 'barang.id = transaksi.barang_id')
            ->orderBy('transaksi.tanggal', 'DESC')
            ->findAll();

        return view('riwayat/index', $data);
    }
}
