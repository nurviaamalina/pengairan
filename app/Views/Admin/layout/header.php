<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Dashboard Admin') ?></title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/footer.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/korsdaadmin.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/dashboardkorsda.css') ?>">

</head>

<body>

<div class="topbar">

    <div class="logo-area">

        <!-- Logo -->
        <img src="<?= base_url('assets/images/pu.png') ?>" alt="Logo PU" class="admin-topbar-logo">

        <div class="logo-text">
            <h5>PANEL ADMINISTRATOR</h5>
            <p>Dinas PU Pengairan Banyuwangi</p>
        </div>

    </div>

    <div class="topbar-right">

        <div class="admin-user-info d-none d-sm-flex align-items-center me-3">
            <i class="bi bi-person-circle fs-5 me-2 text-primary"></i>
            <div>
                <span class="user-name"><?= esc(session()->get('username') ?? 'Admin') ?></span>
                <span class="badge bg-primary-subtle text-primary ms-1"><?= strtoupper(session()->get('role') ?? 'ADMIN') ?></span>
            </div>
        </div>

        <a href="<?= base_url('logout') ?>" class="logout">
            <i class="bi bi-box-arrow-right"></i>
            <span>Log-Out</span>
        </a>

    </div>

</div>
