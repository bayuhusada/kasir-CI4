<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['barang_id', 'qyt', 'jumlah', 'tanggal'];
}
