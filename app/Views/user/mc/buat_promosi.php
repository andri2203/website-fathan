<div class="card-header">
    <h5 class="m-0">Buat Promosi</h5>
</div>
<form id="form" action="/mc/buat_promosi" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="acara">Acara yg Di Promosikan</label>
            <select name="acara" id="acara" class="form-control form-control-sm">
                <option value="">-- Pilih Acara</option>
                <?php foreach ($jenis_acara as $ja) : ?>
                    <option value="<?= $ja['id_jenis_acara'] ?>"><?= $ja['jenis_acara'] ?></option>
                <?php endforeach ?>
            </select>
            <div class="feedback"></div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Buat Promosi</button>
        <button type="reset" class="btn btn-default float-right">Kosongkan Form</button>
    </div>
</form>