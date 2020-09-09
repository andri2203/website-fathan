<?= $this->extend('default') ?>
<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Beranda</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Pelanggan</li>
                        <li class="breadcrumb-item active">Beranda</li>
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
            <div class="row ">
                <div class="col-md-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Acara yang Diterima</span>
                            <span class="info-box-number"><?= $diTerima ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Acara yang Ditolak</span>
                            <span class="info-box-number"><?= $diTolak ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Waktu Acara Anda</span>
                            <span class="info-box-number"><?= $jamAcara['jam'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Data Pesanan Anda</h5>
                            <div class="card-tools">
                                <a href="/booking" class="btn btn-sm btn-primary float-right">BOOKING MC</a>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Acara</th>
                                            <th>Nama MC</th>
                                            <th>Tanggal Acara</th>
                                            <th>Jam Acara</th>
                                            <th>Jumlah Peserta</th>
                                            <th>Profil Peserta</th>
                                            <th>Alamat</th>
                                            <th>Keterangan</th>
                                            <th>Budget Maksimal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pesanan as $row) : ?>
                                            <tr>
                                                <td><?= $row['jenis_acara'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= date('d-F-Y, G:i', strtotime($row['tanggal_jam'])) ?></td>
                                                <td><?= $row['jam_acara'] ?> jam</td>
                                                <td><?= $row['jumlah_peserta'] ?> <i class="fas fa-users"></i></td>
                                                <td><?= $row['profil_peserta'] ?></td>
                                                <td><?= $row['alamat'] ?></td>
                                                <td><?= $row['keterangan'] ?></td>
                                                <td><?= $row['budget'] ?></td>
                                                <td>
                                                    <?php if ($row['di_terima'] == 1) : ?>
                                                        <span class="btn btn-sm btn-success">Diterima</span>
                                                    <?php elseif ($row['di_terima'] == 2) : ?>
                                                        <span class="btn btn-sm btn-danger">Ditolak</span>
                                                    <?php elseif ($row['di_terima'] == 3) : ?>
                                                    <div class="btn-group-vertical">
                                                        <span class="btn btn-sm btn-success">Selesai</span>
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-<?= $row['id_booking'] ?>">Ulasan</button>
                                                        <div class="modal fade" id="modal-<?= $row['id_booking'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Beri Ulasan & Poin</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true">&times;</span>
                                                                </button>
                                                              </div>
                                                                <form action="/pelanggan/ulasan/<?= $row['id_booking'] ?>" method="POST">
                                                                  <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label class="control-label">
                                                                                Poin <div id="badge-<?= $row['id_booking'] ?>" class="badge badge-info"></div>
                                                                            </label>
                                                                            <input type="range" name="poin" class="form-control-range" id="ranged-<?= $row['id_booking'] ?>" min="1" max="5" step="0.1" value="<?= $row['point'] == 0 ? 1  :$row['point'] ?>" />
                                                                            <script>
                                                                                var ranged = document.getElementById('ranged-<?= $row['id_booking'] ?>')
                                                                                document.getElementById('badge-<?= $row['id_booking'] ?>').innerText = ranged.value
                                                                                ranged.addEventListener('input', function(e){
                                                                                    document.getElementById('badge-<?= $row['id_booking'] ?>').innerText = e.target.value
                                                                                })
                                                                            </script>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="text-<?= $row['id_booking'] ?>">Ulasan / Komentar</label>
                                                                            <textarea class="form-control" id="text-<?= $row['id_booking'] ?>" maxlength="70" name="ulasan" rows="3"><?=$row['ulasan']?></textarea>
                                                                        </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Buat Ulasan</button>
                                                                  </div>
                                                                </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <?php else : ?>
                                                        <span class="btn btn-sm btn-warning">Proses</span>
                                                    <?php endif ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical">
                                                        <!--<a href="/booking/update/<?= $row['id_booking'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>-->
                                                        <a href="/booking/delete/<?= $row['id_booking'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/pelanggan/pesanan" class="btn btn-info float-right">Lihat semua data</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>