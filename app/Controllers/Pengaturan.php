<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;
use App\Models\MenuModel;

class Pengaturan extends BaseController
{

    public function menu($id = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $menuModel = new MenuModel();

        $data = [
            'id' => $id,
            'form' => $id == null ? 'tambah_menu' : 'edit_menu',
            'menu' => $menuModel->findAll(),
            'menuById' => $menuModel->find($id),
            'session' => $this->session
        ];
        return view('pengaturan/menu', $data);
    }

    public function aktif_menu($menu_id)
    {
        $menuModel = new MenuModel();
        $menuModel->update($menu_id, array('is_active' => 1));
        return redirect()->to('/admin/pengaturan/menu')->with('menu', 'Menu Berhasil Di Aktifkan');
    }

    public function non_aktif_menu($menu_id)
    {
        $menuModel = new MenuModel();
        $menuModel->update($menu_id, array('is_active' => 0));
        return redirect()->to('/admin/pengaturan/menu')->with('menu', 'Menu Berhasil Di Non Aktifkan');
    }

    public function tambah_menu()
    {
        $menuModel = new MenuModel();
        // dd($this->request->getPost());
        // die;
        $menu = $this->request->getPost('menu');
        $ikon = $this->request->getPost('icon');
        $aktif = $this->request->getPost('aktif');
        $classRouting = $this->request->getPost('class_routing');

        $data = array(
            'menu' => $menu,
            'icon' => $ikon,
            'route' => $classRouting,
            'is_active' => $aktif
        );

        $menuModel->insert($data);
        return redirect()->to('/admin/pengaturan/menu')->with('menu', 'Menu Berhasil Ditambah');
    }

    public function edit_menu()
    {
        $menuModel = new MenuModel();

        $menu_id = $this->request->getPost('menu_id');
        $menu = $this->request->getPost('menu');
        $ikon = $this->request->getPost('icon');
        $classRouting = $this->request->getPost('class_routing');
        $aktif = $this->request->getPost('aktif');

        $data = [
            'menu' => $menu,
            'icon' => $ikon,
            'route' => $classRouting,
            'is_active' => $aktif,
        ];

        $menuModel->update($menu_id, $data);
        return redirect()->to('/admin/pengaturan/menu')->with('menu', 'Menu Berhasil Dirubah');
    }

    public function hapus_menu($menu_id)
    {
        $menuModel = new MenuModel();
        $menuModel->delete($menu_id);
        return redirect()->to('/admin/pengaturan/menu')->with('menu', 'Menu Berhasil Dihapus');
    }

    // -------------------------------------------------------------------------------- //

    public function sub_menu($sub_menu_id = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $menuModel = new \App\Models\MenuModel();
        $subMenuModel = new \App\Models\SubMenuModel();

        $data = [
            'id' => $sub_menu_id,
            'form' => $sub_menu_id == null ? 'tambah_sub_menu' : 'edit_sub_menu',
            'menu' => $menuModel->asArray()->findAll(),
            'subMenu' => $subMenuModel->SubMenuByMenuIdAll(),
            'subMenuById' => $subMenuModel->find($sub_menu_id),
            'session' => $this->session
        ];

        return view('pengaturan/sub_menu', $data);
    }

    public function tambah_sub_menu()
    {
        $subMenuModel = new \App\Models\SubMenuModel();

        $menu_id = $this->request->getPost('menu');
        $sub_menu = $this->request->getPost('sub_menu');
        $route = $this->request->getPost('route');

        $subMenuModel->insert(array(
            'menu_id' => $menu_id,
            'sub_menu' => $sub_menu,
            'sub_route' => $route
        ));
        return redirect()->to('/admin/pengaturan/sub_menu')->with('menu', 'Sub Menu Berhasil Ditambahkan');
    }

    public function edit_sub_menu()
    {
        $subMenuModel = new \App\Models\SubMenuModel();

        $sub_menu_id = $this->request->getPost('sub_menu_id');
        $menu_id = $this->request->getPost('menu');
        $sub_menu = $this->request->getPost('sub_menu');
        $route = $this->request->getPost('route');

        $subMenuModel->update($sub_menu_id, array(
            'menu_id' => $menu_id,
            'sub_menu' => $sub_menu,
            'sub_route' => $route
        ));
        return redirect()->to('/admin/pengaturan/sub_menu')->with('menu', 'Sub Menu Berhasil Dirubah');
    }

    public function hapus_sub_menu($sub_menu_id)
    {
        $subMenuModel = new \App\Models\SubMenuModel();
        $subMenuModel->delete($sub_menu_id);
        return redirect()->to('/admin/pengaturan/sub_menu')->with('menu', 'Sub Menu Berhasil Dihapus');
    }

