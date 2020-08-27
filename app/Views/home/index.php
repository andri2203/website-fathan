<?php date_default_timezone_get('Asia/Jakarta') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Jekyll v4.1.1" />
    <title>Fathan MC</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <!-- Bootstrap core CSS -->
    <link href="/src/css/bootstrap.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css"
    />
    <!-- Custom styles for this template -->
    <link href="/src/css/navbar-top-fixed.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  </head>
  <body data-spy="scroll" data-target=".fixed-top">
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
      <div class="container">
      <a class="navbar-brand" href="/">
        <span class="text-uppercase font-weight-bold">
          Fathan's <span class="text-danger">MC</span>
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item font-weight-bold">
            <a class="nav-link page-scroll" href="#header">Beranda</a>
          </li>
          <li class="nav-item font-weight-bolder">
            <a class="nav-link page-scroll" href="#tentang">Tentang</a>
          </li>
          <li class="nav-item font-weight-bold">
            <a class="nav-link page-scroll" href="#mc">Pembawa Acara</a>
          </li>
          <li class="nav-item font-weight-bold">
            <a class="nav-link page-scroll" href="#peringkat">Peringkat MC</a>
          </li>
          <li class="nav-item font-weight-bold">
            <a class="nav-link page-scroll" href="#kontak">Kontak</a>
          </li>
          <?php if ($session->has('id')) : ?>
            <li class="nav-item font-weight-bold account">
              <a class="nav-link" href=" <?= $session->route ?>">
                <?= $session->name ?>
              </a>
            </li>
          <?php else : ?>
            <li class="nav-item font-weight-bold signin">
              <a class="nav-link" href="/login">
                Masuk
              </a>
            </li>
            <li class="nav-item font-weight-bold signup">
              <a class="nav-link" href="/register">
                Daftar
              </a>
            </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="https://wa.me/+6285362367044" class="nav-link" target="_blank" title="Whatsapp : +62 853-6236-7044"><i class="fab fa-whatsapp fa-fw"></i></a>
          </li>
          <li class="nav-item">
            <a href="https://www.instagram.com/muliafathan" class="nav-link" target="_blank" title="Instagram : @muliafathan"><i class="fab fa-instagram fa-fw"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <main role="main">
      <div id="header" class="main-box bg-image">
        <div class="header">
          <div class="container">
            <div class="row">
              <div class="col-md-4 box-form-search">
                <h2 class="font-weight-bolder text-white mb-3">
                  Cari MC yang Tersedia:
                </h2>
                <form action="/booking" role="form" autocomplete="off">
                  <input type="text" value="event" name="type" hidden />
                  <div class="form-box">
                    <select
                      name="search"
                      id="jenis_acara"
                      class="control"
                      required
                    >
                      <option value="">Jenis Acara Kamu...</option>
                       <?php foreach ($jenis_acara as $ja) : ?>
                        <option value="<?= $ja['id_jenis_acara'] ?>"><?= $ja['jenis_acara'] ?></option>
                      <?php endforeach ?> 
                    </select>
                  </div>
                  <div class="form-box">
                    <input
                      type="text"
                      name="date"
                      id="date"
                      class="control"
                      value="<?= date('Y-m-d') ?>"
                      placeholder="Tanggal Acara Kamu..."
                      required
                    />
                  </div>
                  <div class="form-box">
                    <input
                      type="time"
                      name="starts"
                      id="timestart"
                      class="control"
                      step="900"
                      value="<?=  (new DateTime(date('G:i')))->format('H:i') ?>"
                      placeholder="Waktu Mulai..."
                      required
                    />
                  </div>
                  <div class="form-box">
                    <input
                      type="time"
                      name="ends"
                      id="timeend"
                      class="control"
                      step="900"
                      value="<?=(new DateTime(date('G:i',strtotime('+1 Hour'))))->format('H:i') ?>"
                      placeholder="Waktu Akhir..."
                      required
                    />
                  </div>
                  <button type="submit" class="btn btn-danger w-100">
                    <i class="fa fa-search fa-fh mr-2"></i>Cari
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        id="tentang"
        class="main-box bg-light"
        style="min-height: 100vh;padding-top:70px;"
      >
          
          <div class="container" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="600">
              <h1 class="text-center mb-3"  data-aos="fade-up" data-aos-easing="linear" data-aos-duration="800">
                  Pengertian <i>Master of Ceremony</i>
              </h1>
              <p class="text-justify"  data-aos="fade-up" data-aos-easing="linear" data-aos-duration="900">
                  Setiap aktivitas membutuhkan pemimpin atau pemandu aktivitas yang sanggup menghantar aktivitas satu demi satu dengan teratur. Dalam acara-acara ceremonial acara-acara harus disusun sedemikian rupa sehingga suatu aktivitas atau event yang diadakan menarik. Seorang pemandu aktivitas disebut sebagai Master of Cermony (MC). Seorang MC yaitu seseorang yang bertugas untuk pemandu suatu aktivitas supaya sanggup berjalan dengan baik dan lancar. MC atau Master of Ceremony sanggup diartikan sebagai seorang pemimpin suatu aktivitas atau pesta. Seorang MC yaitu seseorang yang mempunyai keterampilan seni dalam bidang improvisasi untuk menghantarkan aktivitas secara teratur, baik dan mempunyai karakteristik yang khas.
              </p>
              
              <p class="text-justify"   data-aos="fade-up" data-aos-easing="linear" data-aos-duration="950">
                  Pengertian MC (Pembawa Acara) dan Tugas Bagi Seorang MC – Seorang MC harus bisa membaca situasi dengan tepat. Ia harus bisa membuat suasana sesuai dengan karakteristik acaranya, dan memungkinkan adanya obrolan denga audiens. MC mempunyai kiprah penting untuk mensukseskan suatu acara. Berbicara akan hal ini, menyulut pengetahuan ihwal adanya fungsi dari Master of Cermony (MC) itu sendiri. Hal ini tidak mengada-ada sebab mengingat seringkali seorang MC merangkap sekaligus sebagai penyanyi, seorang MC merangkap sebagai komedian dan lain-lain.
              </p>
              <h3 class="mb-3"   data-aos="fade-up" data-aos-easing="linear" data-aos-duration="800">Apa itu MC?</h3>
              <p class="text-justify"  data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1000">
                  Istilah MC atau pemimpin aktivitas intinya berbeda dengan pembawa acara. Memang dalam banyak kesempatan MC juga disebut sebagai pembawa acara. Namun pembawa acaranya biasanya digunakan pada acara-acara yang sifatnya resmi, sangat terikat pada sopan santun protokoler, dan tidak banyak improvisasi dalam menghantar acara. Hal ini sedikit berbeda dengan MC, seorang MC diberi keleluasan untuk berimprovisasi dan menyesuaikan dengan kondisi dan situasi yang sedang terjadi.
              </p>
          </div>
      </div>
      <div id="mc" class="main-box bg-dark" style="min-height: 100vh;padding-top:70px; color:white;">
          <div class="container text-center" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="600">
      <h3 class="text-center mb-1">Pembawa Acara</h3>
      <p class="text-center mb-2">12 Pembawa Rekomendasi dari kami</p>
      <hr class="mb-4 border-secondary">
      <div class="row">
        <?php
        $i = 1;
        $fade = 100;
        foreach ($mc as $row) : ?>
          <div class="col-md-2 col-sm-3 mb-4" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="<?= 1000 + ($fade * $i++) ?>">
            <div class="card bg-dark border-secondary">
              <?php if ($row['image'] == '') : ?>
                <img src="/src/images/default.jpg" class="card-img-top">
              <?php else : ?>
                <img src="/uploads/<?= $row['id_mc'] . '/' . $row['image'] ?>" class="card-img-top">
              <?php endif ?>
              <div class="card-body px-2 py-2">
                <h6 class="card-title mb-1"><?= $row['name'] ?></h6>
                <p class="card-text small text-justify">
                  <?php for ($j = 0; $j < count($row['promosi']); $j++) :
                    $data = $row['promosi'][$j];
                  ?>
                    <span class="badge" style="background-color: <?= $data['kode_warna'] ?>;"><?= $data['jenis_acara'] ?></span>
                  <?php endfor ?>
                </p>
              </div>
              <div class="card-footer p-0 text-center">
                <a href="/booking?mc=<?= $row['users_id'] ?>" class="btn btn-success w-100 p-1">BOOKING</a>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <hr class="mt-0 border-secondary">
      <div class="row justify-content-center pb-3">
        <a href="/booking" class="btn btn-primary">Lihat Semua</a>
      </div>
    </div>
      </div>
      <div
        id="peringkat"
        class="main-box bg-light"
        style="min-height: 100vh; padding-top:70px;"
      >
          <div class="container my-auto" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="600">
      <h3 class="text-center mb-4">Peringkat MC </h3>
      <p class="small text-center">7 Top MC berdasarkan Total Acara dan Total Jam Acara yang Dibawakan</p>
      <hr>
      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama MC</th>
            <th>Total Acara</th>
            <th>Total Jam Acara</th>
            <th colspan="2">Total Peserta</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($peringkat_mc as $data) : ?>
            <tr data-aos="fade-down" data-aos-easing="easingIn" data-aos-duration="<?= 700 + (100 * $i) ?>">
              <td width="50"><?= $i++ ?></td>
              <td><?= $data['name'] ?></td>
              <td width="200"><?= $data['acara'] ?> Acara</td>
              <td width="200"><?= $data['jam'] ?> Jam</td>
              <td width="200"><?= $data['peserta'] ?> Orang</td>
              <td width="100"><a href="/booking?mc=<?= $data['users_id'] ?>" class="btn btn-sm btn-success w-100 p-1">BOOKING</a></td>
            </tr>
            <?php endforeach;
          if (count($peringkat_mc) != 7) :
            for ($j = count($peringkat_mc) + 1; $j <= 7; $j++) : ?>
              <tr data-aos="fade-down" data-aos-easing="easingIn" data-aos-duration="<?= 700 + (100 * $j) ?>">
                <td width="50"><?= $j ?></td>
                <td> - </td>
                <td width="200">0 Acara</td>
                <td width="200">0 Jam</td>
                <td width="200">0 Orang</td>
                <td width="100" class="text-center"> - </td>
              </tr>
          <?php endfor;
          endif; ?>
        </tbody>
      </table>
      </div>
    </div>
      </div>
      <div
        id="kontak"
        class="main-box bg-dark"
        style="min-height: 100vh; padding-top:70px;color:white;"
      >
          <div class="container" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="600">
      <h3 class="text-center mb-5">Hubungi Kami</h3>
      <div class="row justify-content-around">
        <div class="col-md-5 col-sm-6 col-12 mb-3" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="800">
          <div class="card bg-dark">
            <div class="card-body text-center">
              <i class="fab fa-whatsapp fa-5x"></i>
              <i class="fas fa-phone fa-4x ml-4"></i>
              <h3 class="card-title mt-2 mb-4">Whatsapp</h3>
              <h5 class="card-text"><a href="https://wa.me/+6285362367044" class="card-link" target="_blank" title="Whatsapp : +62 853-6236-7044">+62 853-6236-7044</a></h5>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-sm-6 col-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000">
          <div class="card bg-dark">
            <div class="card-body text-center">
              <i class="fab fa-instagram fa-5x"></i>
              <h3 class="card-title mb-4">Instagram</h3>
              <h5 class="card-text">
                <a href="https://www.instagram.com/muliafathan" class="card-link" target="_blank" title="Instagram : @muliafathan">@muliafathan</a>
                <a href="https://www.instagram.com/mc_fathan_bilingual" class="card-link" target="_blank" title="Instagram : @mc_fathan_bilingual">@mc_fathan_bilingual</a>
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </main>

    <footer class="footer mt-auto py-2 px-3">
      <div class="container">
      &copy; All Right Reserved. Mulia Fathan <?=date('Y')?>
    </div>
    </footer>

    <script src="/src/js/main.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.x-git.slim.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script> -->
    <!-- <script>
      window.jQuery ||
        document.write(
          '<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>'
        );
    </script> -->
    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script>
      $(document).ready(function () {
        const inView = (element) => {
          var top = element.offsetTop;
          var height = element.offsetHeight;

          while (element.offsetParent) {
            element = element.offsetParent;
            top += element.offsetTop;
          }

          return (
            top < window.pageYOffset + window.innerHeight &&
            top + height > window.pageYOffset
          );
        };
        const init = () => {
          function update() {
            let next = false;
            $(".main-box").each(function (index, el) {
              const cur = $('a[href="#' + el.id + '"]');

              cur.on("click", function (e) {
                if (this.hash !== "") {
                  console.log($(this.hash).offset().top);
                  e.preventDefault();
                  console.log($("html, body").animate());
                  $("html, body").animate(
                    {
                      scrollTop: $(this.hash).offset().top,
                    },
                    500,
                    "easeInOut",
                    function () {
                      window.location.hash = this.hash;
                    }
                  );
                }
              });

              if ($(window).scrollTop() >= el.offsetTop && !next) {
                cur.addClass("active");
                next = true;
              } else {
                cur.removeClass("active");
              }
            });
          }

          update();
          window.addEventListener("scroll", update);
        };

        init();

        function checkScroll() {
          if ($(window).scrollTop() > 20) {
            $(".navbar").addClass("scrolled");
          } else {
            $(".navbar").removeClass("scrolled");
          }
        }

        if ($(".navbar").length > 0) {
          $(window).on("scroll load resize", function () {
            checkScroll();
          });
        }
      });
    </script> -->
  </body>
</html>
