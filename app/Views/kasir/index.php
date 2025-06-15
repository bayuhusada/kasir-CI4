<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="bg-[#F5EFE7] min-h-screen px-6 py-8">
    <!-- Header -->
    <nav class="flex justify-between items-center bg-[#213555] text-white px-6 py-3 rounded-md mb-6">
        <div class="text-xl font-semibold">Kasir App</div>
        <a class="bg-[#D8C4B6] text-[#213555] px-4 py-2 rounded-md hover:bg-[#cbb4a9] transition" href="/logout">Logout</a>
    </nav>

    <!-- Form Input Barang -->
    <div class="bg-white p-6 rounded-md shadow-md border mb-6">
        <h2 class="text-lg font-semibold text-[#213555] mb-4">Input Barang</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm text-gray-700 mb-1">Barang</label>
                <select id="barangSelect" class="w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $b): ?>
                        <option 
                            value="<?= $b['id'] ?>" 
                            data-nama="<?= $b['nama_barang'] ?>" 
                            data-harga="<?= $b['harga'] ?>" 
                            data-stok="<?= $b['stok'] ?>">
                            <?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-700 mb-1">Qty</label>
                <input type="number" id="qtyInput" min="1" class="w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            <div class="flex items-end">
                <button type="button" id="addBarangBtn" class="w-full bg-[#3E5879] text-white px-4 py-2 rounded-md hover:bg-[#324966] transition">
                    + Tambah
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi -->
    <form method="post" action="/kasir/simpanTransaksi" id="formTransaksi">
        <div class="bg-white p-6 rounded-md shadow-md border">
            <h2 class="text-lg font-semibold text-[#213555] mb-4">Daftar Barang Dibeli</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-300">
                    <thead class="bg-[#213555] text-white">
                        <tr>
                            <th class="px-4 py-2">Nama Barang</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Qty</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="daftarBarangTable" class="bg-white divide-y divide-gray-200">
                        <!-- Data barang masuk sini -->
                    </tbody>
                    <tfoot>
                        <tr class="bg-[#F5EFE7]">
                            <td colspan="3" class="text-right font-semibold px-4 py-2">Total</td>
                            <td class="px-4 py-2" id="totalText">Rp 0</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Hidden input untuk backend -->
            <input type="hidden" name="barang_id_list[]" id="barangIds">
            <input type="hidden" name="qty_list[]" id="qtys">

            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-[#D8C4B6] text-[#213555] px-6 py-2 rounded-md hover:bg-[#c7b3a4] transition">
                    Simpan Transaksi
                </button>
            </div>
        </div>
    </form>
</div>

<script>
const daftarTable = document.querySelector('#daftarBarangTable');
const totalText = document.getElementById('totalText');
const barangSelect = document.getElementById('barangSelect');
const qtyInput = document.getElementById('qtyInput');
const addBtn = document.getElementById('addBarangBtn');

let barangList = [];

function formatRupiah(angka) {
  let numberString = angka.toString().replace(/[^,\d]/g, '');
  let split = numberString.split(',');
  let sisa = split[0].length % 3;
  let rupiah = split[0].substr(0, sisa);
  let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    let separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
  return 'Rp ' + rupiah;
}

function updateTable() {
    daftarTable.innerHTML = '';
    let total = 0;

    barangList.forEach((item, index) => {
        let subtotal = item.harga * item.qty;
        total += subtotal;

        daftarTable.innerHTML += `
            <tr>
                <td class="px-4 py-2">${item.nama}</td>
                <td class="px-4 py-2">${formatRupiah(item.harga)}</td>
                <td class="px-4 py-2">${item.qty}</td>
                <td class="px-4 py-2">${formatRupiah(subtotal)}</td>
                <td class="px-4 py-2">
                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="hapusBarang(${index})">Hapus</button>
                </td>
            </tr>
        `;
    });

    totalText.innerText = formatRupiah(total);

    document.getElementById('barangIds').value = barangList.map(b => b.id).join(',');
    document.getElementById('qtys').value = barangList.map(b => b.qty).join(',');
}

addBtn.addEventListener('click', () => {
    const selected = barangSelect.options[barangSelect.selectedIndex];
    const id = barangSelect.value;
    const nama = selected.getAttribute('data-nama');
    const harga = parseInt(selected.getAttribute('data-harga'));
    const stok = parseInt(selected.getAttribute('data-stok'));
    const qty = parseInt(qtyInput.value);

    if (!id || qty < 1) return alert('Barang dan qty harus diisi.');
    if (qty > stok) return alert(`Stok barang "${nama}" hanya tersedia ${stok}.`);

    barangList.push({ id, nama, harga, qty });
    updateTable();

    barangSelect.value = '';
    qtyInput.value = '';
});

function hapusBarang(index) {
    barangList.splice(index, 1);
    updateTable();
}
</script>

<?= $this->endSection() ?>
