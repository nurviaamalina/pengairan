<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================== -->

    <div class="navbar">

        <a href="<?= base_url('/') ?>">
            Beranda
        </a>

        <span>|</span>

        <a href="<?= base_url('register') ?>">
            Register
        </a>

    </div>


    <!-- =========================
         LOGIN BOX
    ========================== -->

    <div class="login-box">

        <h1>LOGIN</h1>


        <!-- =========================
             PESAN ERROR
        ========================== -->

        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>


        <!-- =========================
             PESAN SUCCESS
        ========================== -->

        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>

        <?php endif; ?>


        <!-- =========================
             FORM LOGIN
        ========================== -->

        <form action="<?= base_url('login') ?>" method="post">

            <?= csrf_field() ?>


            <!-- USERNAME -->

            <div class="form-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= old('username') ?>"
                    placeholder="Masukkan username"
                    required
                >

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <!-- =========================
                 INGAT SAYA + LUPA PASSWORD
            ========================== -->

            <div class="login-options">

                <label class="remember-me">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        <?= old('remember') ? 'checked' : '' ?>
                    >

                    <span>Ingat Saya</span>

                </label>


                <a href="<?= base_url('lupa-password') ?>">
                    Lupa Kata Sandi?
                </a>

            </div>


            <!-- =========================
                 BUTTON LOGIN
            ========================== -->

            <button
                type="submit"
                class="btn-login"
            >
                Login
            </button>

        </form>

    </div>

</body>
</html>