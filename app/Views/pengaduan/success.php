<?= $this->include('layout/header') ?>

<style>
.success-wrapper {
    background: #f7b500;
    padding: 80px 0 60px;
}
.success-card {
    background: #fff;
    border-radius: 20px;
    padding: 60px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.08);
    max-width: 900px;
    margin: 40px auto;
    text-align: center;
}
.success-card h2 {
    margin-bottom: 12px;
}
.success-card p {
    color: #6c757d;
}
.btn-back {
    margin-top: 20px;
}
</style>

<div class="success-wrapper">
    <div class="container">
        <div class="success-card">
            <div class="mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            </div>
            <h2>Pengaduan Anda Berhasil Dikirim</h2>
            <p>Terima kasih telah menyampaikan pengaduan Anda. Kami akan menindaklanjuti laporan Anda segera mungkin.</p>
            <?php if(!empty($tracking_code)): ?>
                <p>Kode pelacakan Anda: <strong><?= esc($tracking_code) ?></strong></p>
                <a href="<?= base_url('pengaduan/track') ?>" class="btn btn-primary">Lacak Pengaduan</a>
            <?php else: ?>
                <a href="<?= base_url('pengaduan') ?>" class="btn btn-outline-primary btn-back">Kembali ke Pengaduan</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
