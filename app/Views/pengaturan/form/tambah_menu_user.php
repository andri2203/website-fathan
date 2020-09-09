<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="m-0">Form Tambah Menu User</h5>
    </div>
    <form id="form" action="/admin/pengaturan/tambah_user_menu" method="POST" class="form-horizontal">
        <div class="card-body">
            <?= csrf_field() ?>
            <div class="form-group row">
                <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                <div class="col-sm-10">
                    <select name="menu" id="menu" class="form-control">
                        <option value="">Pilih Menu</option>
                        <?php foreach ($menu as $mn) : ?>
                            <option value="<?= $mn['menu_id'] ?>"><?= $mn['menu'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        <option value="">Pilih Role</option>
                        <?php foreach ($role as $rl) : ?>
                            <option value="<?= $rl['role_id'] ?>"><?= $rl['role'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">Tambah</button>
            <button class="btn btn-secondary float-right" type="reset">Reset</button>
        </div>
    </form>
</div>