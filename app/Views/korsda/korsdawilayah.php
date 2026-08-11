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

                <label>Cari Wilayah</label>

                <div class="input-group">

                    <input type="text"
       id="searchWilayah"
       class="form-control"
       placeholder="Cari Nama Wilayah...">

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

            <a href="<?= base_url('korsda/profil/' . $item['id']) ?>"
               class="korsda-link">

                <div class="korsda-card">

                    <div class="text-center">

                        <?php if (!empty($item['foto'])) : ?>

                            <img src="<?= base_url('uploads/korsda/' . $item['foto']) ?>"
                                 class="icon"
                                 alt="<?= esc($item['nama']) ?>">

                        <?php else : ?>

                            <img src="<?= base_url('assets/images/user.png') ?>"
                                 class="icon"
                                 alt="KORSDA">

                        <?php endif; ?>


                        <small>Koordinator</small>


                        <!-- NAMA WILAYAH -->
                        <h4 class="nama-wilayah">
                            <?= esc($item['nama_wilayah'] ?? '-') ?>
                        </h4>


                        <!-- NAMA KECAMATAN -->
                        <h5 class="nama-kecamatan">
                            Kecamatan <?= esc($item['nama_kecamatan'] ?? '-') ?>
                        </h5>


                        <div class="line"></div>

                    </div>


                    <!-- NAMA -->
                    <div class="info">

                        <span>Nama</span>

                        <strong>
                            <?= esc($item['nama'] ?? '-') ?>
                        </strong>

                    </div>


                    <!-- JABATAN -->
                    <div class="info">

                        <span>Jabatan</span>

                        <strong>
                            <?= esc($item['jabatan'] ?? '-') ?>
                        </strong>

                    </div>


                    <!-- NO HP -->
                    <div class="info">

                        <span>No HP / WhatsApp</span>

                        <strong>
                            <?= esc($item['no_hp'] ?? '-') ?>
                        </strong>

                    </div>


                    <!-- ALAMAT -->
                    <div class="info">

                        <span>Alamat</span>

                        <strong>
                            <?= esc($item['alamat'] ?? '-') ?>
                        </strong>

                    </div>


                    <!-- STATUS -->
                    <div class="info">

                        <span>Status</span>

                        <strong>

                            <?php if (($item['status'] ?? '') == 'Aktif') : ?>

                                <span class="badge bg-success">
                                    Aktif
                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">
                                    Nonaktif
                                </span>

                            <?php endif; ?>

                        </strong>

                    </div>

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
            onclick="window.location.href='<?= base_url('korsda') ?>'">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </button>

    </div>

</section>

<script>

const searchInput = document.getElementById('searchKecamatan');

searchInput.addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();

    document.querySelectorAll('.korsda-item').forEach(function(card){

        let text = card.innerText.toLowerCase();

        if(text.includes(keyword)){
            card.style.display = "";
        }else{
            card.style.display = "none";
        }

    });

});

</script>

<script>
document.getElementById('searchWilayah').addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();
    const items = document.querySelectorAll('.korsda-item');

    items.forEach(function (item) {

        const namaWilayah = item
            .querySelector('.nama-wilayah')
            ?.textContent
            .toLowerCase() || '';

        if (namaWilayah.includes(keyword)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }

    });

});
</script>

<?= $this->include('layout/footer') ?>