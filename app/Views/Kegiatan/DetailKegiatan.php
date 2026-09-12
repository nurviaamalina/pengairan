<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url('/') ?>">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('kegiatan') ?>">Kegiatan</a>
            </li>
            <li class="breadcrumb-item active">
                Detail Kegiatan
            </li>
        </ol>
    </nav>

    <!-- Judul & Tanggal -->
    <h2 class="text-center fw-bold">
        <?= esc($kegiatan['judul']) ?>
    </h2>

    <p class="text-center text-muted">
        <?= date('d F Y', strtotime($kegiatan['created_at'] ?? $kegiatan['tanggal'])) ?>
    </p>

    <!-- Thumbnail Utama -->
    <div class="text-center my-5">
        <img src="<?= base_url('uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail']) ?>"
             class="img-fluid rounded shadow" 
             alt="<?= esc($kegiatan['judul']) ?>">
    </div>

    <!-- Deskripsi Kegiatan -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?= nl2br(esc($kegiatan['deskripsi'])) ?>
        </div>
    </div>

    <!-- Dokumentasi Foto -->
    <?php if (!empty($foto)) : ?>
        <hr class="my-5">

        <h3 class="text-center mb-4">
            Dokumentasi
        </h3>

        <div class="row g-4 mb-4">
            <?php foreach ($foto as $item) : ?>
                <div class="col-lg-4 col-md-6">
                    <img src="<?= base_url('uploads/kegiatan/dokumentasi/' . $item['foto']) ?>"
                         class="img-fluid rounded shadow-sm"
                         alt="Dokumentasi">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="javascript:history.back()" class="btn btn-primary btn-kembali">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

</section>

<?= $this->include('layout/footer') ?>