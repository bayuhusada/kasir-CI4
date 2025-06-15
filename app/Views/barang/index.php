<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Default</a>
    <a class="btn btn-md btn-danger" href="/logout">Logout</a>
    <a class="btn btn-md btn-danger" href="<?= base_url('/riwayat') ?>">History</a>
  </div>
</nav>
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
        <td>Rp<?= number_format($item['harga'], 2, ',', '.') ?></td>
        <td><?= esc($item['stok']) ?></td>
        <td>
          <a href="/barang/edit/<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="#" onclick="confirmDelete(<?= $item['id'] ?>)" class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/barang/delete/" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
