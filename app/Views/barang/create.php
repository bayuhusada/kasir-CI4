<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Barang</h1>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/barang" method="post" class="space-y-5 bg-white p-6 rounded-lg shadow-md border border-gray-200">
        <?= csrf_field() ?>

        <div>
            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang"
                value="<?= old('nama_barang') ?>"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-[#5459AC]" required>
        </div>

        <div>
            <label for="harga_format" class="block text-sm font-medium text-gray-700">Harga</label>
            <!-- Input format Rupiah -->
            <input type="text" id="harga_format" placeholder="Rp 0"
                onkeyup="formatRupiah(this)"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-[#5459AC]">

            <!-- Input untuk backend -->
            <input type="hidden" name="harga" id="harga">
        </div>

        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" id="stok"
                value="<?= old('stok') ?>"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-2 focus:ring-[#5459AC]" required>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-[#52357B] hover:bg-[#432c6c] text-white font-semibold px-5 py-2 rounded-md transition">
                Simpan
            </button>
            <a href="<?= site_url('barang') ?>" class="bg-[#B2D8CE] hover:bg-[#a5cdc1] text-[#333] font-semibold px-5 py-2 rounded-md transition">
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
function formatRupiah(input) {
    let angka = input.value.replace(/[^,\d]/g, '').toString();
    let split = angka.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    input.value = 'Rp ' + rupiah;

    // Simpan nilai untuk backend (tanpa Rp dan titik)
    document.getElementById('harga').value = angka.replace(/\./g, '');
}
</script>

<?= $this->endSection() ?>
