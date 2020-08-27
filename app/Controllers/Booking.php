<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class Booking extends BaseController
{
    public function index()
    {
        $jenis_acara = new \App\Models\JenisAcaraModel();
        $usersModel = new \App\Models\UsersModel();

        $kota = function () {
            $db = \Config\Database::connect();
            $builder = $db->table('kota');
            return $builder->get()->getResultArray();
        };

        $data = array(
            'jenis_acara' => $jenis_acara->findAll(),
            'kota' => $kota(),
            'session' => $this->session
        );

        if (isset($_GET['search'])) {

            $date_start = $_GET['date'] . ' ' . $_GET['start'];
            $date_end = $_GET['date'] . ' ' . $_GET['end'];
            $search = '';

            switch ($_GET['type']) {
                case 'name':
                    $search_arr = explode(' ', $_GET['search']);

                    if (count($search_arr) == 1) {
                        $search = "users.name LIKE '%$search_arr[0]%'";
                    } else {
                        $arr = [];
                        for ($i = 0; $i < count($search_arr); $i++) {
                            $arr[] = "'%$search_arr[$i]%'";
                        }
                        $search = "users.name LIKE " . implode(" OR ", $arr);
                    }
                    break;

                case 'event':
                    $val = $_GET['search'];
                    $search = "promosi.id_jenis_acara = $val";
                    break;
            }


            $data['mc'] = $usersModel->searchMC($search, $date_start, $date_end);
        } else {
            $data['mc'] = $usersModel->getMC();
        }

        return view('v_booking', $data);
    }

    public function proses()
    {
        $input = $this->request->getPost();
        $bookingModel = new \App\Models\BookingModel();

        $total_mc = count($input['mc']);
        if ($total_mc == 1) {
            $bookingModel->insert(array(
                'id_acara' => $input['acara'],
                'id_pemesan' => $this->session->id,
                'id_mc' => $input['mc'][0],
                'tanggal_jam' => $input['tanggal'],
                'jam_acara' => $input['jam_acara'],
                'jumlah_peserta' => $input['jumlah_peserta'],
                'profil_peserta' => $input['profil'],
                'alamat' => $input['alamat'],
                'keterangan' => $input['keterangan'],
                'budget' => $input['budget'],
                'di_terima' => 0,
            ));
        } else {
            $batch = array();
            for ($i = 0; $i < $total_mc; $i++) {
                array_push($batch, array(
                    'id_acara' => $input['acara'],
                    'id_pemesan' => $this->session->id,
                    'id_mc' => $input['mc'][$i],
                    'tanggal_jam' => $input['tanggal'],
                    'jam_acara' => $input['jam_acara'],
                    'jumlah_peserta' => $input['jumlah_peserta'],
                    'profil_peserta' => $input['profil'],
                    'alamat' => $input['alamat'],
                    'keterangan' => $input['keterangan'],
                    'budget' => $input['budget'],
                    'di_terima' => 0,
                ));
            }
            $bookingModel->insertBatch($batch);
        }

        return redirect()->to($this->session->route . '/pesanan')->with('success', $total_mc . ' Pesanan anda berhasil dilakukan.');
    }

    public function delete($id_booking = null)
    {
        if ($id_booking == null) {
            return redirect()->back();
        } else {
            $bookingModel = new \App\Models\BookingModel();
            $bookingModel->delete($id_booking);
            return redirect()->to($this->session->route . '/pesanan')->with('success', 'Pesanan anda berhasil dihapus.');
        }
    }

    public function update($id_booking = null)
    {
        if ($id_booking == null) {
            return redirect()->back();
        } else {
            $jenis_acara = new \App\Models\JenisAcaraModel();
            $usersModel = new \App\Models\UsersModel();
            $bookingModel = new \App\Models\BookingModel();

            $kota = function () {
                $db = \Config\Database::connect();
                $builder = $db->table('kota');
                return $builder->get()->getResultArray();
            };

            $data = array(
                'jenis_acara' => $jenis_acara->findAll(),
                'kota' => $kota(),
                'session' => $this->session,
                'id_booking' => $id_booking,
                'booking' => $bookingModel->asObject()->find($id_booking)
            );

            if (isset($_GET['search'])) {

                $date_start = $_GET['date'] . ' ' . $_GET['start'];
                $date_end = $_GET['date'] . ' ' . $_GET['end'];
                $search = '';

                switch ($_GET['type']) {
                    case 'name':
                        $search_arr = explode(' ', $_GET['search']);

                        if (count($search_arr) == 1) {
                            $search = "users.name LIKE '%$search_arr[0]%'";
                        } else {
                            $arr = [];
                            for ($i = 0; $i < count($search_arr); $i++) {
                                $arr[] = "'%$search_arr[$i]%'";
                            }
                            $search = "users.name LIKE " . implode(" OR ", $arr);
                        }
                        break;

                    case 'event':
                        $val = $_GET['search'];
                        $search = "promosi.id_jenis_acara = $val";
                        break;
                }


                $data['mc'] = $usersModel->searchMC($search, $date_start, $date_end);
            } else {
                $data['mc'] = $usersModel->getMC();
            }

            return view('v_booking_update', $data);
        }
    }

    public function update_proses()
    {
        $input = $this->request->getPost();
        $bookingModel = new \App\Models\BookingModel();

        $bookingModel->update($input['id_booking'], array(
            'id_acara' => $input['acara'],
            'id_pemesan' => $this->session->id,
            'id_mc' => $input['mc_1'],
            'tanggal_jam' => $input['tanggal'],
            'jam_acara' => $input['jam_acara'],
            'jumlah_peserta' => $input['jumlah_peserta'],
            'profil_peserta' => $input['profil'],
            'alamat' => $input['alamat'],
            'keterangan' => $input['keterangan'],
            'budget' => $input['budget_mc_1'],
            'di_terima' => 0,
        ));

        return redirect()->to($this->session->route . '/pesanan')->with('success', 'Pesanan anda berhasil diperbarui.');
    }

    public function calendar($id_mc)
    {
        $bookingModel = new \App\Models\BookingModel();
        echo json_encode($bookingModel->calender($id_mc));
    }
}
