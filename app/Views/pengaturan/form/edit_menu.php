<div class="col-lg-5">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Form Edit Menu</h5>
        </div>
        <form id="form_menu" action="/admin/pengaturan/edit_menu" method="POST" class="form-horizontal">
            <div class="card-body">
                <input type="number" name="menu_id" value="<?= $id ?>" hidden>
                <div class="form-group row">
                    <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Nama Menu" value="<?= $menuById['menu'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-2 col-form-label">Ikon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Ikon Menu (Ditampilkan Di Sidebar)" value="<?= $menuById['icon'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="class_routing" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="class_routing" id="class_routing" placeholder="Class Menu (Digunakan juga untuk Routing)" value="<?= $menuById['route'] ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                            <input type="checkbox" name="aktif" id="aktif" class="form-check-input" value="1" <?= $menuById['is_active'] == 1 ? 'checked' : '' ?>>
                            <label for="aktif" class="form-check-label">Aktifkan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="/admin/pengaturan/menu" class="btn btn-default">Kembali</a>
                <button class="btn btn-secondary float-right" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>