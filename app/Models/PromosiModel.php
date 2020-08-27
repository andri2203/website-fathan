<?php

namespace App\Models;

use CodeIgniter\Model;

class PromosiModel extends Model
{
    protected $table         = 'promosi';
    protected $primaryKey    = 'id_promosi';

    protected $returnType    = 'array';

    protected $allowedFields = ['id_mc', 'id_jenis_acara'];


    public function getPromosi($id_promosi = null)
    {
        $session = \Config\Services::session();
        $builder = $this->db->table($this->table)
            ->select('promosi.id_promosi, promosi.id_mc, jenis_acara.jenis_acara')
            ->join('jenis_acara', 'jenis_acara.id_jenis_acara = promosi.id_jenis_acara')
            ->where(['promosi.id_mc' => $session->id]);
        if ($id_promosi == null) {
            return $builder->get()->getResultArray();
        } else {
            return $builder->getWhere(['id_promosi' => $id_promosi])->getRowArray();
        }
    }

    public function getMcPromosi($id_mc = null)
    {
        $builder = $this->db->table($this->table)
            ->select('promosi.id_promosi, promosi.id_mc, jenis_acara.jenis_acara, jenis_acara.kode_warna')
            ->join('jenis_acara', 'jenis_acara.id_jenis_acara = promosi.id_jenis_acara')
            ->where(['promosi.id_mc' => $id_mc]);
        return $builder->get()->getResultArray();
    }
}
