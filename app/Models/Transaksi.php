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
}