    // -------------------------------------------------------------------------------- //

    public function validasi_user($id = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $roleModel = new \App\Models\UserRoleModel();
        $userModel = new \App\Models\UsersModel();
        $data = array(
            'id_role' => $id,
            'role' => $roleModel->getRoleNotAdmin(),
            'user' => $userModel->getUser($id)
        );
        return view('pengaturan/validasi_user', $data);
    }

    public function edit_validasi_user($users_id = null)
    {
        if ($users_id != null) {
            $userModel = new \App\Models\UsersModel();

            $userModel
                ->update($users_id, ['is_active' => 1]);
            return redirect()->to('/admin/pengaturan/validasi_user')->with('success', 'Akun berhasil di validasi');
        } else {
            return redirect()->back(500);
        }
    }

    // -------------------------------------------------------------------------------- //

    public function user_menu($user_menu_id = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $userMenuModel  = new \App\Models\UserMenuModel();
        $userRoleModel  = new \App\Models\UserRoleModel();
        $menuModel      = new \App\Models\MenuModel();

        $data = array(
            'id' => $user_menu_id,
            'session' => $this->session,
            'menu' => $menuModel->asArray()->findAll(),
            'role' => $userRoleModel->asArray()->findAll(),
            'userMenu' => $userMenuModel->getData(),
            'userMenuById' => $userMenuModel->getData($user_menu_id),
            'form' => $user_menu_id == null ? 'tambah_menu_user' : 'edit_menu_user'
        );

        return view('pengaturan/user_menu', $data);
    }

    public function tambah_user_menu()
    {
        $userMenuModel  = new \App\Models\UserMenuModel();
        $data = array(
            'menu_id' => $this->request->getPost('menu'),
            'role_id' => $this->request->getPost('role')
        );
        $userMenuModel->insert($data);
        return redirect()->to('/admin/pengaturan/user_menu')->with('success', 'Akses Menu Untuk Role User Telah Ditambahkan');
    }

    public function edit_user_menu()
    {
        $userMenuModel  = new \App\Models\UserMenuModel();
        $data = array(
            'menu_id' => $this->request->getPost('menu'),
            'role_id' => $this->request->getPost('role')
        );
        $userMenuModel->update($this->request->getPost('user_menu_id'), $data);
        return redirect()->to('/admin/pengaturan/user_menu')->with('success', 'Akses Menu Untuk Role User Telah Dirubah');
    }

    public function hapus_user_menu($user_menu_id = null)
    {
        $userMenuModel  = new \App\Models\UserMenuModel();
        $userMenuModel->delete($user_menu_id);
        return redirect()->to('/admin/pengaturan/user_menu')->with('success', 'Akses Menu Untuk Role User Telah Dihapus');
    }

    // -------------------------------------------------------------------------------- //

    public function jenis_acara($id_acara = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $jenisAcara = new \App\Models\JenisAcaraModel();

        $data = [
            'id' => $id_acara,
            'form' => $id_acara == null ? 'tambah_jenis_acara' : 'edit_jenis_acara',
            'jenis_acara' => $jenisAcara->getJenisAcara(),
            'jenis_acara_row' => $jenisAcara->getJenisAcara($id_acara),
            'session' => $this->session
        ];
        return view('pengaturan/jenis_acara', $data);
    }

    public function tambah_jenis_acara()
    {
        $jenisAcara = new \App\Models\JenisAcaraModel();

        $data = array(
            'jenis_acara' => $this->request->getPost('jenis_acara'),
            'kode_warna' => $this->request->getPost('kode_warna'),
        );

        $jenisAcara->insert($data);
        return redirect()->to('/admin/pengaturan/jenis_acara')->with('acara', 'Jenis Acara Telah Ditambah');
    }

    public function edit_jenis_acara()
    {
        $jenisAcara = new \App\Models\JenisAcaraModel();

        $data = array(
            'jenis_acara' => $this->request->getPost('jenis_acara'),
            'kode_warna' => $this->request->getPost('kode_warna'),
        );

        $jenisAcara->update($this->request->getPost('id_jenis_acara'), $data);
        return redirect()->to('/admin/pengaturan/jenis_acara')->with('acara', 'Jenis Acara Telah Dirubah');
    }

    public function hapus_jenis_acara($id_jenis_acara)
    {
        if ($id_jenis_acara != null) {
            $jenisAcara = new \App\Models\JenisAcaraModel();
            $jenisAcara->delete($id_jenis_acara);
            return redirect()->to('/admin/pengaturan/jenis_acara')->with('acara', 'Jenis Acara Telah Dihapus');
        } else {
            return redirect()->back();
        }
    }
}
