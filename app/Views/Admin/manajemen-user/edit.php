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
                 FLASH SUCCESS
            ================================================== -->
            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
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


                <!-- =================================================
                     CARD HEADER
                ================================================== -->
                <div class="card-header-user">

                    <div>

                        <h4>Form Edit User</h4>

                        <span>
                            Perbarui informasi akun pengguna.
                        </span>

                    </div>

                </div>


                <!-- =================================================
                     FORM
                ================================================== -->
                <div class="user-form-container">

                    <form
                        action="<?= base_url('admin/manajemen-user/update/' . $user['id']) ?>"
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
                                value="<?= esc(old('username', $user['username'])) ?>"
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
                                value="<?= esc(old('email', $user['email'])) ?>"
                                placeholder="Masukkan email"
                                autocomplete="off"
                                required
                            >

                        </div>


                        <!-- =================================================
                             PASSWORD
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="password">
                                Password Baru
                            </label>

                            <input
                                type="text"
                                id="password"
                                name="password"
                                value=""
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                                autocomplete="new-password"
                            >

                            <small class="form-help-user">
                                Kosongkan jika password tidak ingin diubah.
                            </small>

                        </div>


                        <!-- =================================================
                             ROLE
                        ================================================== -->
                        <div class="form-group-user">

                            <label for="role">
                                Role
                            </label>


                            <?php if (session()->get('role') === 'superadmin'): ?>

                                <!-- SUPERADMIN -->
                                <select
                                    id="role"
                                    name="role"
                                    required
                                >

                                    <option
                                        value="admin"
                                        <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>
                                    >
                                        Admin
                                    </option>

                                    <option
                                        value="user"
                                        <?= old('role', $user['role']) === 'user' ? 'selected' : '' ?>
                                    >
                                        User
                                    </option>

                                </select>


                            <?php else: ?>

                                <!-- ADMIN -->
                                <input
                                    type="hidden"
                                    name="role"
                                    value="user"
                                >

                                <input
                                    type="text"
                                    class="role-readonly"
                                    value="User"
                                    readonly
                                >

                            <?php endif; ?>

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
                                    <?= old('active', $user['active']) == '1' ? 'selected' : '' ?>
                                >
                                    Aktif
                                </option>

                                <option
                                    value="0"
                                    <?= old('active', $user['active']) == '0' ? 'selected' : '' ?>
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

                                Simpan Perubahan

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