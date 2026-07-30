<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">

<section class="hero-korsda">
    <div class="container text-center">
        <h1>Koordinator Pengelola</h1>
        <h2>Sumber Daya Alam</h2>
    </div>
</section>

<section class="korsda-content">

    <div class="container">

        <div class="search-wrapper">

            <div class="search-box">

                <label>Cari Kecamatan</label>

                <div class="input-group">

                    <input type="text"
                        id="searchKecamatan"
                        class="form-control"
                        placeholder="Cari Kecamatan...">

                    <button class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>

                </div>

            </div>

            <div class="gis-btn">

                <a href="<?= site_url('gis') ?>" class="btn btn-primary">

                    <i class="fas fa-map-marked-alt"></i>

                    GIS Kabupaten Banyuwangi

                </a>

            </div>

        </div>

        <div class="row mt-5" id="korsdaContainer">

            <?php if (!empty($korsda)) : ?>

                <?php foreach ($korsda as $item) : ?>

<div class="col-lg-4 col-md-6 mb-4 korsda-item">

    <a href="<?= base_url('korsda/profil/' . $item['id']) ?>" class="korsda-link">

        <div class="korsda-card">

            <div class="text-center">

                <?php if (!empty($item['gambar'])) : ?>

                    <img src="<?= base_url('uploads/korsda/' . $item['gambar']) ?>"
                        class="icon">

                <?php else : ?>

                    <img src="<?= base_url('assets/images/user.png') ?>"
                        class="icon">

                <?php endif; ?>

                <small>Koordinator</small>

                <h4 class="nama-kecamatan">
                    Kecamatan <?= esc($item['nama_kecamatan']) ?>
                </h4>

                <div class="line"></div>

            </div>

            <div class="info">
                <span>Nama Ketua</span>
                <strong><?= esc($item['ketua']) ?></strong>
            </div>

            <div class="info">
                <span>No HP / WhatsApp</span>
                <strong><?= esc($item['telepon']) ?></strong>
            </div>

            <div class="info">
                <span>Alamat</span>
                <strong><?= esc($item['alamat']) ?></strong>
            </div>

            <?php if (!empty($item['deskripsi'])) : ?>

                <div class="info">
                    <span>Deskripsi</span>
                    <strong><?= esc($item['deskripsi']) ?></strong>
                </div>

            <?php endif; ?>

        </div>

    </a>

</div>

<?php endforeach; ?>

            <?php else : ?>

                <div class="col-12">

                    <div class="alert alert-warning text-center">

                        Data KORSDA belum tersedia.

                    </div>

                </div>

            <?php endif; ?>

        </div>
<button
            type="button"
            class="btn btn-primary btn-kembali"
            onclick="window.location.href='<?= base_url('/') ?>'">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </button>
    </div>

</section>

<script>
const searchInput = document.getElementById('searchKecamatan');

searchInput.addEventListener('keyup', function() {

    let keyword = this.value.toLowerCase();

    document.querySelectorAll('.korsda-item').forEach(function(card) {

        let kecamatan = card.querySelector('.nama-kecamatan')
            .innerText.toLowerCase();

        if (kecamatan.includes(keyword)) {

            card.style.display = "";

        } else {

            card.style.display = "none";

        }

    });

});
</script>


<?= $this->include('layout/footer') ?>