<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/tentangkami.css') ?>">

<!-- HERO -->
<section class="hero-about">
    <img src="<?= base_url('assets/images/batik.png') ?>" class="motif-kiri" alt="Motif">
    <div class="container text-center">
        <h1>
            TENTANG <span>KAMI</span>
        </h1>
    </div>
</section>

<!-- ============================================================ -->
<!-- SEJARAH - Mengambil dari Database -->
<!-- ============================================================ -->
<section class="sejarah-section">
    <div class="container">
        <h2 class="section-title">
            SEJARAH <span>SINGKAT</span>
        </h2>
        <div class="content-card">
            <?php if(!empty($profil) && !empty($profil['sejarah'])): ?>
                <p><?= $profil['sejarah'] ?></p>
            <?php else: ?>
                <p style="text-align: center; color: #999; font-style: italic;">
                    <i class="bi bi-clock-history me-2"></i>
                    Belum ada data sejarah. Silakan admin menginput data sejarah di halaman admin.
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============================================================ -->
<!-- VISI & MISI - Mengambil dari Database -->
<!-- ============================================================ -->
<section class="visi-misi-section">
    <div class="container">
        <div class="row">
            <!-- VISI -->
            <div class="col-lg-6 mb-4">
                <div class="vm-content">
                    <h3>VISI</h3>
                    <?php if(!empty($profil) && !empty($profil['visi'])): ?>
                        <p><?= $profil['visi'] ?></p>
                    <?php else: ?>
                        <p style="color: #999; font-style: italic;">
                            <i class="bi bi-eye me-2"></i>
                            Belum ada data visi.
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- MISI -->
            <div class="col-lg-6">
                <div class="vm-content">
                    <h3>MISI</h3>
                    <?php if(!empty($profil) && !empty($profil['misi'])): ?>
                        <?= $profil['misi'] ?>
                    <?php else: ?>
                        <p style="color: #999; font-style: italic;">
                            <i class="bi bi-bullseye me-2"></i>
                            Belum ada data misi.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================ -->
<!-- STRUKTUR ORGANISASI - Mengambil dari Database -->
<!-- ============================================================ -->
<section class="struktur-section">
    <div class="container text-center">
        <h2 class="section-title-center">
            STRUKTUR <span>ORGANISASI</span>
        </h2>
        <p class="sub-title">
            Dinas Pekerjaan Umum Pengairan Kabupaten Banyuwangi
        </p>
        <div class="struktur-card">
            <?php if(!empty($profil) && !empty($profil['struktur']) && file_exists('uploads/struktur/' . $profil['struktur'])): ?>
                <img 
                    src="<?= base_url('uploads/struktur/'.$profil['struktur']) ?>" 
                    alt="Struktur Organisasi"
                    class="img-fluid">
            <?php else: ?>
                <!-- Jika belum ada gambar dari database, gunakan gambar default -->
                <img 
                    src="<?= base_url('assets/images/Struktur Terbaru.jpg') ?>" 
                    alt="Struktur Organisasi"
                    class="img-fluid">
                <p style="margin-top: 15px; color: #999; font-size: 0.9rem; font-style: italic;">
                    <i class="bi bi-info-circle me-2"></i>
                    Gambar struktur saat ini masih menggunakan gambar default. 
                    Admin dapat mengupload gambar struktur baru di halaman admin.
                </p>
            <?php endif; ?>
        </div>
        
        <!-- Tampilkan deskripsi struktur jika ada -->
        <?php if(!empty($profil) && !empty($profil['deskripsi_struktur'])): ?>
            <div class="struktur-deskripsi mt-4">
                <p style="color: #555; line-height: 1.8; max-width: 800px; margin: 0 auto;">
                    <?= $profil['deskripsi_struktur'] ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- BUTTON -->
<section class="btn-section">
    <div class="container text-center">
        <a href="<?= base_url('/') ?>" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Beranda
        </a>
    </div>
</section>

<?= $this->include('layout/footer') ?>