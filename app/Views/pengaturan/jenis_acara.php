<?= $this->extend('default') ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="/dist/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<?= $this->endSection('link'); ?>
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
            <?php if ($session->getFlashdata('acara')) : ?>
                <div class="alert alert-success">
                    <button type="menu" class="close" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times"></i></button>
                    <h5>
                        <i class="icon fas fa-check"> Berhasil</i>
                    </h5>
                    <?= $session->getFlashdata('acara') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Tabel Jenis Acara</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Acara</th>
                                            <th>Kode Warna</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($jenis_acara as $row) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $row['jenis_acara'] ?></td>
                                                <td><?= $row['kode_warna'] ?> <span><i class="fas fa-square" style="color: <?= $row['kode_warna'] ?>;"></i></span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="/admin/pengaturan/jenis_acara/<?= $row['id_jenis_acara'] ?>" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="/admin/pengaturan/hapus_jenis_acara/<?= $row['id_jenis_acara'] ?>" class="btn btn-default" onclick="return confirm('Yakin ingin dihapus?')"> <i class="fas fa-trash"></i></a>
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
                <div class="col-lg-5">
                    <?= $this->include('pengaturan/form/' . $form) ?>
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
<script src="/dist/moment/moment.min.js"></script>
<script src="/dist/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.color-picker .col-sm-1').css('background-color', $("#kode_warna").data('default-color'));
        $(".color-picker").colorpicker()
        $('.color-picker').on('colorpickerChange', function(event) {
            $('.color-picker .col-sm-1').css('background-color', event.color.toString());
        });
        $('#form').validate({
            rules: {
                jenis_acara: {
                    required: true,
                },
                kode_warna: {
                    required: true,
                },
            },
            messages: {
                jenis_acara: {
                    required: "Jenis Acara Tidak Boleh Kosong",
                },
                kode_warna: {
                    required: "Kode Warna Tidak Boleh Kosong",
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