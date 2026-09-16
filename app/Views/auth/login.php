<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin - Dinas Pekerjaan Umum dan Pengairan Banyuwangi</title>

    <!-- CSS LOGIN -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/login.css') ?>"
    >

    <!-- BOOTSTRAP ICON -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- FONT AWESOME -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

</head>


<body>


<div class="login-page">


    <!-- =====================================================
         BAGIAN KIRI
         BRANDING
    ====================================================== -->

    <div class="login-left">


        <div class="left-overlay"></div>


        <div class="left-content">


            <!-- =================================================
                 LOGO
            ================================================== -->

            <div class="brand-logo-box">

                <img
                    src="<?= base_url('assets/images/pu.png') ?>"
                    alt="Logo Kabupaten Banyuwangi"
                    class="brand-logo"
                >

            </div>


            <!-- =================================================
                 BRAND
            ================================================== -->

            <h1 class="brand-title">

                DINAS PU PENGGAIRAN
                <br>
               BANYUWANGI

            </h1>


          


            <!-- =================================================
                 INFORMASI
            ================================================== -->

            <!-- <div class="left-info">

                <div class="info-item">

                    <div class="info-icon">
                        <i class="fa-solid fa-droplet"></i>
                    </div>

                    <div>
                        <strong>
                            Pengairan Berkelanjutan
                        </strong>

                        <span>
                            Mendukung pengelolaan sumber daya air
                            secara berkelanjutan.
                        </span>
                    </div>

                </div>


                <div class="info-item">

                    <div class="info-icon">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <div>
                        <strong>
                            Pelayanan Publik
                        </strong>

                        <span>
                            Meningkatkan pelayanan infrastruktur
                            bagi masyarakat Banyuwangi.
                        </span>
                    </div>

                </div>

            </div> -->


            <!-- =================================================
                 FOOTER KIRI
            ================================================== -->

            <div class="left-footer">

                <i class="fa-solid fa-shield-halved"></i>

                <span>
                    Sistem Informasi Internal
                    Dinas PU dan Pengairan
                </span>

            </div>


        </div>

    </div>



    <!-- =====================================================
         BAGIAN KANAN
         FORM LOGIN
    ====================================================== -->

    <div class="login-right">


        <div class="right-content">


            <!-- =================================================
                 HEADER LOGIN
            ================================================== -->

            <div class="right-login-header">


                <div class="right-login-icon">

                    <i class="fa-solid fa-user-shield"></i>

                </div>


                <h2>
                    Login Admin
                </h2>


                <p>

                    Silakan login untuk mengakses
                    <br>

                    Sistem Informasi Dinas PU dan Penggairan.

                </p>


            </div>



            <!-- =================================================
                 FLASH ERROR
            ================================================== -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="login-alert alert-danger">

                    <i class="bi bi-exclamation-circle"></i>

                    <span>
                        <?= esc(session()->getFlashdata('error')) ?>
                    </span>

                </div>

            <?php endif; ?>



            <!-- =================================================
                 FLASH SUCCESS
            ================================================== -->

            <?php if (session()->getFlashdata('success')): ?>

                <div class="login-alert alert-success">

                    <i class="bi bi-check-circle"></i>

                    <span>
                        <?= esc(session()->getFlashdata('success')) ?>
                    </span>

                </div>

            <?php endif; ?>



            <!-- =================================================
                 FORM LOGIN
            ================================================== -->

            <form
                action="<?= site_url('login') ?>"
                method="post"
                class="right-login-form"
            >

                <?= csrf_field() ?>


                <!-- USERNAME -->
                <div class="right-input-group">

                    <label for="username">
                        Username
                    </label>


                    <div class="right-input-box">

                        <i class="fa-solid fa-user"></i>


                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            value="<?= esc(old('username')) ?>"
                            autocomplete="username"
                            required
                        >

                    </div>

                </div>



                <!-- PASSWORD -->
                <div class="right-input-group">

                    <label for="password">
                        Password
                    </label>


                    <div class="right-input-box">

                        <i class="fa-solid fa-lock"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                    </div>

                </div>



                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="right-login-button"
                >

                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>
                        Login
                    </span>

                </button>


            </form>



           


    </div>


</div>


</body>

</html>