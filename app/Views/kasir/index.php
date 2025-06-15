<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<nav class="navbar bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Default</a>
    <a class="btn btn-md btn-danger" href="/logout">Logout</a>
    <a class="btn btn-md btn-danger" href="/riwayat">History</a>
  </div>
</nav>

<div class="card p-4 mb-4">
    <h4>Input Barang</h4>
    <div class="row">
        <div class="col-md-6">
            <label>Barang</label>
            <select id="barangSelect" class="form-select">
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
        <div class="col-md-3">
            <label>Qty</label>
            <input type="number" id="qtyInput" class="form-control" min="1">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="button" class="btn btn-primary w-100" id="addBarangBtn">+ Tambah</button>
        </div>
    </div>
</div>

<form method="post" action="/kasir/simpanTransaksi" id="formTransaksi">
    <h4>Daftar Barang Dibeli</h4>
    <table class="table table-bordered" id="daftarBarangTable">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td><span id="totalText">0</span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Input tersembunyi untuk data -->
    <input type="hidden" name="barang_id_list[]" id="barangIds">
    <input type="hidden" name="qty_list[]" id="qtys">
    <input type="hidden" name="total" id="totalHidden">

    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
</form>




<script>
const daftarTable = document.querySelector('#daftarBarangTable tbody');
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
  return 'Rp' + rupiah;
}


function updateTable() {
    daftarTable.innerHTML = '';
    let total = 0;

    barangList.forEach((item, index) => {
        let subtotal = item.harga * item.qty;
        total += subtotal;

        daftarTable.innerHTML += `
            <tr>
                <td>${item.nama}</td>
                <td>${formatRupiah(item.harga)}</td>
                <td>${item.qty}</td>
                <td>${formatRupiah(subtotal)}</td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusBarang(${index})">Hapus</button></td>
            </tr>
        `;
    });

    totalText.innerText = total;
    document.getElementById('totalHidden').value = total;

    // Simpan ID dan QTY untuk backend
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

    if (qty > stok) {
        return alert(`Stok barang "${nama}" hanya tersedia ${stok}.`);
    }

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
