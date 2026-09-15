<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Kata Sandi - Dinas Penggairan</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
</head>

<body>

    <div class="login-card">

        <h1>RESET KATA SANDI</h1>

        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>


        <!-- SUCCESS -->
        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>

        <?php endif; ?>


        <!-- DESKRIPSI -->
        <p class="forgot-description">
            Silakan buat kata sandi baru untuk akun Anda.
        </p>


        <!-- FORM RESET PASSWORD -->
        <form
            action="<?= base_url('proses-reset-password') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <!-- PASSWORD BARU -->
            <div class="form-group">

                <label for="password">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password baru"
                    minlength="6"
                    autocomplete="new-password"
                    required
                >

            </div>


            <!-- KONFIRMASI PASSWORD -->
            <div class="form-group">

                <label for="confirm_password">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Masukkan ulang password"
                    minlength="6"
                    autocomplete="new-password"
                    required
                >

            </div>


            <!-- BUTTON -->
            <button
                type="submit"
                class="btn-login"
            >
                Simpan Password
            </button>

        </form>

    </div>

</body>

</html>