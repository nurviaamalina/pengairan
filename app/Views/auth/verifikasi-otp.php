<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi OTP</title>

    <link rel="stylesheet"
          href="<?= base_url('assets/css/auth.css') ?>">
</head>

<body>

<div class="login-card">

    <h2>Verifikasi OTP</h2>

    <p>
        Masukkan kode 6 digit yang telah dikirim
        ke email Anda.
    </p>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>

    <?php endif; ?>


    <form
        action="<?= base_url('proses-verifikasi-otp') ?>"
        method="post"
    >

        <?= csrf_field() ?>

        <div class="form-group">

            <label for="otp">
                Kode OTP
            </label>

            <input
                type="text"
                id="otp"
                name="otp"
                maxlength="6"
                minlength="6"
                inputmode="numeric"
                autocomplete="one-time-code"
                placeholder="Masukkan 6 digit kode"
                required
            >

        </div>


        <button
            type="submit"
            class="btn-login"
        >
            Verifikasi Kode
        </button>

    </form>

</div>

</body>

</html>