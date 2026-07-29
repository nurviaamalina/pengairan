<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

<div class="card shadow-sm">

<div class="card-header bg-warning text-dark">
    <h5 class="mb-0">
        Edit Wilayah Kerja
    </h5>
</div>

<div class="card-body">

<form action="<?= base_url('admin/wilayah/update/' . $wilayah['id']) ?>" method="post">

<?= csrf_field() ?>

<div class="mb-3">
<label class="form-label">Kecamatan / KORSDA</label>

<select name="id_korsda" class="form-select" required>

<?php foreach ($korsda as $k): ?>

<option
value="<?= $k['id'] ?>"
<?= ($k['id'] == $wilayah['id_korsda']) ? 'selected' : '' ?>>

<?= esc($k['nama_kecamatan']) ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Nama Lokasi</label>

<input
type="text"
name="nama_lokasi"
class="form-control"
value="<?= esc($wilayah['nama_lokasi']) ?>"
required>

</div>

<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label>Latitude</label>

<input
type="text"
name="latitude"
class="form-control"
value="<?= esc($wilayah['latitude']) ?>"
required>

</div>

</div>

<div class="col-md-6">

<div class="mb-3">

<label>Longitude</label>

<input
type="text"
name="longitude"
class="form-control"
value="<?= esc($wilayah['longitude']) ?>"
required>

</div>

</div>

</div>

<div class="mb-3">

<label>Zoom</label>

<input
type="number"
name="zoom"
class="form-control"
value="<?= esc($wilayah['zoom']) ?>"
required>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
rows="4"
class="form-control"><?= esc($wilayah['keterangan']) ?></textarea>

</div>

<hr>

<button class="btn btn-warning">

<i class="bi bi-pencil-square"></i>

Update

</button>

<a href="<?= base_url('admin/wilayah') ?>" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

<?= $this->include('admin/layout/footer') ?>