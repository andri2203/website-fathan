<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisAcaraModel extends Model
{
    protected $table         = 'jenis_acara';
    protected $primaryKey    = 'id_jenis_acara';

    protected $returnType    = 'array';

    protected $allowedFields = ['jenis_acara', 'kode_warna'];

    public function getJenisAcara($id_jenis_acara = null)
    {
        $builder = $this->db->table($this->table);
        if ($id_jenis_acara == null) {
            return $builder->get()->getResultArray();
        } else {
            return $builder->getWhere(['id_jenis_acara' => $id_jenis_acara])->getRowArray();
        }
    }
}
