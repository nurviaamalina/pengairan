<footer class="footer">

    <div class="container">

        <div class="row align-items-start g-4">

            <!-- ================= LEFT ================= -->
            <div class="col-lg-6">

                <div class="footer-logo d-flex align-items-center">

                    <img src="<?= base_url('assets/images/pemkab.png') ?>" alt="Pemkab Banyuwangi" class="footer-logo-img me-2">
                    <img src="<?= base_url('assets/images/pu.png') ?>" alt="Dinas Pengairan" class="footer-logo-img">

                    <div class="ms-3 footer-text">

                        <h5>Dinas Pekerjaan Umum Pengairan</h5>
                        <h6>Pemerintah Kabupaten Banyuwangi</h6>

                    </div>

                </div>

                <p class="footer-desc mt-3">
                    Dinas Pekerjaan Umum Pengairan berkomitmen mengelola sumber daya air secara
                    terpadu, berkelanjutan, dan berwawasan lingkungan demi kesejahteraan masyarakat Banyuwangi.
                </p>

                <div class="footer-contact mt-3">

                    <p>
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jl. K.H. Agus Salim No. 85, Lingkungan Cuking, Mojopanggung, Kec. Giri, Kabupaten Banyuwangi, Jawa Timur 68425</span>
                    </p>

                    <div class="row g-2">

                        <div class="col-sm-6">
                            <p>
                                <i class="fa-solid fa-phone"></i>
                                <span>(0333) 424676</span>
                            </p>
                        </div>

                        <div class="col-sm-6">
                            <p>
                                <i class="fa-solid fa-envelope"></i>
                                <span>dinaspengairan2@gmail.com</span>
                            </p>
                        </div>

                    </div>

                </div>

                <div class="social-media mt-3">

                    <span class="me-2">Media Sosial:</span>

                    <a href="https://www.instagram.com/dinas_pengairan.bwi/" target="_blank" rel="noopener noreferrer" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/pengairanbanyuwangi/?locale=id_ID" target="_blank" rel="noopener noreferrer" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://x.com/PengairanBwi" target="_blank" rel="noopener noreferrer" title="X (Twitter)">
                        <i class="fab fa-twitter"></i>
                    </a>

                </div>

            </div>

            <!-- ================= RIGHT ================= -->
            <div class="col-lg-6 footer-menu">

                <div class="row g-4">

                    <div class="col-4">

                        <h6>PROFIL</h6>

                        <ul>
                            <li>
                                <a href="<?= site_url('tentang-kami') ?>#sejarah-singkat">
                                    Sejarah Singkat
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('tentang-kami') ?>#visi-misi">
                                    Visi &amp; Misi
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url('tentang-kami') ?>#struktur-organisasi">
                                    Struktur
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="col-4">

                        <h6>LAYANAN</h6>

                        <ul>
                            <li><a href="<?= base_url('korsda') ?>">KORSDA</a></li>
                            <li><a href="<?= base_url('pengaduan') ?>">Pengaduan</a></li>
                            <li>
                                <a href="https://live.banyuwangikab.go.id/page/cctv?area=PANTAU%20SUNGAI" target="_blank" rel="noopener noreferrer">
                                    Live CCTV
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="col-4">

                        <h6>INFORMASI</h6>

                        <ul>
                            <li><a href="<?= site_url('dokumen') ?>">Dokumen</a></li>
                            <li><a href="<?= site_url('berita') ?>">Berita</a></li>
                            <li><a href="<?= site_url('kegiatan') ?>">Kegiatan</a></li>
                        </ul>

                    </div>

                </div>

            </div>

        </div>

        <div class="footer-divider"></div>

        <div class="copyright">

            &copy; <?= date('Y') ?> Dinas Pekerjaan Umum Pengairan Kabupaten Banyuwangi. Hak Cipta Dilindungi.

        </div>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>