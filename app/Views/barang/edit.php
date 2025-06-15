<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Barang</h1>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/barang/update/<?= $barang['id'] ?>" method="post" class="space-y-5 bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <?= csrf_field() ?>

        <div>
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang"
                value="<?= esc($barang['nama_barang']) ?>"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5459AC]" required>
        </div>

        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga"
                value="<?= esc($barang['harga']) ?>"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5459AC]" required>
        </div>

        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" id="stok"
                value="<?= esc($barang['stok']) ?>"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#5459AC]" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-[#52357B] hover:bg-[#432c6c] text-white font-semibold px-5 py-2 rounded-md transition">
                Simpan Perubahan
            </button>
            <a href="/barang" class="bg-[#B2D8CE] hover:bg-[#a5cdc1] text-[#333] font-semibold px-5 py-2 rounded-md transition">
                Batal
            </a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
