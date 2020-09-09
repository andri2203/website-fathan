<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMCee | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/dist/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/dist/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/src/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        span.headtext {
            font-family:"SCRIPT MT";
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
<span class="headtext font-weight-bold">eMCee<span class="text-danger"> E = MC<sup>2</sup></span>
        </span></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if ($session->getFlashdata('login')) : ?>
                    <div class="alert alert-danger"><?= $session->getFlashdata('login') ?></div>
                <?php endif ?>

                <form id="form" action="/admin/login" method="post">
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?= old('email') ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="row justify-content-end">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/dist/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/src/js/adminlte.min.js"></script>
    <script src="/dist/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $(function() {
            $('#form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5,
                    },
                },
                messages: {
                    email: {
                        required: "Email Tidak Boleh Kosong",
                        email: "Email tidak valid",
                    },
                    password: {
                        required: "Password Tidak Boleh Kosong",
                        minlength: "Password Harus berjumlah 5 karakter",
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
            });
        })
    </script>

</body>

</html>