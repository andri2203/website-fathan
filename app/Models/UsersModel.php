<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'users_id';

    protected $returnType    = 'array';

    protected $allowedFields = ['role_id', 'name', 'gender', 'email', 'password', 'image', 'phone', 'create_at', 'is_active'];

    public function emailCheck($email)
    {
        $builder = $this->db->table($this->table);
        $query = $builder->getWhere(['email' => $email])->getRowArray();
        return $query;
    }

    public function password_check($password)
    {
        $builder = $this->db->table($this->table);
        $query = $builder->getWhere(['password' => md5($password)])->getRowArray();
        return $query;
    }

    public function getUser($role_id = null)
    {
        $builder = $this->db
            ->table($this->table)
            ->join('user_role', 'user_role.role_id = users.role_id');

        if ($role_id == null) {
            $query = $builder->where('users.role_id != 1')->get();
            return $query->getResultArray();
        } else {
            $query = $builder->where('users.role_id = ' . $role_id)->get();
            return $query->getResultArray();
        }
    }

    public function getMC($limit = 0, $order = false)
    {
        $sess = \Config\Services::session();
        $promosi = new \App\Models\PromosiModel();

        $builder = $this->db
            ->table($this->table)
            ->join('promosi', 'promosi.id_mc = users.users_id');

        if ($order == true) {
            $builder->orderBy('users.users_id', 'RANDOM');
        }
        $builder->groupBy("users.users_id");
        $qry = array();

        if ($limit == 0) {
            $qry = $builder->getWhere(['users_id !=' => $sess->id])->getResultArray();
        } else {
            $qry = $builder->getWhere(['users_id !=' => $sess->id], $limit)->getResultArray();
        }

        for ($i = 0; $i < count($qry); $i++) {
            $qry[$i]['promosi'] = $promosi->getMcPromosi($qry[$i]['id_mc']);
        }

        return $qry;
    }

    public function searchMC($search, $date_start, $date_end)
    {
        $sess = \Config\Services::session();
        $promosi = new \App\Models\PromosiModel();

        $builder = $this->db
            ->table($this->table)
            ->join('promosi', 'promosi.id_mc = users.users_id')
            ->join('booking', 'booking.id_mc = users.users_id')
            ->where($search)
            ->where("booking.tanggal_jam NOT BETWEEN '$date_start' AND '$date_end'", NULL, false)
            ->where("DATE_ADD(booking.tanggal_jam, INTERVAL booking.jam_acara HOUR) NOT BETWEEN '$date_start' AND '$date_end'", NULL, false)
            ->groupBy('users.users_id');

        $qry = $builder->getWhere(['users_id !=' => $sess->id])->getResultArray();

        for ($i = 0; $i < count($qry); $i++) {
            $qry[$i]['promosi'] = $promosi->getMcPromosi($qry[$i]['id_mc']);
        }

        return $qry;
    }

    public function totalMC()
    {
        $builder = $this->db->table($this->table);
        $builder->where(['role_id' => 2, 'is_active' => 1]);
        return $builder->countAllResults();
    }

    public function totalPelanggan()
    {
        $builder = $this->db->table($this->table);
        $builder->where(['role_id' => 3, 'is_active' => 1]);
        return $builder->countAllResults();
    }

    public function peringkatMC()
    {
        $builder = $this->db->table($this->table)->select('users.users_id, users.name');
        $builder->selectCount('booking.id_booking', 'acara');
        $builder->selectSum('booking.jam_acara', 'jam');
        $builder->selectSum('booking.jumlah_peserta', 'peserta');
        $builder->join('booking', 'booking.id_mc = users.users_id');
        $builder->where(['users.role_id' => 2, 'users.is_active' => 1]);
        $builder->groupBy('users.users_id');
        $builder->orderBy('acara', 'DESC');
        $builder->orderBy('jam', 'DESC');
        $builder->orderBy('peserta', 'DESC');

        return $builder->get(7)->getResultArray();
    }
}
