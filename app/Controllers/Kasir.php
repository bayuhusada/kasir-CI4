<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kasir extends BaseController
{
    public function index()
    {
        $barangModel = new BarangModel();
        $data['barang'] = $barangModel->findAll();
        return view('kasir/index',[
            'barang' => $data['barang'],
            'validation' => \Config\Services::validation()
        ]);
    }

    public function simpanTransaksi()
{
    $barang_ids = $this->request->getPost('barang_id');
    $qyts = $this->request->getPost('qyt');
    $tanggal = date('Y-m-d H:i:s');

    $barangModel = new \App\Models\BarangModel();
    $transaksiModel = new \App\Models\TransaksiModel();

    for ($i = 0; $i < count($barang_ids); $i++) {
        $barang = $barangModel->find($barang_ids[$i]);

        if ($barang) {
            $qyt = (int)$qyts[$i];
            $total = $barang['harga'] * $qyt;

            // Simpan transaksi
            $transaksiModel->save([
                'barang_id' => $barang_ids[$i],
                'qyt' => $qyt,
                'total' => $total,
                'tanggal' => $tanggal
            ]);

            // Kurangi stok
            $barangModel->update($barang_ids[$i], [
                'stok' => $barang['stok'] - $qyt
            ]);
        }
    }

    return redirect()->to('/kasir')->with('success', 'Transaksi berhasil disimpan.');
}

}
