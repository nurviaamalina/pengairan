<?php
$uri = service('uri');
?>

<div class="sidebar">

    <ul class="sidebar-menu">

        <!-- Beranda -->
        <li>
            <a href="<?= base_url('admin/dashboard') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-house-door"></i>
                <span>Beranda</span>
            </a>
        </li>

        <!-- Profil -->
        <li>
            <a href="<?= base_url('admin/profil') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'profil' ? 'active' : '' ?>">
                <i class="bi bi-building"></i>
                <span>Profil</span>
            </a>
        </li>

        <!-- KORSDA -->
        <li>
            <a href="<?= base_url('admin/korsda/dashboard') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'korsda' ? 'active' : '' ?>">
                <i class="bi bi-grid"></i>
                <span>KORSDA</span>
            </a>
        </li>

        <!-- Dokumen -->
        <li>
            <a href="<?= base_url('admin/dokumen') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'dokumen' ? 'active' : '' ?>">
                <i class="bi bi-folder"></i>
                <span>Dokumen</span>
            </a>
        </li>

        <!-- Pengaduan -->
        <li>
            <a href="<?= base_url('admin/pengaduan') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'pengaduan' ? 'active' : '' ?>">
                <i class="bi bi-envelope"></i>
                <span>Pengaduan</span>
            </a>
        </li>

        <!-- Berita -->
        <li>
            <a href="<?= base_url('admin/berita') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'berita' ? 'active' : '' ?>">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>

        <!-- Kegiatan -->
        <li>
            <a href="<?= base_url('admin/kegiatan') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'kegiatan' ? 'active' : '' ?>">
                <i class="bi bi-camera"></i>
                <span>Kegiatan</span>
            </a>
        </li>

        <!-- Instagram -->
        <li>
            <a href="<?= base_url('admin/instagram') ?>"
               class="menu-link <?= $uri->getSegment(2) == 'instagram' ? 'active' : '' ?>">
                <i class="bi bi-instagram"></i>
                <span>Instagram</span>
            </a>
        </li>

    </ul>

</div>