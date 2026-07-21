<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Dashboard Admin') ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>

<body>

<div class="topbar">

    <div class="logo-area">

        <!-- Logo -->
        <div class="logo-circle"></div>

        <!-- Jika punya logo gunakan ini -->
        <!--
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
        -->

        <div class="logo-text">
            <h5>DINAS PENGAIRAN</h5>
            <p>Kabupaten Banyuwangi</p>
        </div>

    </div>

    <div class="topbar-right">

        <a href="<?= base_url('logout') ?>" class="logout">
            <i class="bi bi-box-arrow-right"></i>
            Log-Out
        </a>

        <div class="status"></div>

    </div>

</div>