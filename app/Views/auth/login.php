<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Dinas Pekerjaan Umum dan Pengairan Banyuwangi</title>

    <!-- CSS LOGIN -->
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <div class="login-page">

        <!-- =====================================================
             BAGIAN KIRI (HERO / BRANDING FULL HEIGHT)
        ====================================================== -->
        <div class="login-left">
            <div class="left-overlay"></div>
            
            <div class="left-content">
                <div class="brand-top">
                    <div class="brand-logo-drop">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <div class="brand-text">
                        <h2>Dinas Pekerjaan Umum<br>dan Pengairan</h2>
                        <span>KABUPATEN BANYUWANGI</span>
                    </div>
                </div>

                <div class="hero-tagline">
                    <p>Mewujudkan Infrastruktur<br>Pengairan yang Berkelanjutan<br>untuk Kesejahteraan Masyarakat</p>
                    <div class="tagline-line"></div>
                </div>
            </div>

            <!-- Wave Effect Dekorasi Bawah -->
            <div class="wave-decoration">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M-5.07,73.52 C149.99,150.00 299.66,-20.00 504.79,115.96 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #5493d2; opacity: 0.5;"></path>
                    <path d="M-8.46,45.89 C126.41,130.73 346.50,12.33 505.36,80.42 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #0a2558;"></path>
                </svg>
            </div>
        </div>

        <!-- =====================================================
             BAGIAN KANAN (FORM LOGIN FULL HEIGHT)
        ====================================================== -->
        <div class="login-right">
            <div class="right-inner">

                <!-- HEADER LOGO KANAN -->
                <div class="header-logo-container">
                    <img src="<?= base_url('assets/images/pu.png') ?>" alt="Logo Pemkab Banyuwangi" class="banyuwangi-logo">
                    <div class="header-logo-text">
                        <span class="gov-title">PEMERINTAH KABUPATEN BANYUWANGI</span>
                        <h1 class="dept-title">DINAS PEKERJAAN UMUM<br>DAN PENGAIRAN</h1>
                    </div>
                </div>

                <div class="divider-line"></div>

                <!-- LOGIN TITLE -->
                <div class="login-header">
                    <h2>Login Admin</h2>
                    <p>Silakan login untuk mengakses sistem informasi<br>Dinas Pekerjaan Umum dan Pengairan Kabupaten Banyuwangi.</p>
                </div>

                <!-- FLASH ERROR / SUCCESS -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="login-alert alert-danger">
                        <i class="bi bi-exclamation-circle"></i>
                        <span><?= esc(session()->getFlashdata('error')) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="login-alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <span><?= esc(session()->getFlashdata('success')) ?></span>
                    </div>
                <?php endif; ?>

                <!-- FORM LOGIN -->
                <form action="<?= site_url('login') ?>" method="post" class="login-form">
                    <?= csrf_field() ?>

                    <!-- USERNAME -->
                    <div class="form-group">
                        <div class="input-box">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" id="username" name="username" placeholder="Username" value="<?= esc(old('username')) ?>" autocomplete="username" required>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <div class="input-box">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password" required>
                            <button type="button" class="btn-toggle-password" id="togglePassword">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- OPTIONS -->
                    <div class="form-options">
                        <label class="checkbox-container">
                            <input type="checkbox" name="remember" id="remember">
                            <span class="checkmark"></span>
                            Ingat Saya
                        </label>
                    </div>

                    <!-- BUTTON SUBMIT -->
                    <button type="submit" class="btn-login">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login
                    </button>
                </form>

                <!-- FOOTER KANAN -->
                <div class="card-right-footer">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Dinas Pekerjaan Umum dan Pengairan Kabupaten Banyuwangi</span>
                </div>

            </div>
        </div>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>

</html>