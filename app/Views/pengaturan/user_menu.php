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
            <?php if ($session->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <button type="menu" class="close" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times"></i></button>
                    <h5>
                        <i class="icon fas fa-check"> Berhasil</i>
                    </h5>
                    <?= $session->getFlashdata('success') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Tabel Menu User</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Menu</th>
                                            <th>User Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($userMenu as $UM) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $UM['menu'] ?></td>
                                                <td><?= $UM['role'] ?></td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="/admin/pengaturan/user_menu/<?= $UM['user_menu_id'] ?>" class="btn btn-primary">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <a href="/admin/pengaturan/hapus_user_menu/<?= $UM['user_menu_id'] ?>" onclick="return confirm('Apakah Anda yakin ingin hapus akses menu <?= $UM['menu'] ?> untuk <?= $UM['role'] ?>')" class="btn btn-default">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <?= $this->include('pengaturan/form/' . $form); ?>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>
<?= $this->section('script') ?>
<script src="/dist/jquery-validation/jquery.validate.min.js"></script>
<script src="/dist/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#form').validate({
            rules: {
                menu: {
                    required: true,
                },
                role: {
                    required: true,
                },
            },
            messages: {
                menu: {
                    required: "Menu Tidak Boleh Kosong",
                },
                role: {
                    required: "Role Tidak Boleh Kosong",
                },
            },
            highlight: function(el) {
                $(el)
                    .removeClass("is-valid")
                    .addClass("is-invalid");
            },
            unhighlight: function(el) {
                $(el)
                    .removeClass("is-invalid")
                    .addClass("is-valid");
            },
        })
    })
</script>
<?= $this->endSection('script') ?>