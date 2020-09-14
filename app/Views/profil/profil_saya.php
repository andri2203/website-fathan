<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profil Saya</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profil</a></li>
                        <li class="breadcrumb-item active">Profil Saya</li>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="row">
                                <div class="col-md-4 pr-4 border-right">
                                    <div class="text-center">
                                        <?php if ($user->image == '') : ?>
                                            <img src="/src/images/default.jpg" class="profile-user-img img-fluid img-circle">
                                        <?php else : ?>
                                            <img src="/uploads/<?= $session->id ?>/<?= $user->image ?>" class="profile-user-img img-fluid img-circle">
                                        <?php endif ?>
                                    </div>
                                    <h3 class="profile-username text-center"><?= $user->name ?></h3>

                                    <p class="text-muted text-center"><?= $session->role ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?= $user->email ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>No. Telp</b> <a class="float-right"><?= $user->phone ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="float-right"><?= $user->gender ?></a>
                                        </li>
                                    </ul>
                                    <div class="btn-group btn-block">
                                        <a href="/profil/password" class="btn btn-warning"><b>Ganti Password</b></a>
                                        <a href="/profil/foto" class="btn btn-primary"><b>Ubah Foto</b></a>
                                    </div>
                                </div>
                                <div class="col-md-8 px-4 pt-2">
                                    <?php if ($session->getFlashdata('berhasil')) : ?>
                                        <div class="alert alert-success mb-3">
                                            <button type="menu" class="close" data-dismiss="alert" aria-hidden="true"><i class="fas fa-times"></i></button>
                                            <h5>
                                                <i class="icon fas fa-check"> <?= $session->getFlashdata('berhasil') ?></i>
                                            </h5>
                                            <?= $session->getFlashdata('berhasil') ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-uppercase w-100 mb-3">Ubah Data Diri</h3>
                                            <form action="/profil/profil_saya" method="post" id="form" class="form-horizontal" autocomplete="off">
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" id="name" class="form-control" value="<?= $user->name ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="email" id="email" class="form-control" value="<?= $user->email ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="phone" class="col-sm-3 col-form-label">No. Telp</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="phone" id="phone" class="form-control" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right">Ubah</button>
                                            </form>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <h3 class="text-uppercase w-100 mb-3">Upluad Foto KTP</h3>
                                            <img src="<?= $user->ktp == "" ? "/uploads/no-image-selected.gif" : "/uploads/{$session->id}/ktp/{$user->ktp}" ?>" alt="" class="img-fluid mb-2">
                                            <form action="/profil/foto_ktp" method="post" id="form_upload" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Foto KTP</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="foto" id="foto">
                                                            <label class="custom-file-label" for="foto">Pilih Gambar</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="">Upload</span>
                                                        </div>
                                                    </div>
                                                    <div id="error_file"></div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right">upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
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
<?= $this->section('script'); ?>
<script src="/dist/jquery-validation/jquery.validate.min.js"></script>
<script src="/dist/jquery-validation/additional-methods.min.js"></script>
<script src="/dist/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
    $(function() {
        $.validator.addMethod("notEqualTo", function(value, element, param) {
            var target = $(param);
            if (value) return value != target.val();
            else return this.optional(element);
        }, "Does not match");
        $('#form_upload').validate({
            rules: {
                foto: {
                    required: true,
                    extension: "png|jpe?g"
                },
            },
            messages: {
                foto: {
                    required: "Foto KTP Tidak Boleh Kosong",
                    extension: "Ekstensi foto hanya bisa PNG, JPEG dan JPG",
                },
            },
            errorPlacement: function(error, element) {
                element.parents(".form-group").find("#error_file").append(error);
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
<?= $this->endSection('script'); ?>