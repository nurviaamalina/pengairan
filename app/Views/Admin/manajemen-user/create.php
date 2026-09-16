<?= $this->include('Admin/layout/header'); ?>

<!-- CSS -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/createusermanajemen.css') ?>"
    >

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <main class="content-wrapper">

        

        <!-- =====================================================
             CONTENT
        ====================================================== -->
        <div class="user-content">


            <!-- =================================================
                 FLASH ERROR
            ================================================== -->
            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>

            <?php endif; ?>


            <!-- =================================================
                 VALIDATION ERROR
            ================================================== -->
            <?php if (session()->getFlashdata('errors')): ?>

                <div class="alert alert-danger">

                    <?php foreach (session()->getFlashdata('errors') as $error): ?>

                        <div>
                            <?= esc($error) ?>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 CARD FORM
            ================================================== -->
            <div class="user-card">


                <!-- CARD HEADER -->
                <div class="card-header-user">

                    <div>

                        <h4>Form Tambah User</h4>

                        <span>
                            Isi data akun pengguna dengan lengkap.
                        </span>

                    </div>

                </div>


                <!-- FORM -->
                <div class="user-form-container">

                    <form
                        action="<?= base_url('admin/manajemen-user/store') ?>"
                        method="post"
                    >

                        <?= csrf_field() ?>


                        <!-- =================================================
                             USERNAME
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="username">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="<?= esc(old('username')) ?>"
                                placeholder="Masukkan username"
                                autocomplete="off"
                                required
                            >

                        </div>


                        <!-- =================================================
                             EMAIL
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="email">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?= esc(old('email')) ?>"
                                placeholder="Masukkan alamat email"
                                autocomplete="off"
                                required
                            >

                        </div>


                        <!-- =================================================
                             PASSWORD
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="password">
                                Password
                            </label>

                            <input
                                type="text"
                                id="password"
                                name="password"
                                value="<?= esc(old('password')) ?>"
                                placeholder="Masukkan password"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        <!-- =================================================
                             ROLE
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="role">
                                Role
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                            >


                                <!-- =================================================
                                     SUPERADMIN
                                     Bisa membuat Admin dan User
                                ================================================== -->
                                <?php if (session()->get('role') === 'superadmin'): ?>

                                    <option value="">
                                        -- Pilih Role --
                                    </option>

                                    <option
                                        value="admin"
                                        <?= old('role') === 'admin' ? 'selected' : '' ?>
                                    >
                                        Admin
                                    </option>

                                    <option
                                        value="user"
                                        <?= old('role') === 'user' ? 'selected' : '' ?>
                                    >
                                        User
                                    </option>


                                <!-- =================================================
                                     ADMIN
                                     Hanya bisa membuat User
                                ================================================== -->
                                <?php elseif (session()->get('role') === 'admin'): ?>

                                    <option value="user">
                                        User
                                    </option>

                                <?php endif; ?>

                            </select>

                        </div>


                        <!-- =================================================
                             STATUS
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="active">
                                Status
                            </label>

                            <select
                                id="active"
                                name="active"
                                required
                            >

                                <option
                                    value="1"
                                    <?= old('active', '1') == '1' ? 'selected' : '' ?>
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    <?= old('active') === '0' ? 'selected' : '' ?>
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        <!-- =================================================
                             BUTTON
                        ================================================== -->
                        <div class="user-form-actions">


                            <!-- SIMPAN -->
                            <button
                                type="submit"
                                class="btn-save-user"
                            >

                                <i class="bi bi-save"></i>

                                Simpan

                            </button>


                            <!-- BATAL -->
                            <a
                                href="<?= base_url('admin/manajemen-user') ?>"
                                class="btn-cancel-user"
                            >

                                <i class="bi bi-arrow-left"></i>

                                Batal

                            </a>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </main>

</div>


<?= $this->include('Admin/layout/footer'); ?>