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
        <li class="menu-dropdown">

            <a class="menu-link" data-bs-toggle="collapse" href="#profilMenu">
                <div>
                    <i class="bi bi-person"></i>
                    <span>Profil</span>
                </div>

                <i class="bi bi-chevron-down"></i>
            </a>

            <div class="collapse" id="profilMenu">

                <a href="<?= base_url('admin/profil/visi-misi') ?>" class="submenu">
                    Visi & Misi
                </a>

                <a href="<?= base_url('admin/profil/sejarah') ?>" class="submenu">
                    Sejarah
                </a>

                <a href="<?= base_url('admin/profil/struktur') ?>" class="submenu">
                    Struktur Organisasi
                </a>

            </div>

        </li>

        <!-- Layanan -->
        <li class="menu-dropdown">

            <a class="menu-link" data-bs-toggle="collapse" href="#layananMenu">

                <div>
                    <i class="bi bi-grid"></i>
                    <span>Layanan</span>
                </div>

                <i class="bi bi-chevron-down"></i>

            </a>

            <div class="collapse" id="layananMenu">

                <a href="<?= base_url('admin/pengaduan') ?>"
                class="submenu <?= $uri->getSegment(2) == 'pengaduan' ? 'active' : '' ?>">
                    Pengaduan
                </a>

                <a href="<?= base_url('admin/korsda') ?>"
                class="submenu <?= $uri->getSegment(2) == 'korsda' ? 'active' : '' ?>">
                    Korsda
                </a>

                <a href="<?= base_url('admin/live-cctv') ?>"
                class="submenu <?= $uri->getSegment(2) == 'live-cctv' ? 'active' : '' ?>">
                    Live CCTV
                </a>

</div>

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

    </ul>

</div>