<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
    protected $table = 'sub_menu';
    protected $primaryKey    = 'sub_menu_id';

    protected $returnType    = 'array';

    protected $allowedFields = ['menu_id', 'sub_menu', 'sub_route'];

    public function SubMenuByMenuIdAll()
    {
        $builder = $this->db
            ->table($this->table)
            ->join('menu', 'menu.menu_id = ' . $this->table . '.menu_id');
        return $builder
            ->orderBy('menu.menu_id', 'ASC')
            ->get()
            ->getResultArray();
    }
}
