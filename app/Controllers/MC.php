<?php

namespace App\Controllers;

use App\Controllers\Base\McController;

class MC extends McController
{
    public function dashboard()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $booking = new \App\Models\BookingModel();
        $data = array(
            'diTerima' => $booking->numOfJobSuccess($this->session->id),
            'diTolak' => $booking->numOfJobDenied($this->session->id),
            'jamAcara' => $booking->numOfJobEvent_Hour($this->session->id),
            'saldo' => $booking->numOfJobBudget($this->session->id),
            'pesanan' => $booking->getPesananBy_IdMC_dash($this->session->id),
            'session' => $this->session
        );
        return view('user/mc/v_dashboard', $data);
    }

    public function pesanan()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $bookingModel = new \App\Models\BookingModel();

        $data = [
            'pesanan' => $bookingModel->getPesananBy_IdMC($this->session->id),
            'session' => $this->session
        ];

        return view('user/mc/v_pesanan', $data);
    }

    public function kalender()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $bookingModel = new \App\Models\BookingModel();
        $jenisAcaraBooking = new \App\Models\JenisAcaraModel();

        $data = [
            'kalender' => $bookingModel->calender($this->session->id),
            'jenis_acara' => $jenisAcaraBooking->findAll(),
        ];

        return view('user/mc/v_kalender', $data);
    }

    public function promosi($id_promosi = null)
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $promosiModel = new \App\Models\PromosiModel();
        $jenis_acara = new \App\Models\JenisAcaraModel();
        $data = array(
            'id' => $id_promosi,
            'form' => $id_promosi == null ? 'buat_promosi' : 'edit_promosi',
            'promosi' => $promosiModel->getPromosi(),
            'promosiById' => $promosiModel->getPromosi($id_promosi),
            'jenis_acara' => $jenis_acara->findAll(),
            'session' => $this->session
        );

        return view('user/mc/v_promosi', $data);
    }

    public function buat_promosi()
    {
        $promosiModel = new \App\Models\PromosiModel();

        $data = array(
            'id_mc' => $this->session->id,
            'id_jenis_acara' => $this->request->getPost('acara'),
        );
        $promosiModel->insert($data);
        return redirect()->to('/mc/promosi')->with('success', 'Promosi Berhasil dibuat');
    }

    public function edit_promosi()
    {
        $promosiModel = new \App\Models\PromosiModel();
        $promosiModel = new \App\Models\PromosiModel();

        $data = array(
            'id_mc' => $this->session->id,
            'id_jenis_acara' => $this->request->getPost('acara'),
        );
        $promosiModel->update($this->request->getPost('id_promosi'), $data);
        return redirect()->to('/mc/promosi')->with('success', 'Promosi Berhasil diubah');
    }

    public function hapus_promosi($id_promosi)
    {
        $promosiModel = new \App\Models\PromosiModel();
        $promosiModel->delete($id_promosi);
        return redirect()->to('/mc/promosi')->with('success', 'Promosi Berhasil dihapus');
    }

    public function terima($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookingModel->update($id_booking, ['di_terima' => 1]);
        return redirect()->to('/mc/booking')->with('success', 'Booking MC Berhasil diterima');
    }

    public function tolak($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookingModel->update($id_booking, ['di_terima' => 2]);
        return redirect()->to('/mc/booking')->with('success', 'Booking MC Berhasil ditolak');
    }

    public function selesai($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookingModel->update($id_booking, ['di_terima' => 3]);
        return redirect()->to('/mc/booking')->with('success', 'Konfirmasi acara selesai. Acara telah selesai diselenggarakan.');
    }
    
}
