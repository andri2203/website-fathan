<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ganti Foto</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profil</a></li>
                        <li class="breadcrumb-item active">Ganti Foto</li>
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
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form id="form" action="/profil/ganti_foto" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputFile">Foto Baru</label>
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
                                <button type="submit" class="btn btn-primary float-right">Ganti Foto</button>
                            </form>
                        </div>
                    </div>
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
        $('#form').validate({
            rules: {
                foto: {
                    required: true,
                    extension: "png|jpe?g"
                },
            },
            messages: {
                foto: {
                    required: "Foto Tidak Boleh Kosong",
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