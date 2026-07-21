<?= $this->include('layout/header') ?>

<style>
.pengaduan-hero {
    background: #f7b500;
    padding: 80px 0 60px;
}
.pengaduan-wrap {
    background: transparent;
}
.pengaduan-card {
    border-radius: 35px;
    overflow: hidden;
    box-shadow: 0 35px 80px rgba(0,0,0,0.12);
}
.pengaduan-left {
    background: #08214c;
    color: #fff;
    padding: 50px;
}
.pengaduan-left h1 {
    font-size: 2.5rem;
    margin-bottom: 1.2rem;
}
.pengaduan-left p,
.pengaduan-left .info-item p {
    color: rgba(255,255,255,0.85);
    line-height: 1.8;
}
.pengaduan-left .info-item {
    margin-top: 2rem;
}
.pengaduan-right {
    background: #fff;
    padding: 50px;
}
.pengaduan-right h3 {
    margin-bottom: 1.5rem;
}
.pengaduan-right .form-control,
.pengaduan-right .form-select,
.pengaduan-right textarea {
    border-radius: 18px;
    box-shadow: none;
    border: 1px solid #e5e5e5;
}
.pengaduan-right .btn-submit {
    border-radius: 18px;
    padding: 14px 24px;
}
.success-card {
    background: #ffffff;
    border-radius: 35px;
    padding: 60px;
    box-shadow: 0 35px 80px rgba(0,0,0,0.12);
}
.success-card h2 {
    margin-bottom: 1rem;
}
</style>

<div class="pengaduan-hero">
    <div class="container pengaduan-wrap">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="success-card text-center">
                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h2>Pengaduan Anda Berhasil Dikirim</h2>
                        <p class="text-muted">Terima kasih telah menyampaikan pengaduan pengaduan Anda. Kami akan menindaklanjuti laporan Anda segera mungkin.</p>
                        <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary btn-lg mt-4">Kembali ke Pengaduan</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-0 pengaduan-card">
                        <div class="col-lg-6 pengaduan-left">
                            <h1>Sampaikan Pengaduan Anda</h1>
                            <p>Kami berkomitmen memberikan pelayanan yang cepat, tepat, dan transparan untuk masyarakat. Isi form berikut untuk menyampaikan keluhan atau masukan terkait pengairan.</p>

                            <div class="info-item">
                                <p><strong>Alamat</strong></p>
                                <p>Jalan Raya Banyuwangi, Banyuwangi</p>
                                <p><strong>Telepon</strong></p>
                                <p>(0333) 123456</p>
                                <p><strong>Email</strong></p>
                                <p>pengaduan@pengairan.go.id</p>
                            </div>
                        </div>
                        <div class="col-lg-6 pengaduan-right">
                            <h3>Form Pengaduan</h3>
                            <form action="<?= base_url('pengaduan/save') ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">No Telp</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Pengaduan</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori Pengaduan</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="banjir">Banjir</option>
                                        <option value="bendungan_rusak">Bendungan Rusak</option>
                                        <option value="saluran_tersumbat">Saluran Tersumbat</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Uraian Pengaduan</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-submit">Submit</button>
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
