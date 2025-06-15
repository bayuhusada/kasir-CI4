<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Navbar -->
<nav class="bg-gradient-to-r from-[#52357B] via-[#5459AC] to-[#648DB3] p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center text-white">
        <a class="text-lg font-bold" href="#">InventoryApp</a>
        <a href="/logout" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">Logout</a>
    </div>
</nav>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Data Barang</h1>

    <a href="/barang/create" class="bg-gradient-to-r from-[#52357B] to-[#648DB3] hover:opacity-90 text-white px-4 py-2 rounded-md mb-4 inline-block transition">
        + Tambah Barang Baru
    </a>

    <div class="overflow-x-auto shadow rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#B2D8CE] text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama Barang</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Harga</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Stok</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <?php foreach ($barang as $item): ?>
                    <tr>
                        <td class="px-6 py-4"><?= esc($item['id']) ?></td>
                        <td class="px-6 py-4"><?= esc($item['nama_barang']) ?></td>
                        <td class="px-6 py-4">Rp<?= number_format($item['harga'], 2, ',', '.') ?></td>
                        <td class="px-6 py-4"><?= esc($item['stok']) ?></td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="/barang/edit/<?= $item['id'] ?>" class="bg-[#5459AC] hover:bg-[#444b95] text-white px-3 py-1 rounded-md text-sm transition">Edit</a>
                            <button onclick="confirmDelete(<?= $item['id'] ?>)" class="bg-[#B2D8CE] hover:bg-[#9fcfc3] text-[#52357B] font-semibold px-3 py-1 rounded-md text-sm transition">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#52357B',
            cancelButtonColor: '#648DB3'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/barang/delete/" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
