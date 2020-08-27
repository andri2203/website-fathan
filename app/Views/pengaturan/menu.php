<?= $this->extend('default') ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengaturan Menu</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                        <li class="breadcrumb-item active">Pengaturan Menu</li>
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
                    <p class="card-text">Pastikan bahwa anda memberi Class Menu dengan benar. Setiap perubahan Class Menu akan berpengaruh pada Routing URL Website</p>
                    <p class="card-text">Aturan Membuat Menu:</p>
                    <ol class="card-text">
                        <li>Sesuaikan Menu Class dengan Class Controller Routing</li>
                        <li>Isi Ikon sesuai selera <a href="https://www.fontawsome.com/icon" target="_blank" class="card-link">Ikon dapat dilihat disini</a></li>
                        <li>Jangan berikan spasi di kolom class. contoh benar ("NamaClass").</li>
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
                            <h5 class="m-0">Tabel Menu</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Menu</th>
                                            <th>Class</th>
                                            <th>Ikon</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($menu as $row) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $row['menu'] ?></td>
                                                <td><?= $row['route'] ?></td>
                                                <td><i class="<?= $row['icon'] ?>"></i> <span class="small"><?= $row['icon'] ?></span></td>
                                                <td>
                                                    <?php if ($row['is_active'] == 1) : ?>
                                                        Aktif
                                                    <?php else : ?>
                                                        Non Aktif
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <?php if ($row['menu_id'] != $id) : ?>
                                                            <a href="/admin/pengaturan/menu/<?= $row['menu_id'] ?>" class="btn btn-warning">Edit</a>
                                                        <?php endif ?>
                                                        <a href="/admin/pengaturan/hapus_menu/<?= $row['menu_id'] ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Hapus Menu <?= $row['menu'] ?>?')">Hapus</a>
                                                        <?php if ($row['is_active'] == 1) : ?>
                                                            <a href="/pengaturan/non_aktif_menu/<?= $row['menu_id'] ?>" class="btn btn-default" title="Non Aktifkan Menu"><i class="fas fa-eye"></i></a>
                                                        <?php else : ?>
                                                            <a href="/pengaturan/aktif_menu/<?= $row['menu_id'] ?>" class="btn btn-default" title="Aktifkan Menu"><i class="fas fa-eye-slash"></i></a>
                                                        <?php endif ?>
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
                <?= $this->include('pengaturan/form/' . $form) ?>
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
                ikon: {
                    required: true,
                },
                class_routing: {
                    required: true,
                    normalizer: function(value) {
                        let validCamelCase = name => !name.match(/[\s_-]/g);
                        let camelize = function(str) {
                            return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
                                return word.toUpperCase();
                            }).replace(/[\s_-]/g, '');
                        }
                        $('#class_routing').val(camelize(value));
                        return camelize(value);
                    },
                },
            },
            messages: {
                menu: {
                    required: "Menu Tidak Boleh Kosong",
                },
                ikon: {
                    required: "Ikon Tidak Boleh Kosong",
                },
                class_routing: {
                    required: "Class Menu Tidak Boleh Kosong",
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