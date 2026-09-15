<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Kata Sandi </title>

    <link rel="stylesheet"
          href="<?= base_url('assets/css/auth.css') ?>">

</head>

<body>

<div class="login-card">

    <!-- JUDUL -->
    <h1></h1>


    <!-- PESAN ERROR -->
    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <!-- PESAN SUCCESS -->
    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>


    <!-- DESKRIPSI -->
    <p class="forgot-description">
        Masukkan email yang terdaftar.
        Kami akan mengirimkan kode OTP
        untuk mengatur ulang kata sandi.
    </p>


    <!-- FORM -->
    <form action="<?= base_url('proses-lupa-password') ?>"
          method="post">

        <?= csrf_field() ?>


        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Masukkan email"
                value="<?= old('email') ?>"
                autocomplete="email"
                required
            >

        </div>


        <button type="submit" class="btn-login">
            Kirim Kode OTP
        </button>

    </form>


    <!-- KEMBALI KE LOGIN -->
    <div class="back-login">

        <a href="<?= base_url('login') ?>">
            ← Kembali ke Login
        </a>

    </div>

</div>

</body>

</html>