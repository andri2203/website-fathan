<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>eMCee | Booking</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/dist/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/src/css/adminlte.min.css">
    <link rel="stylesheet" href="/dist/fullcalendar/main.min.css">
    <link rel="stylesheet" href="/dist/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="/dist/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="/dist/fullcalendar-bootstrap/main.css">

    <link rel="stylesheet" href="/dist/datetimepicker-master/jquery.datetimepicker.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/dist/timepicker/jquery.timepicker.min.css">
    <link rel="stylesheet" href="/dist/aos/css/aos.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        span.brand-text {
            font-family:"SCRIPT MT";
        }
    </style>
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <span class="brand-text font-weight-bold">
                        eMCe <span class="text-danger"> E = mc<sup>2</sup></span>
                    </span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <?php if ($session->has('id')) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $session->route ?>"><?= $session->name ?></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Daftar</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="700">
                            <div class="alert alert-info">
                                <i class="fas fa-info mr-2"></i>
                                Bisa langsung booking Pembawa Acara yang anda inginkan, Isi Formnya ya.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <form id="form_search" action="/booking" role="search" class="row mb-1" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="700" autocomplete="off">
                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <?php $cond_type = isset($_GET['type']) ?>
                                <select name="type" id="type" class="form-control form-control-sm">
                                    <option value="name" <?= $cond_type && $_GET['type'] == 'name' ? 'selected' : '' ?>>Cari Nama</option>
                                    <option value="event" <?= $cond_type && $_GET['type'] == 'event' ? 'selected' : '' ?>>Cari Jenis Acara</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" id="name" placeholder="Cari Nama, Jenis acara" <?= $cond_type ? ($_GET['type'] == 'name' ? 'name="search" value="' . (isset($_GET['search']) ? $_GET['search'] : '') . '"' : 'hidden') : 'name="search"' ?>>
                                <select id="s_acara" class="form-control form-control-sm" <?= $cond_type && $_GET['type'] == 'event' ? 'name="search"' : 'hidden' ?>>
                                    <option value="">-- Pilih Acara</option>
                                    <?php foreach ($jenis_acara as $ja) : ?>
                                        <option value="<?= $ja['id_jenis_acara'] ?>" <?= isset($_GET['search']) && $_GET['search'] == $ja['id_jenis_acara'] ? 'selected' : '' ?>><?= $ja['jenis_acara'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-5 col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="date" id="date" placeholder="Tanggal" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
                                <input type="text" class="form-control form-control-sm" name="starts" id="starts" placeholder="Jam Awal" value="<?= isset($_GET['starts']) ? $_GET['starts'] : '' ?>">
                                <input type="text" class="form-control form-control-sm" name="ends" id="ends" placeholder="Jam Akhir" value="<?= isset($_GET['ends']) ? $_GET['ends'] : '' ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-1 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-info w-100"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="container">
                    <form id="form" action="/booking/proses" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-4" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1000">
                                <div class="card card-success card-outline">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="acara">1. Acara yang anda laksanakan?</label>
                                            <select name="acara" id="acara" class="form-control form-control-sm">
                                                <option value="">-- Pilih Acara</option>
                                                <?php foreach ($jenis_acara as $ja) : ?>
                                                    <option value="<?= $ja['id_jenis_acara'] ?>"<?= isset($_GET['search']) && $_GET['search'] == $ja['id_jenis_acara'] ? 'selected' : '' ?>><?= $ja['jenis_acara'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">2. Tanggal & Jam berapa acara dilaksanakan?</label>
                                            <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm">
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_acara">3. Untuk berapa jam MC dibutuhkan?</label>
                                            <input type="number" name="jam_acara" id="jam_acara" class="form-control form-control-sm">
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_peserta">4. Berapakah perkiraan peserta acara?</label>
                                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control form-control-sm">
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="profil">5. Profil peserta/hadirin acaranya seperti apa?</label>
                                            <select name="profil" id="profil" class="form-control form-control-sm">
                                                <option value="">-- Pilih Profil</option>
                                                <option value="Karyawan Kantoran">Karyawan Kantoran</option>
                                                <option value="Mahasiswa">Mahasiswa</option>
                                                <option value="Pebisnis">Pebisnis</option>
                                                <option value="Keluarga">Keluarga</option>
                                                <option value="Anak - Anak">Anak - Anak</option>
                                                <option value="Semua Kalangan">Semua Kalangan</option>
                                            </select>
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">6. Alamat lengkap lokasi acara?</label>
                                            <textarea name="alamat" id="alamat" class="form-control form-control-sm" cols="2"></textarea>
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">7. Keterangan tambahan anda (Jika ada)</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" cols="2"></textarea>
                                            <div class="feedback"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="budget">8. Maksimal Budget untuk MC</label>
                                            <input type="number" name="budget" id="budget" class="form-control form-control-sm" placeholder="Budget Maksimal Untuk MC">
                                            <div class="feedback"></div>
                                        </div>
                                        <?php if ($session->has('id')) : ?>
                                            <button type="submit" class="btn btn-success float-right">BOOKING</button>
                                        <?php else : ?>
                                            <a href="/login" class="btn btn-success float-right">PROSES</a>
                                        <?php endif ?>
                                    </div>
                                </div><!-- /.card -->

                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-lg-8">
                                <?php if (count($mc) > 0): ?>
                                
                                <div class="row">
                                    <?php
                                    $i = 1;
                                    $fade = 100;
                                    foreach ($mc as $row) : ?>
                                        <div class="col-md-3 mb-4 <?= isset($_GET['mc']) && $_GET['mc'] == $row['users_id'] ? ' order-1' : ' order-3' ?>" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="<?= 1000 + ($fade * $i++) ?>">
                                            <input type="checkbox" class="mc" name="mc[]" id="mc_<?= $row['users_id'] ?>" value="<?= $row['users_id'] ?>" <?= isset($_GET['mc']) && $_GET['mc'] == $row['users_id'] ? 'checked' : '' ?> hidden>
                                            <div class="card bg-dark shadow-sm">
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
                                                    <div class="btn-group w-100">
                                                        <?php if (isset($_GET['mc']) && $_GET['mc'] == $row['users_id']) : ?>
                                                            <label for="mc_<?= $row['users_id'] ?>" class="btn btn-danger p-1 m-0 pilihan">Batal</label>
                                                        <?php else : ?>
                                                            <label for="mc_<?= $row['users_id'] ?>" class="btn btn-primary p-1 m-0 pilihan">Pilih</label>
                                                        <?php endif ?>
                                                        <button type="button" class="btn btn-info btn-show-modal" data-key="<?= $row['users_id'] ?>"><i class="fas fa-calendar-alt"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <?php else:?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-info">Ops!!! MC yang anda cari tidak ditemukan, Coba cari lagi.</div>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                    </form>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer bg-dark">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <div id="modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kalender Kerja <span id="title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="calendar" class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/dist/jquery/jquery.min.js"> </script> <!-- Bootstrap 4 -->
    <script src="/dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/jquery-validation/jquery.validate.min.js"></script>
    <script src="/dist/jquery-validation/additional-methods.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="/dist/moment/moment.min.js"></script>
    <!-- date-range-picker -->
    <script src="/dist/datetimepicker-master/jquery.datetimepicker.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/src/js/adminlte.min.js"> </script>
    <script src="/dist/aos/js/aos.js">
    </script>
    <script src="/dist/fullcalendar/main.min.js"></script>
    <script src="/dist/fullcalendar-daygrid/main.min.js"></script>
    <script src="/dist/fullcalendar-timegrid/main.min.js"></script>
    <script src="/dist/fullcalendar-interaction/main.min.js"></script>
    <script src="/dist/fullcalendar-bootstrap/main.min.js"></script>
    <script src="/dist/fullcalendar/locales/id.js"></script>
    <script>
        AOS.init();

        $(document).ready(function() {
            var date = new Array();
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                locale: 'id',
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                defaultView: 'dayGridMonth',
                events: [],
            });

            $('.btn-show-modal').on('click', function() {
                var id = $(this).data('key')
                var name = $('#mc_' + id).closest('.col-md-3').find('.card-title').text()
                $('#modal').find('#title').text(name)

                $('#modal').modal('show')
                window.setTimeout(function() {
                    $('.fc-dayGridMonth-button').click()
                }, 200);
                $('#modal').modal('handleUpdate')

                fetch('/booking/calendar/' + id, {
                    method: "get",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }).then(value => value.json()).then(function(respon) {
                    respon.forEach(element => {
                        calendar.addEvent(element)
                    });
                })

            })

            $('#modal').on('show.bs.modal', function() {
                calendar.render();
            })

            $('#modal').on('hidden.bs.modal', function() {
                calendar.getEvents().forEach(element => {
                    var event = calendar.getEventById(element.id)
                    event.remove()
                })
                calendar.destroy()
                $(this).find('#calendar').html('')
            })

        })


        $(function() {



            $('#type').on('change', function() {
                var el = $(this)
                var container = el.closest('.input-group')

                if (el.val() == 'event') {
                    container.find('#s_acara').removeAttr('hidden')
                    container.find('#s_acara').attr('name', 'search')
                    container.find('#name').attr('hidden', true)
                    container.find('#name').removeAttr('name')
                } else {
                    container.find('#name').removeAttr('hidden')
                    container.find('#name').attr('name', 'search')
                    container.find('#s_acara').attr('hidden', true)
                    container.find('#s_acara').removeAttr('name')
                }
            })

            // Datetimepicker
            $.datetimepicker.setDateFormatter({
                parseDate: function(date, format) {
                    var d = moment(date, format);
                    return d.isValid() ? d.toDate() : false;
                },
                formatDate: function(date, format) {
                    return moment(date).format(format);
                },
            });

            const options = {
                ownerDocument: document,
                contentWindow: window,
                value: '',
                rtl: false,
                format: 'Y-MM-DD HH:mm',
                formatTime: 'HH:mm',
                formatDate: 'Y-MM-DD',
                startDate: new Date(),
                step: 60,
                timepicker: true,
                datepicker: true,
                weeks: false,
                defaultTime: '10:00',
                defaultDate: new Date(),
                minDate: new Date(),
            }


            $('#tanggal').datetimepicker(options);
            $('#date').datetimepicker({
                ownerDocument: document,
                contentWindow: window,
                value: '',
                rtl: false,
                format: 'YYYY-MM-DD',
                formatDate: 'YYYY-MM-DD',
                startDate: new Date(),
                step: 60,
                timepicker: false,
                datepicker: true,
                weeks: false,
                defaultDate: new Date(),
                minDate: new Date(),
            });
            $('#starts, #ends').datetimepicker({
                ownerDocument: document,
                contentWindow: window,
                rtl: false,
                format: 'HH:mm',
                formatTime: 'HH:mm',
                startTime: '00:00',
                step: 60,
                timepicker: true,
                datepicker: false,
                weeks: false,
                // defaultTime: '10:00',
            })

            // Pilihan MC 
            let jumlah_mc = $('#jumlah_mc').val()

            var pilihan = $('.pilihan').each(function(i, el) {
                var $elemen = $(el)
                var idCheck = $('#' + $elemen.attr('for'))

                $elemen.on('click', function() {

                    if ($elemen.hasClass('btn-danger')) {
                        idCheck.closest('.col-md-3').removeClass('order-1').addClass('order-3')
                        $elemen.removeClass('btn-danger').addClass('btn-primary').text('Pilih')
                    } else {
                        idCheck.closest('.col-md-3').removeClass('order-3').addClass('order-1')
                        $elemen.removeClass('btn-primary').addClass('btn-danger').text('Batal')
                    }
                })
            })

            // Validation
            $('#form').validate({
                rules: {
                    budget: {
                        required: true,
                    },
                    acara: {
                        required: true,
                    },
                    tanggal: {
                        required: true,
                        date: true
                    },
                    jam_acara: {
                        required: true,
                    },
                    jumlah_peserta: {
                        required: true,
                    },
                    profil: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                        maxlength: 150
                    },
                },
                messages: {
                    budget: {
                        required: "Berikanlah besaran budget ke MC",
                    },
                    acara: {
                        required: "Acara wajib dipilih",
                    },
                    tanggal: {
                        required: "Tanggal wajib diisi",
                        date: "Format tanggal tidak sesuai."
                    },
                    jam_acara: {
                        required: "Lama Jam Acara diperlukan",
                    },
                    jumlah_peserta: {
                        required: "Jumlah Peserta dibutuhkan",
                    },
                    profil: {
                        required: "Profil Peserta acara wajib dipilih",
                    },
                    alamat: {
                        required: "Alamat acara wajib diisi",
                        maxlength: "maksimal 150 karakter"
                    },
                },
                errorPlacement: function(error, element) {
                    element.parents(".form-group").find(".feedback").append(error);
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
                submitHandler: function(form) {
                    if ($('.mc:checked').length > 0) {
                        form.submit();
                    } else {
                        alert('Anda Belum Memilih MC.')
                    }
                }
            })
        });
    </script>
</body>

</html>