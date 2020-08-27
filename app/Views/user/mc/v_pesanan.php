<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Booking</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">MC Area</a></li>
                        <li class="breadcrumb-item active">Booking</li>
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
            <?php if ($session->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= $session->getFlashdata('success') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Acara</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pemesan</th>
                                            <th>No. Telp</th>
                                            <th>Budget Maksimal</th>
                                            <th>Aksi</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pesanan as $row) : ?>
                                            <tr>
                                                <td><?= $row['jenis_acara'] ?></td>
                                                <td><?= date('d F Y, G:i', strtotime($row['tanggal_jam'])) ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['budget'] ?></td>
                                                <td>
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-<?= $row['id_booking'] ?>">Rincian Acara</button>
                                                    <div class="modal fade" id="modal-<?= $row['id_booking'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Rincian Acara</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Pemesan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['name'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Tanggal</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value=" <?= date('d F Y G:i', strtotime($row['tanggal_jam'])) ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Acara</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['jenis_acara'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Waktu</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['jam_acara'] ?> Jam">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Peserta</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['jumlah_peserta'] ?> Orang">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Profil</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['profil_peserta'] ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Alamat</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea class="form-control-plaintext"><?= $row['alamat'] ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <?php if ($row['keterangan'] == '') : ?>
                                                                                    <input type="text" readonly class="form-control-plaintext" value="-">
                                                                                <?php else : ?>
                                                                                    <textarea class="form-control-plaintext"><?= $row['keterangan'] ?></textarea>
                                                                                <?php endif ?>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <div class="d-flex justify-content-center">
                                                                        <?php if ($row['di_terima'] == 1) : ?>
                                                                            <span class="btn btn-sm btn-success">Diterima</span>
                                                                        <?php elseif ($row['di_terima'] == 2) : ?>
                                                                            <span class="btn btn-sm btn-danger">Ditolak</span>
                                                                        <?php else : ?>
                                                                            <a href="/mc/tolak/<?= $row['id_booking'] ?>" class="btn btn-danger mr-3" onclick="return confirm('Yakin ingin menolak?')">Tolak</a>
                                                                            <a href="/mc/terima/<?= $row['id_booking'] ?>" class="btn btn-success" onclick="return confirm('Anda akan menerima tawaran MC ini.')">Terima</a>
                                                                        <?php endif ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($row['di_terima'] == 1) : ?>
                                                        <span class="btn btn-sm btn-success">Diterima</span>
                                                    <?php elseif ($row['di_terima'] == 2) : ?>
                                                        <span class="btn btn-sm btn-danger">Ditolak</span>
                                                    <?php else : ?>
                                                        <span class="btn btn-sm btn-warning">Proses</span>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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