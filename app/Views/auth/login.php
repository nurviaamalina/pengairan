<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="overlay"></div>

<div class="navbar">
    <a href="<?= base_url('register') ?>">Daftar</a>
    <span>|</span>
    <a href="<?= base_url('login') ?>">Login</a>
</div>

<div class="login-box">

    <h1>LOGIN</h1>

    <form action="<?= base_url('login') ?>" method="post">

        <?= csrf_field(); ?>

        <div class="form-group">
            <label>Username</label>

            <input
                type="text"
                name="username"
                placeholder=""
                required>
        </div>

        <div class="form-group">
            <label>Password</label>

            <input
                type="password"
                name="password"
                required>
        </div>

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>