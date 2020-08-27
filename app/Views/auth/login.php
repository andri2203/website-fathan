<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fathan MC - Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
  <link rel="stylesheet" href="/src/css/sign-style.css" />
</head>

<body>
  <!-- Main Wrapper::Start -->
  <main class="wrapper">
    <header>
      <div class="container">
        <a href="/">
          <h4 class="text-uppercase font-weight-bold">
            Fathan's <span class="text-danger">MC</span>
          </h4>
        </a>
      </div>
    </header>
    <?php if ($session->getFlashdata('login')) : ?>
      <div class="alert alert-danger"><?= $session->getFlashdata('login') ?></div>
    <?php endif ?>
    <form action="/login/proses" method="POST" id="login-form">
      <div class="login-group">
        <input type="text" name="email" id="email" class="login-input" value="<?= old('email') ?>" autocomplete="email" autofocus required />
        <label for="email" class="placeholder">email</label>
        <div class="feedback"></div>
      </div>
      <div class="login-group">
        <input type="password" name="password" id="password" class="login-input" autocomplete="current-password" required />
        <label for="password" class="placeholder">password</label>
        <div class="feedback"></div>
      </div>
      <p class="register">
        Belum memiliki Akun?
        <a href="/register" class="register-text">Daftar Sekarang</a>
      </p>
      <button type="submit" class="btn btn-danger">
        <i class="fa fa-arrow-right fa-2x"></i>
      </button>
    </form>

    <footer>
      <div class="container">
        &copy; All Right Reserved
      </div>
    </footer>
  </main>
  <!-- Main Wrapper::End -->

  <!-- Script -->
  <script src="/src/js/signin.bundle.js"></script>
</body>

</html>