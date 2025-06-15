<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        //
    }


    public function login()
    {
        return view('auth/login');
    }
public function doLogin()
{
    $userModel = new UserModel();
    $username = $this->request->getPost('username');
    $password = hash('sha256', $this->request->getPost('password'));

    // Ambil user berdasarkan username
    $user = $userModel->where('username', $username)->first();

    // Cek apakah user ditemukan dan password cocok
    if ($user && $user['password'] === $password) {

        // Set session
        session()->set([
            'user_id'    => $user['id'],
            'username'   => $user['username'],
            'role'       => $user['role'], 
            'isLoggedIn' => true
        ]);

        // Redirect sesuai role
        if ($user['role'] === 'admin') {
            session()->setFlashdata('success','login berhasil');
            return redirect()->to('/barang')->with('message', 'Selamat datang, ' . $user['username']);
        } else {
            session()->setFlashdata('success','login berhasil');
            return redirect()->to('/kasir')->with('message', 'Selamat datang, ' . $user['username']);
        }
    }

    // Jika gagal login
    session()->setFlashdata('error', 'Username atau password salah');
    return redirect()->back()->withInput()->with('error', 'Username atau password salah');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('message', 'Anda telah logout');
    }
}
