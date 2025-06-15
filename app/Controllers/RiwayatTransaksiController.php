<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\UserModel;
use App\Models\BarangModel;

class RiwayatTransaksi extends BaseController
{
    public function index()
    {
        $transaksiModel = new TransaksiModel();
        $detailModel = new DetailTransaksiModel();
        $userModel = new UserModel();
        $barangModel = new BarangModel();

        // Ambil semua transaksi
        $transaksi = $transaksiModel->findAll();

        // Tambahkan detail untuk setiap transaksi
        foreach ($transaksi as &$trx) {
            $trx['kasir'] = $userModel->find($trx['user_id'])['username'] ?? 'Tidak diketahui';
            $trx['detail'] = $detailModel
                ->where('transaksi_id', $trx['id'])
                ->findAll();

            // Tambahkan nama barang ke setiap detail
            foreach ($trx['detail'] as &$item) {
                $barang = $barangModel->find($item['barang_id']);
                $item['nama_barang'] = $barang['nama_barang'] ?? 'Barang tidak ditemukan';
            }
        }

        return view('riwayat/index', ['transaksi' => $transaksi]);
    }
}
