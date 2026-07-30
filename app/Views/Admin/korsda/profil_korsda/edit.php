<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

<div class="card shadow">

<div class="card-header">

<h4>Edit Profil KORSDA</h4>

</div>

<div class="card-body">

<form action="<?= base_url('admin/korsda/profil_korsda/update/'.$profil['id']) ?>"
      method="post"
      enctype="multipart/form-data">

<div class="mb-3">

<label>Kecamatan</label>

<select name="id_korsda" class="form-select">

<?php foreach($korsda as $k): ?>

<option value="<?= $k['id'] ?>"
<?= ($profil['id_korsda']==$k['id']) ? 'selected' : '' ?>>

<?= $k['nama_kecamatan'] ?>

</option>

<?php endforeach; ?>

</select>

</div>


<div class="mb-3">

<label>Visi</label>

<textarea
name="visi"
class="form-control"
rows="4"><?= $profil['visi'] ?></textarea>

</div>


<div class="mb-3">

<label>Misi</label>

<textarea
name="misi"
class="form-control"
rows="5"><?= $profil['misi'] ?></textarea>

</div>


<div class="mb-3">

<label>Tugas</label>

<textarea
name="tugas"
class="form-control"
rows="5"><?= $profil['tugas'] ?></textarea>

</div>


<div class="mb-3">

<label>Struktur Saat Ini</label><br>

<?php if($profil['struktur']) : ?>

<img src="<?= base_url('uploads/struktur/'.$profil['struktur']) ?>"
     width="250"
     class="img-thumbnail">

<?php endif; ?>

</div>


<div class="mb-3">

<label>Ganti Struktur</label>

<input
type="file"
name="struktur"
class="form-control">

</div>


<button class="btn btn-primary">

Update

</button>

<a href="<?= base_url('admin/korsda/profil_korsda') ?>"
class="btn btn-secondary">

Batal

</a>

</form>

</div>

</div>

</div>

</div>

<?= $this->include('admin/layout/footer') ?>