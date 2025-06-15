<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2 class="text-xl font-bold mb-4">Riwayat Transaksi</h2>

<?php foreach ($transaksi as $trx): ?>
    <div class="mb-6 border p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Transaksi #<?= $trx['id'] ?> oleh <?= $trx['kasir'] ?> (<?= $trx['tanggal'] ?>)</h3>
        <table class="w-full text-left border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">Barang</th>
                    <th class="p-2">Qty</th>
                    <th class="p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trx['detail'] as $item): ?>
                    <tr>
                        <td class="p-2"><?= esc($item['nama_barang']) ?></td>
                        <td class="p-2"><?= esc($item['qty']) ?></td>
                        <td class="p-2">Rp<?= number_format($item['total'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>
