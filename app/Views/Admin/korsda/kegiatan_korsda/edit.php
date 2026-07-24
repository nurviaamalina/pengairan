<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

<h2 class="fw-bold mb-4">Edit Kegiatan KORSDA</h2>

<div class="card shadow-sm">

<div class="card-body">

<form action="<?= site_url('admin/korsda/kegiatan/update/'.$kegiatan['id']) ?>"
      method="post"
      enctype="multipart/form-data">

<?= csrf_field() ?>

<div class="mb-3">
<label class="form-label">Kecamatan</label>

<select name="id_korsda" class="form-select">

<?php foreach($korsda as $item): ?>

<option value="<?= $item['id'] ?>"
<?= $item['id']==$kegiatan['id_korsda'] ? 'selected' : '' ?>>

<?= esc($item['nama_kecamatan']) ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">
<label class="form-label">Judul</label>

<input
type="text"
name="judul"
class="form-control"
value="<?= esc($kegiatan['judul']) ?>">
</div>

<div class="mb-3">
<label class="form-label">Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
value="<?= $kegiatan['tanggal'] ?>">
</div>

<div class="mb-3">
<label class="form-label">Gambar Lama</label><br>

<?php if($kegiatan['gambar']) : ?>

<img src="<?= base_url('uploads/kegiatan/'.$kegiatan['gambar']) ?>"
     width="180"
     class="img-thumbnail">

<?php endif; ?>

</div>

<div class="mb-3">
<label class="form-label">Ganti Gambar</label>

<input
type="file"
name="gambar"
class="form-control">
</div>

<div class="mb-3">

<label class="form-label">Isi Kegiatan</label>

<textarea
name="isi"
rows="8"
class="form-control"><?= esc($kegiatan['isi']) ?></textarea>

</div>

<button class="btn btn-primary">
Update
</button>

<a href="<?= site_url('admin/korsda/kegiatan') ?>"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</div>

</div>

<?= $this->include('admin/layout/footer') ?>