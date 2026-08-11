<?= $this->include('layout/header') ?>

<section class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title">DOKUMEN RESMI</h1>
        <p class="hero-subtitle">
            Regulasi dan Peraturan Pengairan
        </p>
    </div>
</section>

<section class="dokumen-section">

<div class="container">

<div class="dokumen-wrapper">

<form action="<?= base_url('dokumen') ?>" method="get">

<div class="row g-3 align-items-center mb-4">

<div class="col-lg-5">

<!-- <div class="search-box">

<i class="fas fa-search"></i>

<input
type="text"
class="form-control"
name="keyword"

value="<?= esc($keyword ?? '') ?>">

</div> -->

</div>

<div class="col-lg-3">

<select class="form-select filter-select" name="kategori">

<option value="">Semua Kategori</option>

<?php foreach($allKategori as $k): ?>

<option
value="<?= $k['id'] ?>"
<?= ($kategoriDipilih==$k['id'])?'selected':'';?>>

<?= esc($k['nama_kategori']) ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-lg-2">

<select class="form-select filter-select" name="tahun">

<option value="">Tahun</option>

<?php foreach($tahunList as $t): ?>

<option
value="<?= $t['tahun']?>"
<?= ($tahunDipilih==$t['tahun'])?'selected':'';?>>

<?= $t['tahun']?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-lg-2">

<button class="btn btn-warning w-100">

Cari

</button>

</div>

</div>

</form>

<p class="result-count">

Menampilkan <?= count($kategoriCard) ?> Kategori

</p>

<?php if(empty($kategoriCard)): ?>

<div class="alert alert-warning">

Dokumen tidak ditemukan.

</div>

<?php endif; ?>

<?php foreach($kategoriCard as $row): ?>

<a href="<?= base_url('dokumen/detail/'.$row['id']) ?>" class="kategori-card">

<div class="folder-icon">

<i class="fa-regular fa-folder"></i>

</div>

<div class="kategori-title">

<?= esc($row['nama_kategori']) ?>

</div>

</a>

<?php endforeach; ?>

</div>

</div>

</section>

<?= $this->include('layout/footer') ?>