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
        return redirect()->to('/barang')->with('message', 'Barang berhasil ditambahkan');   
    }
}
