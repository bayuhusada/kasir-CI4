<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Login</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="/login" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
    

<?= $this->endSection() ?>
