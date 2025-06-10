<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h1 class="mb-4">Edit Barang</h1>

<?php if(session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <form action="/barang/update/<?= $barang['id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="<?= esc($barang['nama_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="<?= esc($barang['harga']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" value="<?= esc($barang['stok']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="/barang" class="btn btn-secondary">Batal</a>
    </form>
<?= $this->endSection() ?>
