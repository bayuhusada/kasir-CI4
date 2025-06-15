<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-bold mb-4">Riwayat Transaksi</h2>

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 border">Tanggal</th>
            <th class="px-4 py-2 border">Barang</th>
            <th class="px-4 py-2 border">Jumlah</th>
            <th class="px-4 py-2 border">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $t): ?>
            <tr>
                <td class="px-4 py-2 border"><?= $t['tanggal'] ?></td>
                <td class="px-4 py-2 border"><?= $t['nama_barang'] ?></td>
                <td class="px-4 py-2 border"><?= $t['qyt'] ?></td>
                <td class="px-4 py-2 border">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
