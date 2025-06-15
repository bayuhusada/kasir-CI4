<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $data['barang'] = $this->barangModel->findAll();
        return view('barang/index', $data);
    }
  

    public function create()
    {
        return view('barang/create');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_barang' => 'required|min_length[3]',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->barangModel->save([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
        ]);
        session()->setFlashdata('success', 'Barang berhasil ditambahkan');
        return redirect()->to('/barang')->with('message', 'Barang berhasil ditambahkan');   
    }

public function edit($id)
{
    // Ambil data barang berdasarkan ID
    $barang = $this->barangModel->find($id);

    // Jika tidak ditemukan, redirect dengan pesan error
    if (!$barang) {
        return redirect()->to('/barang')->with('error', 'Data tidak ditemukan');
    }

    return view('barang/edit', ['barang' => $barang]);
}

public function update($id)
{
    // Validasi input
    if (!$this->validate([
        'nama_barang' => 'required|min_length[3]',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ])) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Update data barang berdasarkan ID
    $this->barangModel->update($id, [
        'nama_barang' => $this->request->getPost('nama_barang'),
        'harga' => $this->request->getPost('harga'),
        'stok' => $this->request->getPost('stok'),
    ]);
    session()->setFlashdata('success', 'Barang berhasil diperbarui');
    return redirect()->to('/barang')->with('message', 'Barang berhasil diperbarui');
}

public function delete($id)
{
    // Hapus barang berdasarkan ID
    $this->barangModel->delete($id);
    session()->setFlashdata('success', 'Barang berhasil dihapus');
    return redirect()->to('/barang')->with('message', 'Barang berhasil dihapus');
}

}
