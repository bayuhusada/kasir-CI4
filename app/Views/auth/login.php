<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<!-- Full Page White Background -->
<div class="min-h-screen flex items-center justify-center bg-white">
    <!-- Card with Gradient Background -->
    <div class="w-full max-w-md rounded-xl overflow-hidden shadow-lg">
        <!-- Gradient Header -->
        <div class="bg-gradient-to-br from-[#52357B] via-[#5459AC] to-[#B2D8CE] p-6 text-white text-center">
            <h2 class="text-3xl font-bold">Login</h2>
            <p class="text-sm mt-1">Selamat datang kembali</p>
        </div>

        <!-- White Form Area -->
        <div class="bg-white p-8">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5459AC]" placeholder="Masukkan username" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5459AC]" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="w-full bg-[#52357B] hover:bg-[#432e6b] text-white font-semibold py-2 rounded-md transition duration-300">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
