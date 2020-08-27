<div class="card-header">
    <h5 class="m-0">Edit Promosi</h5>
</div>
<form id="form" action="/mc/edit_promosi" method="post">
    <input type="number" name="id_promosi" value="<?= $promosiById['id_promosi'] ?>" hidden>
    <div class="card-body">
        <div class="form-group">
            <label for="acara">Acara yg Di Promosikan</label>
            <select name="acara" id="acara" class="form-control form-control-sm">
                <option value="">-- Pilih Acara</option>
                <?php foreach ($jenis_acara as $ja) : ?>
                    <option value="<?= $ja['id_jenis_acara'] ?>"<?= $ja['jenis_acara'] == $promosiById['jenis_acara']?'selected':''?>><?= $ja['jenis_acara'] ?></option>
                <?php endforeach ?>
            </select>
            <div class="feedback"></div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Ubah Promosi</button>
        <a href="/mc/promosi" class="btn btn-default float-right">Kembali</a>
    </div>
</form>