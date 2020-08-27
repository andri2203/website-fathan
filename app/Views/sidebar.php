<?php
$session = \Config\Services::session();
$uri = str_replace('admin/', '', uri_string());
$segment = explode('/', $uri);
?>
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/src/images/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
        <span class="brand-text text-uppercase font-weight-bold">
            Fathan's <span class="text-danger">MC</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php
            $userModel = new \App\Models\UsersModel();
            $user = $userModel->asObject()->find($session->id);
            if ($user->image == '') :
            ?>
                <div class="image">
                    <img src="/src/images/default.jpg" class="img-circle elevation-2" alt="User Image" />
                </div>
            <?php else : ?>
                <div class="image">
                    <img src="/uploads/<?= $session->id ?>/<?= $user->image ?>" class="img-circle elevation-2" alt="User Image" />
                </div>
            <?php endif ?>
            <div class="info">
                <a href="/account" class="d-block"><?= $session->name ?></a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $session->route ?>" class="nav-link <?= '/' . $segment[0] == $session->route && !array_key_exists(1, $segment) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <?php
                $db = \Config\Database::connect();
                $sql = "SELECT `user_menu`.*, `menu`.`menu`, `menu`.`route`, `menu`.`icon`
                FROM `user_menu`
                INNER JOIN `menu`
                ON `menu`.`menu_id` = `user_menu`.`menu_id`
                WHERE `user_menu`.`role_id` = $session->role_id AND `menu`.`is_active` = 1";
                $menu = $db->query($sql);
                foreach ($menu->getResultArray() as $mn) :

                ?>
                    <li class="nav-item has-treeview <?= $segment[0] == strtolower($mn['route']) ? 'menu-open' : '' ?>">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon <?= $mn['icon'] ?>""></i>
                            <p>
                            <?= $mn['menu'] ?>
                                <i class=" right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php
                            $sql1 = "SELECT * FROM sub_menu WHERE menu_id = :id_menu:";
                            $subMenu = $db->query($sql1, [
                                'id_menu' => $mn['menu_id']
                            ]);

                            foreach ($subMenu->getResultArray() as $sm) : ?>
                                <li class="nav-item">
                                    <?php if (strtolower($mn['route']) == 'pengaturan') : ?>
                                        <a href="<?= $session->route ?>/<?= strtolower($mn['route']) . '/' . $sm['sub_route'] ?>" class="nav-link  <?= array_key_exists(1, $segment) && $segment[1] == $sm['sub_route'] ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= $sm['sub_menu'] ?></p>
                                        </a>
                                    <?php else : ?>
                                        <a href="/<?= strtolower($mn['route']) . '/' . $sm['sub_route'] ?>" class="nav-link  <?= array_key_exists(1, $segment) && $segment[1] == $sm['sub_route'] ? 'active' : '' ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p><?= $sm['sub_menu'] ?></p>
                                        </a>
                                    <?php endif ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>