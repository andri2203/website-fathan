<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table         = 'user_role';
    protected $primaryKey    = 'role_id';

    protected $returnType    = 'array';

    protected $allowedFields = ['role', 'route'];

    public function getRoleNotAdmin()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->where('role_id != 1')->get();
        return $query->getResultArray();
    }
}
