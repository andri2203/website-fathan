<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fathan MC - Register</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="stylesheet" href="/src/css/sign-style.css" />
</head>

<body>
  <!-- Main Wrapper::Start -->
  <main class="wrapper register">
    <header>
      <div class="container">
        <a href="/">
          <h4 class="text-uppercase font-weight-bold">
            Fathan's <span class="text-danger">MC</span>
          </h4>
        </a>
      </div>
    </header>
    <form action="/register/proses" method="POST" id="login-form">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="login-group">
              <input type="text" name="nama" id="nama" class="login-input" autocomplete="nama" autofocus required />
              <label for="nama" class="placeholder">nama lengkap</label>
            </div>
            <div class="login-group">
              <input type="text" name="email" id="email" class="login-input" autocomplete="email" autofocus required />
              <label for="email" class="placeholder">email</label>
            </div>
            <div class="login-group">
              <input type="text" name="phone" id="phone" class="login-input" autocomplete="phone" autofocus required />
              <label for="phone" class="placeholder">phone</label>
            </div>
            <div class="login-group">
              <label class="small">Daftar Sebagai</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="user_role" id="role_konsumen" value="3" checked />
                <label class="form-check-label small" for="role_konsumen">
                  Konsumen
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="user_role" id="role_mc" value="2" />
                <label class="form-check-label small" for="role_mc">
                  MC
                </label>
              </div>
            </div>
            <div class="login-group">
              <label class="small">Jenis Kelamin</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="laki_laki" value="Laki - Laki" checked />
                <label class="form-check-label small" for="laki_laki">
                  Laki - Laki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" />
                <label class="form-check-label small" for="perempuan">
                  Perempuan
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="login-group">
              <input type="password" name="password" id="password" class="login-input" autocomplete="current-password" required />
              <label for="password" class="placeholder">password</label>
            </div>
            <div class="login-group">
              <input type="password" name="confirm" id="confirm" class="login-input" autocomplete="confirm-password" required />
              <label for="confirm" class="placeholder">Konfirmasi password</label>
            </div>
            <p class="register">
              Sudah memiliki Akun?
              <a href="/login" class="register-text">Masuk Sekarang</a>
            </p>
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-arrow-right fa-2x"></i>
            </button>
          </div>
        </div>
      </div>
    </form>

    <footer>
      <div class="container">
        &copy; All Right Reserved
      </div>
    </footer>
  </main>
  <!-- Main Wrapper::End -->

  <!-- Script -->
  <script src="/src/js/signup.bundle.js"></script>
</body>

</html>