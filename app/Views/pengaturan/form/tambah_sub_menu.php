    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Form Tambah Sub Menu</h5>
        </div>
        <form id="form_menu" action="/admin/pengaturan/tambah_sub_menu" method="POST" class="form-horizontal">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group row">
                    <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="menu" id="menu" required>
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $row) : ?>
                                <option value="<?= $row['menu_id'] ?>"><?= $row['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sub_menu" class="col-sm-2 col-form-label">Sub Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sub_menu" id="sub_menu" placeholder="Nama Sub Menu" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="route" class="col-sm-2 col-form-label">Route</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="route" id="route" placeholder="Route Sub Menu" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <button class="btn btn-secondary float-right" type="reset">Reset</button>
            </div>
        </form>
    </div>