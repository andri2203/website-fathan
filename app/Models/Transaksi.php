<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
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
        $transaksi =  $this->db->table($this->table)
            ->select($this->table . '.*, jenis_transaksi.jenis_transaksi')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = ' . $this->table . '.id_jenis_transaksi')
            ->where([
                "{$this->table}.id_booking" => $id_booking
            ])
            ->orderBy($this->table . '.id_transaksi', 'DESC');

        return $transaksi;
    }
}
