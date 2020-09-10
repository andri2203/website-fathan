<?php

namespace Config;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Route GET
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->get('logout', function () {
	$session = \Config\Services::session();
	$session->remove(['id', 'name', 'role', 'role_id', 'route']);
	return redirect()->to('/');
});

// Route POST
$routes->post('login/proses', 'Auth::login_proses');
$routes->post('register/proses', 'Auth::register_proses');

// Route Group
$routes->group('admin', function ($routes) {

	// Route Get
	$routes->get('', 'Admin::index');
	$routes->get('login', 'Auth::admin');

	// Route Post
	$routes->post('login', 'Auth::login_proses');

	$db = \Config\Database::connect();
	$sql = "SELECT `user_menu`.*, `menu`.`route`
	FROM `user_menu`
	INNER JOIN `menu`
	ON `menu`.`menu_id` = `user_menu`.`menu_id`
	WHERE `user_menu`.`role_id` = 1 AND `menu`.`is_active` = 1";
	$menu = $db->query($sql);

	foreach ($menu->getResultArray() as $mn) :
		$sql1 = "SELECT * FROM sub_menu WHERE menu_id = :id_menu:";
		$subMenu = $db->query($sql1, [
			'id_menu' => $mn['menu_id']
		]);

		foreach ($subMenu->getResultArray() as $sm) :
			$menu = $mn['route'];
			$subMenu = $sm['sub_route'];
			if ($menu == "Pengaturan") {

				$routes->get(strtolower("$menu/$subMenu"), "$menu::$subMenu");
				$routes->get(strtolower("$menu/$subMenu/(:num)"), "$menu::$subMenu/$1");

				$routes->post(strtolower("$menu/tambah_$subMenu"), "$menu::tambah_$subMenu");
				$routes->post(strtolower("$menu/edit_$subMenu"), "$menu::edit_$subMenu");
				$routes->get(strtolower("$menu/hapus_$subMenu/(:num)"), "$menu::hapus_$subMenu/$1");
			}
		endforeach;
	endforeach;
});

$routes->group('mc', function ($routes) {
	$routes->get('/', 'MC::dashboard');
	$routes->get('booking', 'MC::pesanan');
	$routes->get('kalender', 'MC::kalender');
	$routes->get('promosi', 'MC::promosi');
	$routes->get('promosi/(:num)', 'MC::promosi/$1');
	$routes->get('pesanan', 'Pelanggan::pesanan');

	$routes->post('buat_promosi', 'MC::buat_promosi');
	$routes->post('edit_promosi', 'MC::edit_promosi');
	$routes->get('hapus_promosi/(:num)', 'MC::hapus_promosi/$1');
	$routes->get('terima/(:num)', 'MC::terima/$1');
	$routes->get('tolak/(:num)', 'MC::tolak/$1');
	$routes->get('selesai/(:num)', 'MC::selesai/$1');

	$routes->group('transaksi', function ($routes) {
		$routes->get('/', 'Transaksi::view_mc');
	});
});

$routes->group('pelanggan', function ($routes) {
	$routes->get('/', 'Pelanggan::index');
	$routes->get('pesanan', 'Pelanggan::pesanan');
	$routes->post('ulasan/(:num)', 'Pelanggan::ulasan/$1');

	$routes->group('transaksi', function ($routes) {
		$routes->get('/', 'Transaksi::view_pelanggan');
		$routes->post('add/(:num)', 'Transaksi::add_transaksi/$1');
	});
});

$routes->group('profil', function ($routes) {
	$routes->get('/', 'Profile::index');
	$routes->get('profil_saya', 'Profile::profil_saya');
	$routes->get('password', 'Profile::password');
	$routes->get('foto', 'Profile::foto');

	$routes->post('profil_saya', 'Profile::ubah_profil');
	$routes->post('ganti_password', 'Profile::ganti_password');
	$routes->post('ganti_foto', 'Profile::ganti_foto');
});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
