<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h1>Halaman Kasir</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

  <form method="post" action="/kasir/simpanTransaksi">
  <div id="barang-wrapper">
    <div class="barang-item">
      <select name="barang_id[]">
        <?php foreach ($barang as $b) : ?>
          <option value="<?= $b['id'] ?>"><?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)</option>
        <?php endforeach ?>
      </select>
      <input type="number" name="qyt[]" placeholder="Qty" required>
    </div>
  </div>

  <button type="submit">Simpan Transaksi</button>
</form>



<?= $this->endSection() ?>
