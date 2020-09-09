<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="m-0">Form Tambah Jenis Acara</h5>
    </div>
    <form id="form" action="/admin/pengaturan/edit_jenis_acara" method="POST" class="form-horizontal" autocomplete="off">
        <?= csrf_field() ?>
        <input type="number" name="id_jenis_acara" value="<?= $id ?>" hidden>
        <div class="card-body">
            <div class="form-group row">
                <label for="jenis_acara" class="col-sm-3 col-form-label">Jenis Acara</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="jenis_acara" id="jenis_acara" placeholder="Jenis Acara" value="<?= $jenis_acara_row['jenis_acara'] ?>" required>
                </div>
            </div>
            <div class="form-group row color-picker">
                <label for="kode_warna" class="col-sm-3 col-form-label">Kode Warna</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="kode_warna" id="kode_warna" placeholder="Kode Warna untuk label jenis acara" data-default-color="<?= $jenis_acara_row['kode_warna'] ?>" value="<?= $jenis_acara_row['kode_warna'] ?>" required>
                </div>
                <div class="col-sm-1">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Edit</button>
            <a href="/admin/pengaturan/jenis-acara" class="btn btn-default">Kembali</a>
            <button class="btn btn-secondary float-right" type="reset">Reset</button>
        </div>
    </form>
</div>