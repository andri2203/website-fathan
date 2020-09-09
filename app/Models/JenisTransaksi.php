<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisTransaksi extends Model
{
    protected $table         = 'jenis_transaksi';
    protected $primaryKey    = 'id_jenis_transaksi';

    protected $returnType    = 'array';

    protected $allowedFields = ['jenis_transaksi', 'persen'];
}
