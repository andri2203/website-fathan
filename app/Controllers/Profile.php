<?php

namespace App\Controllers;

use App\Controllers\Base\ProfileController;

class Profile extends ProfileController
{


    public function index()
    {
        return redirect()->to('/profil/profil_saya');
    }

    public function profil_saya()
    {
        $data = array(
            'user' => $this->user,
            'session' => $this->session,
        );
        return view('profil/profil_saya', $data);
    }

    public function foto()
    {
        return view('profil/form_ganti_foto');
    }

    public function password()
    {
        return view('profil/form_ganti_password');
    }

    public function ubah_profil()
    {
        $data = array(
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        );
        $this->userModel->update($this->session->id, $data);
        return redirect()->to('/profil/profil_saya')->with('berhasil', 'Info Akun anda telah diperbaharui');
    }

    public function ganti_foto()
    {
        $avatar = $this->request->getFile('foto');
        $path = FCPATH . 'uploads/' . $this->session->id;
        if (!file_exists($path)) {
            mkdir($path);
        }
        $avatar->move($path);
        $data = [
            'image' => $avatar->getName()
        ];
        $this->userModel->update($this->session->id, $data);
        return redirect()->to('/profil/profil_saya')->with('berhasil', 'Foto Akun anda telah diperbaharui');
    }

    public function ganti_password()
    {
        $data = array(
            'password' => md5($this->request->getPost('new_password')),
        );
        $this->userModel->update($this->session->id, $data);
        $this->session->remove(['id', 'name', 'role', 'role_id', 'route']);
        return redirect()->to('/login')->with('login', 'password anda telah dirubah. silahkan masuk kembali.');
    }

    public function password_checker()
    {
        $query = $this->userModel->password_check($this->request->getVar('current_password'));
        if ($query == null) {
            echo "false";
        } else {
            echo "true";
        }
    }
}
