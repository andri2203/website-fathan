<?php

namespace App\Controllers;

use App\Controllers\Base\AdminController;

class Admin extends AdminController
{

    public function index()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/admin/login');
        }

        $booking = new \App\Models\BookingModel();
        $roleModel = new \App\Models\UserRoleModel();
        $user = new \App\Models\UsersModel();
        $data = [
            'role' => $roleModel->getRoleNotAdmin(),
            'acaraBerlangsung' => $booking->numOfJobSuccess_admin(),
            'totalMC' => $user->totalMC(),
            'totalPelanggan' => $user->totalPelanggan(),
            'user' => $user->getUser()
        ];

        return view('admin/beranda', $data);
    }
}
