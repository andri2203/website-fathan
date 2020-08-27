<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengaturan Sub Menu</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                        <li class="breadcrumb-item active">Pengaturan Sub Menu</li>
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
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h5 class="card-title">Info</h5>
                    <div class="card-tools">
                        <button class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">Pastikan bahwa anda memberi Sub Menu dengan benar. Setiap perubahan Sub Menu akan berpengaruh pada Routing URL Website</p>
                    <p class="card-text">Aturan Membuat Sub Menu:</p>
                    <ol class="card-text">
                        <li>Sesuaikan Sub Menu dengan Method Controller Routing</li>
                        <li>Method Sub Menu harus berupa huruf kecil. ("Kolom Route")</li>
                        <li>Jangan berikan spasi dan "-" di kolom Sub Menu. ("Kolom Route")</li>
                    </ol>
                </div>
            </div>
            <?php if ($session->getFlashdata('menu')) : ?>
                <div class="alert alert-success">
                    <button type="menu" class="close" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times"></i></button>
                    <h5>
                        <i class="icon fas fa-check"> Berhasil</i>
                    </h5>
                    <?= $session->getFlashdata('menu') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Sub Menu</th>
                                            <th>Menu</th>
                                            <th>Route</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($subMenu as $sm) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $sm['sub_menu'] ?></td>
                                                <td><?= $sm['menu'] ?></td>
                                                <td><?= $sm['sub_route'] ?></td>
                                                <td>
                                                    <div class="input-group">
                                                        <a href="/admin/pengaturan/sub_menu/<?= $sm['sub_menu_id'] ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="/admin/pengaturan/hapus_sub_menu/<?= $sm['sub_menu_id'] ?>" onclick="return confirm('Yakin ingin menghapus Sub Menu <?= $sm['sub_menu'] ?> ')" class="btn btn-default"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-5">
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
        $('#form_menu').validate({
            rules: {
                menu: {
                    required: true,
                },
                sub_menu: {
                    required: true,
                },
                route: {
                    required: true,
                    normalizer: function(value) {
                        let validCamelCase = name => !name.match(/[\s_-]/g);
                        let camelize = function(str) {
                            return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
                                return word.toLowerCase();
                            }).replace(/[\s-]/g, '');
                        }
                        $('#route').val(camelize(value));
                        return camelize(value);
                    },
                },
            },
            messages: {
                menu: {
                    required: "Menu Tidak Boleh Kosong",
                },
                sub_menu: {
                    required: "Sub Menu Tidak Boleh Kosong",
                },
                route: {
                    required: "Route Tidak Boleh Kosong",
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