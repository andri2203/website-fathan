<?= $this->extend('default') ?>
<?= $this->section('content'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Riwayat Transaksi</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                        <li class="breadcrumb-item active">Riwayat Transaksi</li>
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
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Transaksi</th>
                                            <th>Penerima</th>
                                            <th>Tanggal</th>
                                            <th>Bukti Transfer</th>
                                            <th>Acara</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $jumlah = 0;
                                        foreach ($transaksi as $row) :
                                            $jumlah += $row['jumlah'];
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $row['jenis_transaksi'] ?></td>
                                                <td><?= $row['penerima'] ?> (<?= $row['telpon'] ?>)</td>
                                                <td><?= date("d F Y, G:i", strtotime($row['tanggal'])) ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#bukti-<?= $row['id_transaksi'] ?>">Lihat Bukti Transfer</button>
                                                    <div id="bukti-<?= $row['id_transaksi'] ?>" class="modal fade text-left" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <img src="<?= "/uploads/{$session->id}/transaksi/{$row['bukti_pembayaran']}" ?>" alt="" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#acara-<?= $row['id_transaksi'] ?>">Detail Acara</button>
                                                    <div id="acara-<?= $row['id_transaksi'] ?>" class="modal fade text-left" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
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
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">MC</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value="<?= $row['penerima'] ?> (<?= $row['telpon'] ?>)">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row border-bottom">
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Tanggal</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" readonly class="form-control-plaintext" value=" <?= date('d F Y, G:i', strtotime($row['tanggal_jam'])) ?>">
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
                                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Hadirin</label>
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">Rp. <?= number_format($row['jumlah'], 0, '.', ',') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">Total Pembayaran</td>
                                            <td colspan="1" class="text-right">Rp. <?= number_format($jumlah, 0, '.', ',') ?></td>
                                        </tr>
                                    </tfoot>
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