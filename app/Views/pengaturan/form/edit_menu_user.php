<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="m-0">Form Edit Menu User</h5>
    </div>
    <form id="form" method="POST" action="/admin/pengaturan/edit_user_menu" class="form-horizontal">
        <div class="card-body">
            <?= csrf_field() ?>
            <input type="number" name="user_menu_id" value="<?= $id ?>" hidden>
            <div class="form-group row">
                <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                <div class="col-sm-10">
                    <select name="menu" id="menu" class="form-control">
                        <option value="">Pilih Menu</option>
                        <?php foreach ($menu as $mn) : ?>
                            <option value="<?= $mn['menu_id'] ?>" <?= $mn['menu_id'] == $userMenuById['menu_id'] ? 'selected' : '' ?>><?= $mn['menu'] ?></option>
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
                            <option value="<?= $rl['role_id'] ?>" <?= $rl['role_id'] == $userMenuById['role_id'] ? 'selected' : '' ?>><?= $rl['role'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="/admin/pengaturan/user_menu" class="btn btn-default">Kembali</a>
                <button class="btn btn-secondary float-right" type="reset">Reset</button>
            </div>
        </div>
    </form>
</div>