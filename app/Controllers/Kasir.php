<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\DetailTransaksiModel;
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
    $barang_ids = explode(',', $this->request->getPost('barang_id_list')[0]);
    $qtys = explode(',', $this->request->getPost('qty_list')[0]);
    $total = $this->request->getPost('total');
    $tanggal = date('Y-m-d H:i:s');

    $transaksiModel = new TransaksiModel();
    $detailModel = new DetailTransaksiModel();
    $barangModel = new BarangModel();

    // Simpan ke tabel transaksi (parent)
    $transaksiId = $transaksiModel->insert([
        'jumlah' => $total,
        'tanggal' => $tanggal,
    ]);

    // Simpan detail transaksi
    for ($i = 0; $i < count($barang_ids); $i++) {
    $barang = $barangModel->find($barang_ids[$i]);

    if ($barang) {
        $qty = (int) $qtys[$i];

        if ($qty > $barang['stok']) {
            session()->setFlashdata('error', 'Stok barang "' . $barang['nama_barang'] . '" tidak mencukupi.');
            return redirect()->to('/kasir')->with('error', 'Stok barang "' . $barang['nama_barang'] . '" tidak mencukupi.');
        }

        $detailModel->insert([
            'transaksi_id' => $transaksiId,
            'barang_id' => $barang_ids[$i],
            'qty' => $qty,
            'subtotal' => $barang['harga'] * $qty,
        ]);

        $barangModel->update($barang_ids[$i], [
            'stok' => $barang['stok'] - $qty,
        ]);
    }
}

    session()->setFlashdata('success', 'Transaksi berhasil disimpan.');
    return redirect()->to('/kasir')->with('success', 'Transaksi berhasil.');
}


}
