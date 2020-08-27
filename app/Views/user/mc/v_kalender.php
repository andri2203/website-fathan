<?= $this->extend('default') ?>
<?= $this->section('link'); ?>
<link rel="stylesheet" href="/dist/fullcalendar/main.min.css">
<link rel="stylesheet" href="/dist/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="/dist/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="/dist/fullcalendar-bootstrap/main.min.css">
<?= $this->endSection('link'); ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kalender Acara</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">MC Area</a></li>
                        <li class="breadcrumb-item active">Kalender Acara</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Kode Warna Acara</h3>
                            </div>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($jenis_acara as $row) : ?>
                                    <li class="list-group-item py-2">
                                        <?= $row['jenis_acara'] ?> <i class="fas fa-square float-right" style="color: <?= $row['kode_warna'] ?> ;"></i>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pb-0">
                <form class="form-horizontal">
                    <div class="form-group row border-bottom">
                        <label for="judul" class="col-sm-3 col-form-label">Pemesan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="judul">
                        </div>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="mulai" class="col-sm-3 col-form-label">Waktu Pelaksanaan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="mulai">
                        </div>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="peserta">
                        </div>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="profil" class="col-sm-3 col-form-label">Profil Peserta</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control-plaintext" id="profil">
                        </div>
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control-plaintext" id="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control-plaintext" id="keterangan"></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<!-- fullCalendar 2.2.5 -->
<script src="/dist/moment/moment.min.js"></script>
<script src="/dist/fullcalendar/main.min.js"></script>
<script src="/dist/fullcalendar-daygrid/main.min.js"></script>
<script src="/dist/fullcalendar-timegrid/main.min.js"></script>
<script src="/dist/fullcalendar-interaction/main.min.js"></script>
<script src="/dist/fullcalendar-bootstrap/main.min.js"></script>
<script src="/dist/fullcalendar/locales/id.js"></script>
<!-- Page specific script -->
<script>
    $(function() {

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

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
            //Random default events
            events: JSON.parse('<?= json_encode($kalender) ?>'),
            eventClick: function(event, jsEvent, view) {
                var tanggal = tgl => {
                    var dt = new Date(tgl).toLocaleString('id-ID', {
                        dateStyle: "full",
                        timeStyle: "short",
                        hour12: false
                    });
                    // var string = `${dt.getDate()} ${dt.getUTCMonth()} ${dt.getFullYear()}`;
                    return dt;
                }

                var data = event.event._def.extendedProps.data

                $('#exampleModal').modal();
                $('#judul').val(event.event.title)
                $('#mulai').val(tanggal(event.event.start) + ' s/d ' + tanggal(event.event.end))
                $('#peserta').val(data.jumlah_peserta)
                $('#profil').val(data.profil_peserta)
                $('#alamat').val(data.alamat)
                $('#keterangan').val(data.keterangan)
            },
        });

        calendar.render();
        // $('#calendar').fullCalendar()
    })
</script>
<?= $this->endSection('script'); ?>