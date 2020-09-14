<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id_transaksi';

    protected $returnType    = 'array';

    protected $allowedFields = [
        'id_booking',
        'id_jenis_transaksi',
        'tanggal',
        'jumlah',
        'bukti_pembayaran',
    ];

    public function transaksi_mc($id_mc)
    {
        $transaksi =  $this->db->table($this->table);
        $transaksi->select('jenis_transaksi.jenis_transaksi,transaksi.id_transaksi, jenis_acara.jenis_acara, transaksi.tanggal, transaksi.jumlah, transaksi.bukti_pembayaran, booking.*, users.name AS pengirim, users.phone AS telpon');
        $transaksi->join('booking', 'booking.id_booking = transaksi.id_booking');
        $transaksi->join('jenis_transaksi', 'transaksi.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi');
        $transaksi->join('users', 'users.users_id = booking.id_pemesan', 'left');
        $transaksi->join('jenis_acara', 'jenis_acara.id_jenis_acara = booking.id_acara', 'right');
        $transaksi->where("booking.id_mc", $id_mc);
        $transaksi->orderBy('transaksi.tanggal', 'DESC');
        return $transaksi->get()->getResultArray();
    }

    public function transaksi_pelanggan($id_pelanggan)
    {
        $transaksi =  $this->db->table($this->table);
        $transaksi->select('jenis_transaksi.jenis_transaksi ,transaksi.id_transaksi, jenis_acara.jenis_acara, transaksi.tanggal, transaksi.jumlah, transaksi.bukti_pembayaran, booking.*, users.name AS penerima, users.phone AS telpon');
        $transaksi->join('booking', 'booking.id_booking = transaksi.id_booking');
        $transaksi->join('jenis_transaksi', 'transaksi.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi');
        $transaksi->join('users', 'users.users_id = booking.id_mc', 'left');
        $transaksi->join('jenis_acara', 'jenis_acara.id_jenis_acara = booking.id_acara', 'right');
        $transaksi->where("booking.id_pemesan", $id_pelanggan);
        $transaksi->orderBy('transaksi.tanggal', 'DESC');
        return $transaksi->get()->getResultArray();
    }

    public function ambilTransaksiByBookingId($id_booking = null)
    {
        $transaksi =  $this->db->table($this->table);
        $transaksi->select('jenis_transaksi.jenis_transaksi, transaksi.* ');
        $transaksi->join('jenis_transaksi', 'transaksi.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi');
        $transaksi->where("transaksi.id_booking", $id_booking);
        $transaksi->orderBy('transaksi.id_transaksi', 'DESC');

        return $transaksi->get();
    }

    public function jumlahDataTransaksi($id_booking = null)
    {
        $transaksi =  $this->db->table($this->table);
        $transaksi->select('transaksi.*, jenis_transaksi.jenis_transaksi');
        $transaksi->join('jenis_transaksi', 'transaksi.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi');
        $transaksi->where("transaksi.id_booking", $id_booking);
        $transaksi->orderBy('transaksi.id_transaksi', 'DESC');

        return $transaksi->countAllResults();
    }

    public function jumlahBudgetTransaksi($id_booking = null)
    {
        $transaksi =  $this->db->table($this->table);
        $transaksi->selectSum('transaksi.jumlah', 'total');
        $transaksi->join('jenis_transaksi', 'transaksi.id_jenis_transaksi = jenis_transaksi.id_jenis_transaksi');
        $transaksi->where("transaksi.id_booking", $id_booking);
        $transaksi->orderBy('transaksi.id_transaksi', 'DESC');

        return $transaksi->get()->getRowObject();
    }
}
