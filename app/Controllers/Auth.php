<?php

namespace App\Controllers;

use App\Controllers\Base\AuthController;

class Auth extends AuthController
{

    public function login()
    {
        if ($this->session->has('id')) {
            return redirect()->to($this->session->route);
        }
        $data = [
            'session' => $this->session
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        if ($this->session->has('id')) {
            return redirect()->to($this->session->route);
        }
        $data = [
            'session' => $this->session
        ];
        return view('auth/register', $data);
    }

    public function admin()
    {
        if ($this->session->has('id')) {
            return redirect()->to($this->session->route);
        }
        $data = [
            'session' => $this->session
        ];
        return view('auth/admin', $data);
    }

    public function login_proses()
    {
        $db = \Config\Database::connect();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $sql = "SELECT users.*, user_role.route, user_role.role
         FROM users 
         INNER JOIN user_role
         On user_role.role_id = users.role_id
         WHERE users.email = :email:";
        $qry = $db->query($sql, ['email' => $email]);

        if ($qry) {
            if (count($qry->getResultArray()) > 0) {
                $row = $qry->getRowArray();

                if ($row['password'] == md5($password)) {
                    if ($row['is_active'] == 1) {
                        $this->session->set([
                            'id' => $row['users_id'],
                            'name' => $row['name'],
                            'role' => $row['role'],
                            'role_id' => $row['role_id'],
                            'route' => $row['route'],
                        ]);
                        return redirect()->to($row['route']);
                    } else {
                        $this->session->setFlashdata('login', 'Akun anda belum di validasi oleh admin. Silahkan tunggu / Masuk dilain waktu');
                        return redirect()->back()->withInput();
                    }
                } else {
                    $this->session->setFlashdata('login', 'Password Salah');
                    return redirect()->back()->withInput();
                }
            } else {
                $this->session->setFlashdata('login', 'Email Belum Terdaftar');
                return redirect()->back()->withInput();
            }
        } else {
            echo "Something Wrong";
        }
    }

    public function register_proses()
    {
        $usersModel = new \App\Models\UsersModel();
        $data = array(
            'role_id' => $this->request->getPost('user_role'),
            'name' => $this->request->getPost('nama'),
            'gender' => $this->request->getPost('gender'),
            'email' => $this->request->getPost('email'),
            'password' => md5($this->request->getPost('password')),
            'phone' => $this->request->getPost('phone'),
            'create_at' => date('Y:m:d H:i:s'),
            'is_active' => 0
        );
        $usersModel->insert($data);
        return redirect()->to('/login')->with('login', 'Akun anda berhasil didaftarkan. Silahkan tunggu, akun anda sedang di validasi oleh admin.');
    }

    public function emailChecker()
    {
        $usersModel = new \App\Models\UsersModel();
        $query = $usersModel->emailCheck($this->request->getVar('email'));
        if ($query == null) {
            echo "true";
        } else {
            echo "false";
        }
    }
}
