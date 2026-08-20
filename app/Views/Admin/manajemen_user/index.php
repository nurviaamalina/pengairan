<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <div class="main">

        <div class="topbar">
            <div>
                <h3>Manajemen User</h3>
                <p>Daftar seluruh akun yang terdaftar di sistem.</p>
            </div>
        </div>


        <div class="content">

            <!-- PESAN SUCCESS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>


            <!-- PESAN ERROR -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>


            <div class="user-card">

                <div class="card-header-user">
                    <div>
                        <h4>Daftar User</h4>
                        <span>
                            Total User: <?= count($users) ?>
                        </span>
                    </div>
                </div>


                <div class="table-responsive">

                    <table class="table-user">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($users)): ?>

                                <?php foreach ($users as $key => $user): ?>

                                    <tr>

                                        <td>
                                            <?= $key + 1 ?>
                                        </td>


                                        <td>
                                            <div class="user-info">

                                                <div class="user-avatar">
                                                    <?= strtoupper(
                                                        substr(
                                                            $user['username'],
                                                            0,
                                                            1
                                                        )
                                                    ) ?>
                                                </div>

                                                <strong>
                                                    <?= esc($user['username']) ?>
                                                </strong>

                                            </div>
                                        </td>


                                        <td>
                                            <?= esc($user['email']) ?>
                                        </td>


                                        <td>

                                            <?php if ($user['role'] === 'admin'): ?>

                                                <span class="badge-role admin">
                                                    Admin
                                                </span>

                                            <?php else: ?>

                                                <span class="badge-role user">
                                                    User
                                                </span>

                                            <?php endif; ?>

                                        </td>


                                        <td>

                                            <?php if ($user['created_at']): ?>

                                                <?= date(
                                                    'd M Y H:i',
                                                    strtotime($user['created_at'])
                                                ) ?>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>


                                        <td>

                                            <?php if ($user['id'] != session()->get('id')): ?>

                                                <form
                                                    action="<?= base_url(
                                                        'admin/manajemen-user/delete/' . $user['id']
                                                    ) ?>"
                                                    method="post"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                                >

                                                    <?= csrf_field() ?>

                                                    <input
                                                        type="hidden"
                                                        name="_method"
                                                        value="DELETE"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn-delete"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                        Hapus
                                                    </button>

                                                </form>

                                            <?php else: ?>

                                                <span class="akun-sendiri">
                                                    Akun Saya
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td colspan="6" class="empty-user">

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

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>