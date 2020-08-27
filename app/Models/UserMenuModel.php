<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMenuModel extends Model
{
    protected $table      = 'user_menu';
    protected $primaryKey = 'user_menu_id';

    protected $returnType     = 'array';

    protected $allowedFields = ['menu_id', 'role_id'];

    public function getData($user_menu_id = null)
    {
        $builder = $this->db->table($this->table);

        if ($user_menu_id == null) {
            $query = $builder->join('menu', 'menu.menu_id = user_menu.menu_id')
                ->join('user_role', 'user_role.role_id = user_menu.role_id')
                ->get();
            return $query->getResultArray();
        } else {
            $query = $builder->join('menu', 'menu.menu_id = user_menu.menu_id')
                ->join('user_role', 'user_role.role_id = user_menu.role_id')
                ->where('user_menu_id', $user_menu_id)
                ->get();
            return $query->getRowArray();
        }
    }
}
