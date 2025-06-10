<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<h1>Data Barang</h1>
<a href="/barang/create" class="btn btn-primary mb-3">Tambah Barang Baru</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Barang</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($barang as $item): ?>
      <tr>
        <td><?= esc($item['id']) ?></td>
        <td><?= esc($item['nama_barang']) ?></td>
        <td><?= esc($item['harga']) ?></td>
        <td><?= esc($item['stok']) ?></td>
        <td>
          <a href="/barang/edit/<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="/barang/delete/<?= $item['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>
