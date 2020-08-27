<?php

namespace App\Controllers;

use App\Controllers\Base\CustomersController;

class Pelanggan extends CustomersController {
    public function index(Type $var = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }
        $booking = new \App\Models\BookingModel();
        $data = [
            'session'=>$this->session,
            'diTerima'=>$booking->numOfJobSuccess($this->session->id,'id_pemesan'),
            'diTolak'=>$booking->numOfJobDenied($this->session->id,'id_pemesan'),
            'jamAcara'=>$booking->numOfJobEvent_Hour($this->session->id,'id_pemesan'),
            'pesanan'=> $booking->getPesananBy_IdPemesan_dash($this->session->id),
        ];
        return view('user/pelanggan/beranda', $data);
    }
    
    public function pesanan(Type $var = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }
        $booking = new \App\Models\BookingModel();
        $data = [
            'session'=> $this->session,
            'pesanan'=> $booking->getPesananBy_IdPemesan($this->session->id),
        ];
        
        return view('user/pelanggan/pesanan', $data);
    }
}