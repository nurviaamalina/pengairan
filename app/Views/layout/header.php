<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dinas Pengairan Banyuwangi</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm border-bottom">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/images/pemkab.png') ?>" width="80" class="logo-pemkab me-2" alt="Pemkab Banyuwangi">
                <img src="<?= base_url('assets/images/pu.png') ?>" width="80" class="logo-pu" alt="Dinas Pengairan">
            </a>

            <!-- Toggle -->
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('/') ?>">BERANDA</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            PROFIL
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sejarah Singkat</a></li>
                            <li><a class="dropdown-item" href="#">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            INOVASI
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://sekardadu.dingkoding.com/home">Sekardadu</a></li>
                            <li><a class="dropdown-item" href="https://mawasdiri.dingkoding.com/home">Mawasdiri</a></li>
                            <li><a class="dropdown-item" href="https://pubwi.dingkoding.com/home">Warm System</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            LAYANAN
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pengaduan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('korsda') ?>">Korsda</a></li>
                            <li><a class="dropdown-item" href="#">Live CCTV</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">DOKUMEN</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">KONTAK</a>
                    </li>

                </ul>

                <!-- Search -->
                <form class="d-flex">
                    <input class="form-control form-control-sm"
                        type="search"
                        placeholder="Cari">

                    <button class="btn btn-light ms-1" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <div class="garis-bawah"></div>