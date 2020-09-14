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
                        <li class="breadcrumb-item">MC</li>
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
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Acara yang Diterima</span>
                            <span class="info-box-number"><?= $diTerima ?> Acara</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Acara yang Ditolak</span>
                            <span class="info-box-number"><?= $diTolak ?> Acara</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box" onclick="alert('Acara berakhir tanpa proses terima / tolak')" style="cursor: pointer;">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Acara Berakhir</span>
                            <span class="info-box-number"><?= $job_berakhir ?> Acara</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/mc/transaksi" class="info-box text-dark">
                        <span class="info-box-icon bg-info"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Saldo Anda</span>
                            <span class="info-box-number">Rp. <?= number_format($saldo['saldo'], 0, '.', ',')  ?></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Data Booking</h5>
                        </div>
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
                                        <?php foreach ($pesanan as $row) :
                                            $trans = $transaksi($row['id_booking']);
                                            $transRow = $trans->getRowArray();
                                            $transResult = $trans->getResultarray(); ?>
                                            <tr>
                                                <td><?= $row['jenis_acara'] ?></td>
                                                <td><?= date('d F Y, G:i', strtotime($row['tanggal_jam'])) ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td>Rp. <?= number_format($row['budget'], 0, '.', ',') ?></td>
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
                                                                    <div class="d-flex justify-content-center">
                                                                        <?php if ($row['di_terima'] == 1) : ?>
                                                                            <?php if ($transRow['id_jenis_transaksi'] == 3 || $transaksi_JumlahBudget($row['id_booking'])->total == $row['budget']) : ?>
                                                                                <div class="btn-group">
                                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#trans-<?= $row['id_booking'] ?>">Lunas</button>
                                                                                    <a href="/mc/selesai/<?= $row['id_booking'] ?>" onclick="return confirm('Apakah Acara ini telah selesai? Klik OK jika acara telah anda laksanakan.')" class="btn btn-sm btn-success">Selesai</a>
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <?php if ($transaksi_AllData($row['id_booking']) == 0) : ?>
                                                                                    <button class="btn btn-sm btn-warning" onclick="alert('<?= $row['name'] ?> Belum Melakukan Pembayaran.')">Pembayaran</button>
                                                                                <?php else : ?>
                                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#trans-<?= $row['id_booking'] ?>"><?= $transRow['jenis_transaksi'] ?></button>
                                                                                <?php endif ?>
                                                                            <?php endif ?>
                                                                        <?php elseif ($row['di_terima'] == 2) : ?>
                                                                            <span class="btn btn-sm btn-danger">Ditolak</span>
                                                                        <?php elseif ($row['di_terima'] == 3) : ?>
                                                                            <span class="btn btn-sm btn-success">Selesai</span>
                                                                            <?php else :
                                                                            if (strtotime($row['tanggal_jam']) < time()) :
                                                                            ?>
                                                                                <span class="btn btn-sm btn-danger">Berakhir. Tidak ada proses terjadi setelah tanggal acara.</span>
                                                                            <?php else : ?>
                                                                                <a href="/mc/tolak/<?= $row['id_booking'] ?>" class="btn btn-danger mr-3" onclick="return confirm('Yakin ingin menolak?')">Tolak</a>
                                                                                <a href="/mc/terima/<?= $row['id_booking'] ?>" class="btn btn-success" onclick="return confirm('Anda akan menerima tawaran MC ini.')">Terima</a>
                                                                        <?php
                                                                            endif;
                                                                        endif;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php if ($row['di_terima'] == 1) :

                                                    ?>
                                                        <?php if ($transRow['id_jenis_transaksi'] == 3 || $transaksi_JumlahBudget($row['id_booking'])->total == $row['budget']) : ?>
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#trans-<?= $row['id_booking'] ?>">Lunas</button>
                                                                <a href="/mc/selesai/<?= $row['id_booking'] ?>" onclick="return confirm('Apakah Acara ini telah selesai? Klik OK jika acara telah anda laksanakan.')" class="btn btn-sm btn-success">Selesai</a>
                                                            </div>
                                                        <?php else : ?>
                                                            <?php if ($transaksi_AllData($row['id_booking']) == 0) :
                                                                if (strtotime($row['tanggal_jam']) < time()) : ?>
                                                                    <span class="btn btn-sm btn-danger" onclick="alert('Tidak ada proses terjadi setelah tanggal acara.')">Berakhir</span>
                                                                <?php else : ?>
                                                                    <button class="btn btn-sm btn-warning" onclick="alert('<?= $row['name'] ?> Belum Melakukan Pembayaran.')">Pembayaran</button>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#trans-<?= $row['id_booking'] ?>"><?= $transRow['jenis_transaksi'] ?></button>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php elseif ($row['di_terima'] == 2) : ?>
                                                        <span class="btn btn-sm btn-danger">Ditolak</span>
                                                    <?php elseif ($row['di_terima'] == 3) : ?>
                                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                                                            Selesai
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Ulasan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label class="control-label">
                                                                                Poin <div id="badge-<?= $row['id_booking'] ?>" class="badge badge-info">
                                                                                    <?= $row['point'] ?> <i class="fas fa-star"></i>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="text-<?= $row['id_booking'] ?>">Ulasan / Komentar</label>
                                                                            <textarea class="form-control-plaintext" id="text-<?= $row['id_booking'] ?>" maxlength="70" name="ulasan" rows="3"><?= $row['ulasan'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php else :
                                                        if (strtotime($row['tanggal_jam']) < time()) :
                                                        ?>
                                                            <span class="btn btn-sm btn-danger" onclick="alert('Tidak ada proses terjadi setelah tanggal acara.')">Berakhir</span>
                                                        <?php else : ?>
                                                            <span class="btn btn-sm btn-warning">Proses</span>
                                                    <?php
                                                        endif;
                                                    endif;
                                                    ?>
                                                    <div class="modal fade text-left" id="trans-<?= $row['id_booking'] ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-body table-responsive">
                                                                    <h5 class="modal-title text-center font-weight-bold mb-2">Riwayat Pembayaran</h5>
                                                                    <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Tanggal</th>
                                                                                <th>Jenis Transaksi</th>
                                                                                <th>Jumlah</th>
                                                                                <th>Bukti Transfer</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $i = 1;
                                                                            foreach ($transResult as $rt) :
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?= $i++ ?></td>
                                                                                    <td><?= date("d F Y, G:i:s", strtotime($rt['tanggal'])) ?></td>
                                                                                    <td><?= $rt['jenis_transaksi'] ?></td>
                                                                                    <td>Rp. <?= number_format($rt['jumlah'], 0, '.', ',') ?></td>
                                                                                    <td width=350>
                                                                                        <img src="<?= "/uploads/{$row['id_pemesan']}/transaksi/" ?><?= $rt['bukti_pembayaran'] ?>" alt="<?= $rt['jenis_transaksi'] ?>" class="img-fluid">
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                        <tfoot class="tfoot-success">
                                                                            <tr>
                                                                                <th colspan="4">Total </th>
                                                                                <th>Rp. <?= number_format($transaksi_JumlahBudget($row['id_booking'])->total, 0, '.', ',') ?></th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/mc/booking" class="btn btn-info float-right">Lihat semua data</a>
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