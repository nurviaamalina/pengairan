<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">

<!-- HERO -->
<section class="hero-korsda">
    <div class="container text-center">
        <h1>Koordinator Pengelola</h1>
        <h2>Sumber Daya Alam</h2>
    </div>
</section>

<!-- CONTENT -->
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

        <!-- CARD -->
        <div class="row mt-5" id="korsdaContainer">

            <?php if(!empty($korsda)): ?>

                <?php foreach($korsda as $item): ?>

                    <div class="col-lg-4 col-md-6 mb-4 korsda-item">

                        <div class="korsda-card">

                            <div class="text-center">

                                <?php if(!empty($item['foto'])): ?>

                                    <img src="<?= base_url('uploads/korsda/'.$item['foto']) ?>"
                                         class="icon">

                                <?php else: ?>

                                    <img src="<?= base_url('assets/images/user.png') ?>"
                                         class="icon">

                                <?php endif; ?>

                                <small>Koordinator</small>

                                <h4 class="nama-kecamatan">
                                    Kecamatan <?= esc($item['kecamatan']) ?>
                                </h4>

                                <div class="line"></div>

                            </div>

                            <div class="info">
                                <span>Nama Koordinator</span>
                                <strong><?= esc($item['nama_koordinator']) ?></strong>
                            </div>

                            <div class="info">
                                <span>No HP / WhatsApp</span>
                                <strong><?= esc($item['no_hp']) ?></strong>
                            </div>

                            <div class="info">
                                <span>Alamat</span>
                                <strong><?= esc($item['alamat']) ?></strong>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Data koordinator belum tersedia.
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>

</section>

<script>
const searchInput = document.getElementById('searchKecamatan');

searchInput.addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    document.querySelectorAll('.korsda-item').forEach(function(card){

        let kecamatan = card.querySelector('.nama-kecamatan')
                            .innerText.toLowerCase();

        if(kecamatan.includes(keyword)){
            card.style.display = "";
        }else{
            card.style.display = "none";
        }

    });

});
</script>

<?= $this->include('layout/footer') ?>