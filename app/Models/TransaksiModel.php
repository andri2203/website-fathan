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
