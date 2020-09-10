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
            <?php elseif ($session->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= $session->getFlashdata('error') ?>
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
                                                <td>Rp. <?= number_format($row['budget'], 0, '.', ',') ?></td>
                                                <td <?= $row['di_terima'] != 0 ? 'colspan="2"' : '' ?> class="text-center">
                                                    <?php if ($row['di_terima'] == 1) : ?>
                                                        <?php if ($transaksi($row['id_booking'])->countAllResults() == 0) : ?>
                                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#trans-<?= $row['id_booking'] ?>">Pembayaran</button>
                                                            <div class="modal fade text-left" id="trans-<?= $row['id_booking'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Transaksi</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="/pelanggan/transaksi/add/<?= $row['id_booking'] ?>" method="post" enctype="multipart/form-data" role="form">
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="jenis_transaksi_<?= $row['id_booking'] ?>" class="control-label">Jenis Transaksi</label>
                                                                                    <select name="jenis_transaksi_<?= $row['id_booking'] ?>" id="jenis_transaksi_<?= $row['id_booking'] ?>" class="form-control" required>
                                                                                        <option value="0" persen="0">-- Pilih Jenis Transaksi</option>
                                                                                        <?php foreach ($jenisTransaksi as $jt) : ?>
                                                                                            <option value="<?= $jt->id_jenis_transaksi ?>" persen="<?= $jt->persen ?>"><?= $jt->jenis_transaksi ?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="budget_<?= $row['id_booking'] ?>" class="control-label">Budget Maksimal</label>
                                                                                    <input type="number" name="budget_<?= $row['id_booking'] ?>" id="budget_<?= $row['id_booking'] ?>" value="<?= $row['budget'] ?>" class="form-control" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="total_<?= $row['id_booking'] ?>" class="control-label">Total Pembayaran</label>
                                                                                    <input type="number" value="0" name="total_<?= $row['id_booking'] ?>" id="total_<?= $row['id_booking'] ?>" class="form-control" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="file_<?= $row['id_booking'] ?>">Bukti Pembayaran</label>
                                                                                    <input type="file" class="form-control-file" name="file_<?= $row['id_booking'] ?>" id="file_<?= $row['id_booking'] ?>" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Transaksi</button>
                                                                            </div>
                                                                            <script>
                                                                                document.getElementById("jenis_transaksi_<?= $row['id_booking'] ?>").addEventListener('change', function(ev) {
                                                                                    const opti = document.querySelector('option[value="' + ev.target.value + '"]')
                                                                                    const persen = opti.getAttribute('persen')
                                                                                    const res = persen * document.getElementById("budget_<?= $row['id_booking'] ?>").value
                                                                                    document.getElementById("total_<?= $row['id_booking'] ?>").value = res
                                                                                });
                                                                            </script>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php else :
                                                            $trans = $transaksi($row['id_booking'])->get()->getRowObject();
                                                        ?>
                                                            <?php if ($trans->id_jenis_transaksi == 3 || $trans->jumlah == $row['budget']) : ?>
                                                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#after-<?= $row['id_booking'] ?>">
                                                                    Lunas
                                                                </button>
                                                            <?php else : ?>
                                                                <div class="btn-group-vertical">
                                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#after-<?= $row['id_booking'] ?>">
                                                                        <?= $trans->jenis_transaksi ?>
                                                                    </button>
                                                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#pelunasan-<?= $row['id_booking'] ?>">
                                                                        Pelunasan
                                                                    </button>
                                                                </div>
                                                                <div class="modal fade  text-left" id="pelunasan-<?= $row['id_booking'] ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <?php $sisa = $row['budget'] - $trans->jumlah ?>
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Data Transaksi: <?= $trans->jenis_transaksi ?></h5>

                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form action="/pelanggan/transaksi/pelunasan/<?= $row['id_booking'] ?>">
                                                                                <div class="modal-body">
                                                                                    <div class="form-group">
                                                                                        <h6 class="modal-text">Pelunasan: Rp. <?= number_format($sisa * -1, 0, '.', ',') ?></h6>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="total_<?= $row['id_booking'] ?>" class="control-label">Sisa Pembayaran</label>
                                                                                        <input type="number" value="<?= $sisa ?>" name="p_total_<?= $row['id_booking'] ?>" id="total_<?= $row['id_booking'] ?>" class="form-control" readonly>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="file_<?= $row['id_booking'] ?>">Bukti Pembayaran</label>
                                                                                        <input type="file" class="form-control-file" name="file_<?= $row['id_booking'] ?>" id="file_<?= $row['id_booking'] ?>" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                    <button type="submit" class="btn btn-primary">Lunas</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>


                                                            <div class="modal fade  text-left" id="after-<?= $row['id_booking'] ?>">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Data Transaksi: <?= $trans->jenis_transaksi ?></h5>

                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="/pelanggan/transaksi/<?= $trans->id_transaksi ?>/update" method="POST" enctype="multipart/form-data">
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="u_jenis_transaksi_<?= $trans->id_transaksi ?>" class="control-label">Jenis Transaksi</label>
                                                                                    <select name="u_jenis_transaksi_<?= $trans->id_transaksi ?>" id="u_jenis_transaksi_<?= $trans->id_transaksi ?>" class="form-control" required>
                                                                                        <option value="0" persen="0">-- Pilih Jenis Transaksi</option>
                                                                                        <?php foreach ($jenisTransaksi as $jt) : ?>
                                                                                            <option value="<?= $jt->id_jenis_transaksi ?>" persen="<?= $jt->persen ?>" <?= $trans->id_jenis_transaksi == $jt->id_jenis_transaksi ? "selected" : "" ?>><?= $jt->jenis_transaksi ?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="u_budget_<?= $trans->id_transaksi ?>" class="control-label">Budget Maksimal</label>
                                                                                    <input type="number" name="u_budget_<?= $trans->id_transaksi ?>" id="u_budget_<?= $trans->id_transaksi ?>" value="<?= $row['budget'] ?>" class="form-control" readonly>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="u_total_<?= $trans->id_transaksi ?>" class="control-label">Total Pembayaran</label>
                                                                                    <input type="number" value="<?= $trans->jumlah ?>" name="u_total_<?= $trans->id_transaksi ?>" id="u_total_<?= $trans->id_transaksi ?>" class="form-control" readonly>
                                                                                </div>
                                                                                <div class="form-row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="u_file_<?= $trans->id_transaksi ?>">Ganti Bukti Pembayaran</label>
                                                                                        <input type="file" class="form-control-file" name="u_file_<?= $trans->id_transaksi ?>" id="u_file_<?= $trans->id_transaksi ?>">
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <label class="control-label">Bukti Pembayaran <?= date("d F Y H:i", strtotime($trans->tanggal)) ?></label>
                                                                                        <img src="/uploads/<?= $session->id ?>/transaksi/<?= $trans->bukti_pembayaran ?>" alt="Bukti Pembayaran" id="bukti-<?= $trans->bukti_pembayaran ?>" class="img-fluid" width="100%">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                            </div>
                                                                            <script>
                                                                                document.getElementById("u_jenis_transaksi_<?= $trans->id_transaksi ?>").addEventListener('change', function(ev) {
                                                                                    const opti = document.querySelector('option[value="' + ev.target.value + '"]')
                                                                                    const persen = opti.getAttribute('persen')
                                                                                    const res = persen * document.getElementById("u_budget_<?= $trans->id_transaksi ?>").value
                                                                                    document.getElementById("u_total_<?= $trans->id_transaksi ?>").value = res
                                                                                });
                                                                            </script>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php elseif ($row['di_terima'] == 2) : ?>
                                                        <span class="btn btn-sm btn-danger">Ditolak</span>
                                                    <?php elseif ($row['di_terima'] == 3) : ?>
                                                        <div class="btn-group">
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
                                                                                    <input type="range" name="poin" class="form-control-range" id="ranged-<?= $row['id_booking'] ?>" min="1" max="5" step="0.1" value="<?= $row['point'] == 0 ? 1  : $row['point'] ?>" />
                                                                                    <script>
                                                                                        var ranged = document.getElementById('ranged-<?= $row['id_booking'] ?>')
                                                                                        document.getElementById('badge-<?= $row['id_booking'] ?>').innerText = ranged.value
                                                                                        ranged.addEventListener('input', function(e) {
                                                                                            document.getElementById('badge-<?= $row['id_booking'] ?>').innerText = e.target.value
                                                                                        })
                                                                                    </script>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="control-label" for="text-<?= $row['id_booking'] ?>">Ulasan / Komentar</label>
                                                                                    <textarea class="form-control" id="text-<?= $row['id_booking'] ?>" maxlength="70" name="ulasan" rows="3"><?= $row['ulasan'] ?></textarea>
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
                                                <?php if ($row['di_terima'] == 0) : ?>
                                                    <td>
                                                        <div class="btn-group-vertical">
                                                            <!--<a href="/booking/update/<?= $row['id_booking'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>-->
                                                            <a href="/booking/delete/<?= $row['id_booking'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                <?php endif ?>
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