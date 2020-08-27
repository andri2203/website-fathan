<?php

namespace App\Controllers;

use App\Controllers\Base\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$jenis_acara = new \App\Models\JenisAcaraModel();
		$mc = new \App\Models\UsersModel();
		$data = [
			'session' => $this->session,
			'jenis_acara' => $jenis_acara->findAll(),
			'mc' => $mc->getMC(12, true),
			'peringkat_mc' => $mc->peringkatMC(),
		];
		return view('home/index', $data);
	}

	//--------------------------------------------------------------------

}
