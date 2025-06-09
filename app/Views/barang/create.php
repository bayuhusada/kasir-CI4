<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<h1 class="mb-4">Tambah Barang</h1>

<?php if(session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger">
    <ul class="mb-0">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form action="/barang" method="post">
  <?= csrf_field() ?>
  <div class="mb-3">
    <label for="nama_barang" class="form-label">Nama Barang:</label>
    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= old('nama_barang') ?>" required>
  </div>
  <div class="mb-3">
    <label for="harga" class="form-label">Harga:</label>
    <input type="number" name="harga" id="harga" class="form-control" value="<?= old('harga') ?>" required>
  </div>
  <div class="mb-3">
    <label for="stok" class="form-label">Stok:</label>
    <input type="number" name="stok" id="stok" class="form-control" value="<?= old('stok') ?>" required>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
  <a href="<?= site_url('barang') ?>" class="btn btn-secondary ms-2">Kembali</a>
</form>
<?= $this->endSection() ?>
