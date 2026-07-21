<?= $this->include('layout/header') ?>

<style>
.pengaduan-hero{
    background:#f7b500;
    padding:80px 0 60px;
}

.pengaduan-wrap{
    background:transparent;
}

.pengaduan-card{
    border-radius:35px;
    overflow:hidden;
    box-shadow:0 35px 80px rgba(0,0,0,.12);
}

.pengaduan-left{
    background:#08214c;
    color:#fff;
    padding:50px;
}

.pengaduan-left h1{
    font-size:2.5rem;
    margin-bottom:1.2rem;
}

.pengaduan-left p,
.pengaduan-left .info-item p{
    color:rgba(255,255,255,.85);
    line-height:1.8;
}

.pengaduan-left .info-item{
    margin-top:2rem;
}

.pengaduan-right{
    background:#fff;
    padding:50px;
}

.pengaduan-right h3{
    margin-bottom:1.5rem;
}

.pengaduan-right .form-control,
.pengaduan-right .form-select,
.pengaduan-right textarea{
    border-radius:18px;
    box-shadow:none;
    border:1px solid #e5e5e5;
}

.pengaduan-right .btn-submit{
    border-radius:18px;
    padding:14px 24px;
}

.success-card{
    background:#fff;
    border-radius:35px;
    padding:60px;
    box-shadow:0 35px 80px rgba(0,0,0,.12);
}

.success-card h2{
    margin-bottom:1rem;
}
</style>

<div class="pengaduan-hero">

    <div class="container pengaduan-wrap">

        <?php if(session()->getFlashdata('success')): ?>

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="success-card text-center">

                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size:4rem;"></i>
                        </div>

                        <h2>Pengaduan Anda Berhasil Dikirim</h2>

                        <p class="text-muted">
                            Terima kasih telah menyampaikan pengaduan Anda.
                            Kami akan segera menindaklanjuti laporan Anda.
                        </p>

                        <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary btn-lg mt-4">
                            Kembali ke Pengaduan
                        </a>

                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="row g-0 pengaduan-card">

                        <!-- KIRI -->
                        <div class="col-lg-6 pengaduan-left">

                            <h1>Sampaikan Pengaduan Anda</h1>

                            <p>
                                Kami berkomitmen memberikan pelayanan yang cepat,
                                tepat, dan transparan untuk masyarakat.
                                Isi formulir berikut untuk menyampaikan keluhan
                                maupun masukan terkait pengairan.
                            </p>

                            <div class="info-item">

                                <p><strong>Alamat</strong></p>
                                <p>Jl. A.A. Gde Ngurah No. 08, Banyuwangi</p>

                                <p><strong>Telepon</strong></p>
                                <p>(0333) 123456</p>

                                <p><strong>Email</strong></p>
                                <p>pengaduan@pengairan.go.id</p>

                            </div>

                        </div>

                        <!-- KANAN -->
                        <div class="col-lg-6 pengaduan-right">

                            <h3>Form Pengaduan</h3>

                            <form action="<?= base_url('pengaduan/save') ?>" method="post">

                                <?= csrf_field(); ?>

                                <div class="mb-3">

                                    <label class="form-label">Nama Lengkap</label>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">Email</label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">Nomor Telepon</label>

                                    <input
                                        type="text"
                                        name="nomor_telepon"
                                        class="form-control"
                                        required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">Judul Pengaduan</label>

                                    <input
                                        type="text"
                                        name="judul"
                                        class="form-control"
                                        required>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Kategori Pengaduan
                                    </label>

                                    <select
                                        name="kategori"
                                        class="form-select"
                                        required>

                                        <option value="">Pilih Kategori</option>

                                        <option value="banjir">
                                            Banjir
                                        </option>

                                        <option value="bendungan_rusak">
                                            Bendungan Rusak
                                        </option>

                                        <option value="saluran_tersumbat">
                                            Saluran Tersumbat
                                        </option>

                                        <option value="lainnya">
                                            Lainnya
                                        </option>

                                    </select>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Uraian Pengaduan
                                    </label>

                                    <textarea
                                        name="deskripsi"
                                        rows="5"
                                        class="form-control"
                                        required></textarea>

                                </div>

                                <div class="d-grid">

                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-submit">

                                        Kirim Pengaduan

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->include('layout/footer') ?>
