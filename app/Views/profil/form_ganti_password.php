<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ganti Password</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profil</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
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
                <div class="col-lg-6 ">
                    <div class="card card-primary card-outline">
                        <form action="/profil/ganti_password" method="post" id="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="current_password">Password Lama</label>
                                    <input type="password" name="current_password" id="current_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password baru</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password baru</label>
                                    <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                                <a href="/profil/profil_saya" class="btn btn-default">Kembali</a>
                            </div>
                        </form>
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

<?= $this->section('script') ?>
<script src="/dist/jquery-validation/jquery.validate.min.js"></script>
<script src="/dist/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript">
    $(function() {
        $.validator.addMethod("notEqualTo", function(value, element, param) {
            var target = $(param);
            if (value) return value != target.val();
            else return this.optional(element);
        }, "Does not match");
        $('#form').validate({
            rules: {
                current_password: {
                    required: true,
                    minlength: 5,
                    remote: '/profile/password_checker'
                },
                new_password: {
                    notEqualTo: '#current_password',
                    minlength: 5,
                    required: true,
                },
                konfirmasi_password: {
                    required: true,
                    equalTo: "#new_password"
                },
            },
            messages: {
                current_password: {
                    required: "Password Lama Tidak Boleh Kosong",
                    minlength: "Password Harus berjumlah 5 karakter",
                    remote: "Password yang anda masukkan salah"
                },
                new_password: {
                    required: "Password Baru Tidak Boleh Kosong",
                    minlength: "Password Harus berjumlah 5 karakter",
                    notEqualTo: "Password baru tidak boleh sama dengan yang lama",
                },
                konfirmasi_password: {
                    required: "Konfirmasi Password Boleh Kosong",
                    equalTo: "Mohon masukkan password yang sama seperti di kolom Password baru"
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