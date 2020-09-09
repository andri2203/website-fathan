<div class="col-lg-5">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Form Tambah Menu</h5>
        </div>
        <form id="form_menu" action="/admin/pengaturan/tambah_menu" method="POST" class="form-horizontal">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group row">
                    <label for="menu" class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Nama Menu" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-2 col-form-label">Ikon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="icon" id="icon" placeholder="Ikon Menu (Ditampilkan Di Sidebar)" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="class_routing" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="class_routing" id="class_routing" placeholder="Class Menu (Digunakan juga untuk Routing)" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                            <input type="checkbox" name="aktif" id="aktif" class="form-check-input" value="1">
                            <label for="aktif" class="form-check-label">Aktifkan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <button class="btn btn-secondary float-right" type="reset">Reset</button>
            </div>
        </form>
    </div>
</div>