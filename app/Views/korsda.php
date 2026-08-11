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

        <!-- Search -->
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

        <!-- Card Kecamatan -->
        <div class="row g-4 mt-5" id="korsdaContainer">

            <?php if (!empty($kecamatan)) : ?>

    <?php foreach ($kecamatan as $item) : ?>

        <div class="col-lg-4 col-md-6 col-sm-12 korsda-item">

            <a href="<?= base_url('korsda/korsdawilayah/' . $item['id']) ?>"
               class="korsda-link">

                <div class="korsda-card">

                    <div class="text-center">

                        <small>Kecamatan</small>

                        <h4 class="nama-kecamatan">
                            <?= esc($item['nama_kecamatan']) ?>
                        </h4>

                        <div class="line"></div>

                    </div>

                </div>

            </a>

        </div>

    <?php endforeach; ?>

<?php else : ?>

    <div class="col-12">

        <div class="alert alert-warning text-center">
            Data Kecamatan belum tersedia.
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

document.getElementById('searchKecamatan').addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    let cards = document.querySelectorAll('.korsda-item');

    cards.forEach(function(card){

        let nama = card.querySelector('.nama-kecamatan').innerText.toLowerCase();

        if(nama.includes(keyword)){
            card.style.display = "";
        }else{
            card.style.display = "none";
        }

    });

});

</script>

<?= $this->include('layout/footer') ?>
