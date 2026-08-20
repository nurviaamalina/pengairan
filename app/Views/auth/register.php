<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/register.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="overlay"></div>

<div class="top-menu">
    <a href="<?= base_url('register') ?>" class="active">Daftar</a>
    |
    <a href="<?= base_url('login') ?>">Login</a>
</div>

<div class="register-box">

    <h1>REGISTER</h1>

    <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('register') ?>" method="post">

        <?= csrf_field(); ?>

        <div class="form-group">
            <label>Username</label>
            <input
                type="text"
                name="username"
                value="<?= old('username') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="<?= old('email') ?>"
                required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                name="password"
                required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="confirm_password"
                required>
        </div>

        <div class="form-group">
            <label for="role">Daftar Sebagai</label>

        <select name="role" id="role" class="form-control role-select" required>
            <option value="">-- Pilih Role --</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
     </select>
</div>

        <button type="submit">
            Daftar
        </button>

    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="<?= base_url('login') ?>">Login</a>
    </div>

</div>

</body>

</html>