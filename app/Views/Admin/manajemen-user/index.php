<?= $this->include('Admin/layout/header'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/manajemen-user.css') ?>">

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <main class="content-wrapper">

        <div class="user-content">

            <!-- ALERT SUCCESS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!-- ALERT ERROR -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- ALERT VALIDATION -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <div><?= esc($error) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <!-- CARD -->
            <div class="user-card">

                <!-- CARD HEADER -->
                <div class="card-header-user">

                    <div class="user-card-title">
                        <h4>Daftar User</h4>
                        <span>Total User: <?= count($users) ?></span>
                    </div>

                    <a
                        href="<?= base_url('admin/manajemen-user/create') ?>"
                        class="btn-add-user"
                    >
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Tambah User</span>
                    </a>

                </div>


                <!-- TABLE -->
                <div class="table-responsive">

                    <table class="table-user">

                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th class="col-action">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($users)): ?>

                                <?php foreach ($users as $key => $user): ?>

                                    <tr>

                                        <!-- NO -->
                                        <td class="text-center col-no">
                                            <?= $key + 1 ?>
                                        </td>


                                        <!-- USERNAME -->
                                        <td>
                                            <div class="user-info">

                                                <div class="user-avatar">
                                                    <?= strtoupper(
                                                        substr($user['username'], 0, 1)
                                                    ) ?>
                                                </div>

                                                <div class="user-name">
                                                    <strong>
                                                        <?= esc($user['username']) ?>
                                                    </strong>
                                                </div>

                                            </div>
                                        </td>


                                        <!-- EMAIL -->
                                        <td>
                                            <span class="email-text">
                                                <?= esc($user['email']) ?>
                                            </span>
                                        </td>


                                        <!-- PASSWORD -->
                                        <td>

                                            <details class="password-details">

                                                <summary
                                                    class="password-toggle"
                                                    title="Tampilkan kata sandi"
                                                >
                                                    <i class="bi bi-eye"></i>
                                                </summary>

                                                <span class="user-password">
                                                    <?= esc($user['password']) ?>
                                                </span>

                                            </details>

                                        </td>


                                        <!-- ROLE -->
                                        <td>

                                            <?php if ($user['role'] === 'superadmin'): ?>

                                                <span class="badge-role superadmin">
                                                    Superadmin
                                                </span>

                                            <?php elseif ($user['role'] === 'admin'): ?>

                                                <span class="badge-role admin">
                                                    Admin
                                                </span>

                                            <?php else: ?>

                                                <span class="badge-role user">
                                                    User
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <!-- STATUS -->
                                        <td>

                                            <?php if ((int) $user['active'] === 1): ?>

                                                <span class="badge-status active">
                                                    Aktif
                                                </span>

                                            <?php else: ?>

                                                <span class="badge-status inactive">
                                                    Tidak Aktif
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <!-- TANGGAL -->
                                        <td>

                                            <span class="date-text">

                                                <?php if (!empty($user['created_at'])): ?>

                                                    <?= date(
                                                        'd M Y H:i',
                                                        strtotime($user['created_at'])
                                                    ) ?>

                                                <?php else: ?>

                                                    -

                                                <?php endif; ?>

                                            </span>

                                        </td>


                                        <!-- AKSI -->
                                        <td class="action-column">

                                            <?php if (
                                                (int) $user['id'] ===
                                                (int) session()->get('id')
                                            ): ?>

                                                <span class="akun-sendiri">
                                                    <i class="bi bi-person-check"></i>
                                                    Akun Saya
                                                </span>

                                            <?php else: ?>

                                                <div class="user-actions">

                                                    <!-- EDIT -->
                                                    <a
                                                        href="<?= base_url(
                                                            'admin/manajemen-user/edit/' . $user['id']
                                                        ) ?>"
                                                        class="btn-action btn-edit"
                                                        title="Edit User"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>


                                                    <!-- HAPUS -->
                                                    <form
                                                        action="<?= base_url(
                                                            'admin/manajemen-user/delete/' . $user['id']
                                                        ) ?>"
                                                        method="post"
                                                        class="action-form"
                                                    >

                                                        <?= csrf_field() ?>

                                                        <button
                                                            type="submit"
                                                            class="btn-action btn-delete"
                                                            title="Hapus User"
                                                        >
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </form>

                                                </div>

                                            <?php endif; ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="8" class="empty-user">

                                        <i class="bi bi-people"></i>

                                        <p>
                                            Belum ada user terdaftar.
                                        </p>

                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

</div>

<?= $this->include('Admin/layout/footer'); ?>