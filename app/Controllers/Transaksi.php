<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class Transaksi extends BaseController
{

    public function view_mc()
    {
    }
    public function view_pelanggan()
    {
    }

    public function add_transaksi(int $id_booking = null)
    {
        $transaksi = new \App\Models\Transaksi();

        $id_jenis_transaksi = $this->request->getPost("jenis_transaksi_$id_booking");
        $total_pembayaran = $this->request->getPost("total_$id_booking");
        $file_pembayaran = $this->request->getFile("file_$id_booking");
        dd($file_pembayaran);
        echo $total_pembayaran;
        echo $id_jenis_transaksi;
    }
}
