<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table         = 'booking';
    protected $primaryKey    = 'id_booking';

    protected $returnType    = 'array';

    protected $allowedFields = [
        'id_acara',
        'id_pemesan',
        'id_mc',
        'tanggal_jam',
        'jam_acara',
        'jumlah_peserta',
        'profil_peserta',
        'alamat',
        'keterangan',
        'budget',
        'di_terima',
    ];

    public function getPesananBy_IdPemesan($id_pemesan)
    {
        $sql = "SELECT `booking`.*, `jenis_acara`.`jenis_acara`, `users`.`name`
        FROM `booking`
        INNER JOIN `jenis_acara` ON `jenis_acara`.`id_jenis_acara` = `booking`.`id_acara`
        INNER JOIN `users` ON `users`.`users_id` = `booking`.`id_mc`
        WHERE `booking`.`id_pemesan` = $id_pemesan
        ORDER BY `booking`.`id_booking` DESC";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function getPesananBy_IdPemesan_dash($id_pemesan)
    {
        $sql = "SELECT `booking`.*, `jenis_acara`.`jenis_acara`, `users`.`name`
        FROM `booking`
        INNER JOIN `jenis_acara` ON `jenis_acara`.`id_jenis_acara` = `booking`.`id_acara`
        INNER JOIN `users` ON `users`.`users_id` = `booking`.`id_mc`
        WHERE `booking`.`id_pemesan` = $id_pemesan
        ORDER BY `booking`.`id_booking` DESC LIMIT 5";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function getPesananBy_IdMC($id_mc)
    {
        $sql = "SELECT `booking`.*, `jenis_acara`.`jenis_acara`, `users`.`name`, `users`.`phone`
        FROM `booking`
        INNER JOIN `jenis_acara` ON `jenis_acara`.`id_jenis_acara` = `booking`.`id_acara`
        INNER JOIN `users` ON `users`.`users_id` = `booking`.`id_pemesan`
        WHERE `booking`.`id_mc` = $id_mc
        ORDER BY `booking`.`id_booking` DESC";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function getPesananBy_IdMC_dash($id_mc)
    {
        $sql = "SELECT `booking`.*, `jenis_acara`.`jenis_acara`, `users`.`name`, `users`.`phone`
        FROM `booking`
        INNER JOIN `jenis_acara` ON `jenis_acara`.`id_jenis_acara` = `booking`.`id_acara`
        INNER JOIN `users` ON `users`.`users_id` = `booking`.`id_pemesan`
        WHERE `booking`.`id_mc` = $id_mc
        ORDER BY `booking`.`id_booking` DESC LIMIT 5";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function calender($id_mc)
    {
        $builder = $this->db->table($this->table);
        $builder->select('booking.*, jenis_acara.jenis_acara, jenis_acara.kode_warna, users.name');
        $builder->join('jenis_acara', 'jenis_acara.id_jenis_acara = booking.id_acara');
        $builder->join('users', 'users.users_id = booking.id_pemesan');
        $builder->where(['booking.id_mc' => $id_mc, 'booking.di_terima' => 1]);

        $respon = $builder->get()->getResultArray();
        $events = array();

        foreach ($respon as $data) :
            $event = [
                'id' => $data['id_booking'],
                'title' => $data['name'] . ' (' . $data['jenis_acara'] . ')',
                'start' => $data['tanggal_jam'],
                'end' => date('Y-m-d H:i:s', strtotime('+' . $data['jam_acara'] . 'hour', strtotime($data['tanggal_jam']))),
                'allDay' => false,
                'url' => 'javascript:void(0)',
                'backgroundColor' => $data['kode_warna'],
                'borderColor' => $data['kode_warna'],
                'data' => [
                    'jumlah_peserta'  => $data['jumlah_peserta'],
                    'profil_peserta'  => $data['profil_peserta'],
                    'alamat'  => $data['alamat'],
                    'keterangan'  => $data['keterangan'],
                ],
            ];
            array_push($events, $event);
        endforeach;

        return $events;
    }

    public function numOfJobSuccess($id, $q = 'id_mc')
    {
        $builder = $this->db->table($this->table);
        $builder->where([$q => $id, 'di_terima' => 1]);
        return $builder->countAllResults();
    }

    public function numOfJobDenied($id, $q = 'id_mc')
    {
        $builder = $this->db->table($this->table);
        $builder->where([$q => $id, 'di_terima' => 2]);
        return $builder->countAllResults();
    }

    public function numOfJobEvent_Hour($id, $q = 'id_mc')
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('jam_acara', 'jam');
        $builder->where([$q => $id, 'di_terima' => 1]);
        return $builder->get()->getRowArray();
    }

    public function numOfJobBudget($id_mc)
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('budget', 'saldo');
        $builder->where(['id_mc' => $id_mc, 'di_terima' => 1]);
        return $builder->get()->getRowArray();
    }


    public function numOfJobSuccess_admin()
    {
        $builder = $this->db->table($this->table);
        $builder->where(['di_terima' => 1]);
        return $builder->countAllResults();
    }

    public function numOfJobDenied_admin()
    {
        $builder = $this->db->table($this->table);
        $builder->where(['di_terima' => 2]);
        return $builder->countAllResults();
    }
}
