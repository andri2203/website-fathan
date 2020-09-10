<?php

namespace App\Controllers;

use App\Controllers\Base\CustomersController;

class Pelanggan extends CustomersController
{

    public function index()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $booking = new \App\Models\BookingModel();
        $data = [
            'session' => $this->session,
            'diTerima' => $booking->numOfJobSuccess($this->session->id, 'id_pemesan'),
            'diTolak' => $booking->numOfJobDenied($this->session->id, 'id_pemesan'),
            'jamAcara' => $booking->numOfJobEvent_Hour($this->session->id, 'id_pemesan'),
            'pesanan' => $booking->getPesananBy_IdPemesan_dash($this->session->id),
        ];

        return view('user/pelanggan/beranda', $data);
    }



    public function pesanan()
    {
        if (!$this->session->has('id')) {
            return redirect()->to('/login')->with('login', 'Maaf, Session Login Anda telah habis. Silahkan login kembali');
        }

        $booking = new \App\Models\BookingModel();
        $jenisTransaksi = new \App\Models\JenisTransaksi();

        $data = [
            'session' => $this->session,
            'pesanan' => $booking->getPesananBy_IdPemesan($this->session->id),
            'jenisTransaksi' => $jenisTransaksi->where('id_jenis_transaksi !=', 4)->asObject()->findAll(),
            'transaksi' => function ($id_booking) {
                $transaksi = new \App\Models\Transaksi();

                return $transaksi->ambilTransaksiByBookingId($id_booking);
            }
        ];

        return view('user/pelanggan/pesanan', $data);
    }

    public function ulasan($id_booking)
    {
        $bookingModel = new \App\Models\BookingModel();
        $bookingModel->update($id_booking, [
            'point' => $this->request->getPost('poin'),
            'ulasan' => $this->request->getPost('ulasan')
        ]);

        return redirect()->to('/pelanggan/pesanan')->with('success', 'Berhasil Menambahkan Ulasan');
    }
}
