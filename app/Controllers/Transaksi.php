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


        $path = FCPATH . 'uploads/' . $this->session->id . '/transaksi';
        $rename_path = "transaksi-$id_booking-$id_jenis_transaksi-$total_pembayaran." . $file_pembayaran->getExtension();

        if (!file_exists($path)) :
            mkdir($path);
        endif;

        if ($file_pembayaran->move($path, $rename_path)) :
            $upload = [
                "id_booking" => $id_booking,
                "id_jenis_transaksi" => $id_jenis_transaksi,
                "tanggal" => date("Y-m-d H:i:s"),
                "jumlah" => $total_pembayaran,
                "bukti_pembayaran" => $rename_path,
            ];

            if ($transaksi->save($upload)) :
                return redirect()->to('/pelanggan/pesanan')->with('success', 'Berhasil Membuat Pembayaran.');
            else :
                return redirect()->to('/pelanggan/pesanan')->with('error', 'Gagal Membuat Pembayaran : ' . $transaksi->errors());
            endif;
        else :
            return redirect()->to('/pelanggan/pesanan')->with('error', "Error : " . $file_pembayaran->getErrorString());
        endif;
    }

    public function update_transaksi($id_transaksi)
    {
        $transaksi = new \App\Models\Transaksi();
        $id_jenis_transaksi = $this->request->getPost("u_jenis_transaksi_$id_transaksi");
        $total_pembayaran = $this->request->getPost("u_total_$id_transaksi");
        $file_pembayaran = $this->request->getFile("u_file_$id_transaksi");


        $path = FCPATH . 'uploads/' . $this->session->id . '/transaksi';
        $rename_path = "transaksi-$id_transaksi-$id_jenis_transaksi-$total_pembayaran." . $file_pembayaran->getExtension();

        if ($file_pembayaran->getFilename() != "") :
            if ($file_pembayaran->move($path, $rename_path)) :
                $upload = [
                    "id_jenis_transaksi" => $id_jenis_transaksi,
                    "tanggal" => date("Y-m-d H:i:s"),
                    "jumlah" => $total_pembayaran,
                    "bukti_pembayaran" => $rename_path,
                ];

                if ($transaksi->update($id_transaksi, $upload)) :
                    return redirect()->to('/pelanggan/pesanan')->with('success', 'Berhasil Mengubah Pembayaran.');
                else :
                    return redirect()->to('/pelanggan/pesanan')->with('error', 'Gagal Mengubah Pembayaran : ' . $transaksi->errors());
                endif;
            else :
                return redirect()->to('/pelanggan/pesanan')->with('error', "Error : " . $file_pembayaran->getErrorString());
            endif;
        else :
            $upload = [
                "id_jenis_transaksi" => $id_jenis_transaksi,
                "tanggal" => date("Y-m-d H:i:s"),
                "jumlah" => $total_pembayaran,
            ];

            if ($transaksi->update($id_transaksi, $upload)) :
                return redirect()->to('/pelanggan/pesanan')->with('success', 'Berhasil Membuat Pembayaran.');
            else :
                return redirect()->to('/pelanggan/pesanan')->with('error', 'Gagal Membuat Pembayaran : ' . $transaksi->errors());
            endif;
        endif;
    }

    public function pelunasan_transaksi(int $id_booking = null)
    {
        $transaksi = new \App\Models\Transaksi();

        $total_pembayaran = $this->request->getPost("p_total_$id_booking");
        $file_pembayaran = $this->request->getFile("p_file_$id_booking");


        $path = FCPATH . 'uploads/' . $this->session->id . '/transaksi';
        $rename_path = "transaksi-$id_booking-pelunasan." . $file_pembayaran->getExtension();

        if ($file_pembayaran->move($path, $rename_path)) :
            $upload = [
                "id_booking" => $id_booking,
                "id_jenis_transaksi" => 4,
                "tanggal" => date("Y-m-d H:i:s"),
                "jumlah" => $total_pembayaran,
                "bukti_pembayaran" => $rename_path,
            ];

            if ($transaksi->save($upload)) :
                return redirect()->to('/pelanggan/pesanan')->with('success', 'Berhasil Membuat Pembayaran.');
            else :
                return redirect()->to('/pelanggan/pesanan')->with('error', 'Gagal Membuat Pembayaran : ' . $transaksi->errors());
            endif;
        else :
            return redirect()->to('/pelanggan/pesanan')->with('error', "Error : " . $file_pembayaran->getErrorString());
        endif;
    }
}
