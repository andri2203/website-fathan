<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pesanan Saya</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                        <li class="breadcrumb-item active">Pesanan Saya</li>
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
                            <a href="/booking" class="btn btn-primary float-right">BOOKING MC</a>
                            <div class="table-responsive pt-3">
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
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>