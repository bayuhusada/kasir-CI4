<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\BarangModel;
use App\Models\UserModel;

class RiwayatTransaksi extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new DetailTransaksiModel();
        $userModel = new UserModel();
        $barangModel = new BarangModel();

        // Ambil semua transaksi
        $allTransaksi = $transaksiModel->findAll();

        $data['transaksi'] = [];

        foreach ($allTransaksi as $trx) {

            // Ambil detail transaksi dari tabel detail_transaksi
            $detail = $detailModel->where('transaksi_id', $trx['id'])->findAll();

            // Tambahkan nama barang dan total ke setiap detail
          foreach ($detail as &$item) {
    $barang = $barangModel->find($item['barang_id']);
    
    if (!$barang) {
        log_message('error', 'Barang tidak ditemukan untuk barang_id: ' . $item['barang_id']);
    }

    $item['nama_barang'] = $barang['nama_barang'] ?? 'Tidak diketahui';
    $item['total'] = $item['qty'] * ($barang['harga'] ?? 0);
}

            // Gabungkan data
            $data['transaksi'][] = [
                'id' => $trx['id'],
                'tanggal' => $trx['tanggal'],
                'detail' => $detail
            ];
        }

        return view('riwayat/index', $data);
        return view($data);
    }
}
