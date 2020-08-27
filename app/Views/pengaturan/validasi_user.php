<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengaturan Menu User</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                        <li class="breadcrumb-item active">Pengaturan Menu User</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Tabel Validasi User</h5>

                    <div class="card-tools">
                        <?php if ($id_role != null) : ?>
                            <a href="/admin/pengaturan/validasi_user" class="btn btn-sm btn-default">Kembali</a>
                        <?php endif;
                        foreach ($role as $data) : ?>
                            <a href="/admin/pengaturan/validasi_user/<?= $data['role_id'] ?>" class="btn btn-sm <?= $data['role_id'] == $id_role ? 'btn-primary' : 'btn-default' ?>"><?= $data['role'] ?></a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-title mb-3">Pilih User yang akan di validasi</h6>

                    <div id="message"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jenis Akun</th>
                                    <th>No. Telp</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user as $data) : ?>
                                    <tr>
                                        <td>
                                            <?php if ($data['is_active'] == 1) : ?>
                                                <span class="btn btn-xs btn-success"><i class="fas fa-check"></i></span>
                                            <?php else : ?>
                                                <a href="/pengaturan/edit_validasi_user/<?= $data['users_id'] ?>" class="btn btn-warning" onclick="return confirm('Yakin ingin aktifkan akun ini?')">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['role'] ?></td>
                                        <td><?= $data['phone'] ?></td>
                                        <td><?= $data['image'] ?></td>
                                        <td>
                                            <?php if ($data['is_active'] == 1) : ?>
                                                <span class="btn btn-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="btn btn-warning">Belum Aktif</span>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>