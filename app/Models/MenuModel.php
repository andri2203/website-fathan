<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table         = 'menu';
    protected $primaryKey    = 'menu_id';

    protected $returnType    = 'array';

    protected $allowedFields = ['menu', 'icon', 'route', 'is_active'];

    public function getMenu($menu_id = null)
    {
        $builder = $this->db->table($this->table);
        if ($menu_id == null) {
            return $builder->get()->getResultArray();
        } else {
            return $builder->getWhere(['menu_id' => $menu_id])->getRowArray();
        }
    }
}
