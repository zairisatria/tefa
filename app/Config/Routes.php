<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// route home
$routes->get('', 'Home::index');
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

// route Auth
$routes->get('/login', 'Auth::login');
$routes->post('/proseslogin', 'Auth::proseslogin');
$routes->get('/registrasi', 'Auth::registrasi');
$routes->post('/proses_registrasi', 'Auth::proses_registrasi');
$routes->get('/logout', 'Auth::logout');

// route proposal user
$routes->get('/proposal', 'Proposal::index');
$routes->get('/pengajuan-proposal', 'Proposal::tambah');
// route jobsheet user
$routes->get('/jobsheet', 'Jobsheet::index');

$routes->get('/alat', 'Jobsheet::tambah_alat');
$routes->post('/simpan-alat', 'Jobsheet::simpan_alat');
$routes->get('/edit-alat/(:num)', 'Jobsheet::edit_alat/$1');
$routes->post('/update-alat', 'Jobsheet::update_alat');
$routes->get('/delete-alat/(:num)', 'Jobsheet::delete_alat/$1');
$routes->get('/laporan-jobsheet', 'Jobsheet::print_jobsheet_pdf');

$routes->get('/bahan', 'Jobsheet::tambah_bahan');
$routes->post('/simpan-bahan', 'Jobsheet::simpan_bahan');
$routes->get('/edit-bahan/(:num)', 'Jobsheet::edit_bahan/$1');
$routes->post('/update-bahan', 'Jobsheet::update_bahan');
$routes->get('/delete-bahan/(:num)', 'Jobsheet::delete_bahan/$1');

$routes->get('/langkah-kerja', 'Jobsheet::tambah_langkah');
$routes->post('/simpan-langkah', 'Jobsheet::simpan_langkah');
$routes->get('/edit-langkah/(:num)', 'Jobsheet::edit_langkah/$1');
$routes->post('/update-langkah', 'Jobsheet::update_langkah');
$routes->get('/delete-langkah/(:num)', 'Jobsheet::delete_langkah/$1');

// route logbook user
$routes->get('/logbook', 'Logbook::index');
$routes->get('/tambah-logbook', 'Logbook::tambah');
$routes->post('/simpan-logbook', 'Logbook::simpan');
$routes->get('/edit-logbook/(:num)', 'Logbook::edit/$1');
$routes->post('/update-logbook', 'Logbook::update');
$routes->get('/detail-logbook/(:num)', 'Logbook::detail_users/$1');
$routes->get('/delete-logbook/(:num)', 'Logbook::delete/$1');
$routes->get('/laporan-logbook', 'Logbook::print_logbook_pdf');
$routes->get('/logbook-kelompok', 'Logbook::print_logbook_pdf_kelompok');

// route proposal admin
$routes->post('/verifikasi-proposal', 'Proposal::verifikasi');
// route prodi admin
$routes->get('/prodi', 'Prodi::index');
$routes->get('/tambah-prodi', 'Prodi::tambah');
$routes->post('/simpan-prodi', 'Prodi::simpan');
$routes->get('/edit-prodi/(:num)', 'Prodi::edit/$1');
$routes->post('/update-prodi', 'Prodi::update');
$routes->get('/delete-prodi/(:num)', 'Prodi::delete/$1');
// route satuan admin
$routes->get('/satuan', 'Satuan::index');
$routes->get('/tambah-satuan', 'Satuan::tambah');
$routes->post('/simpan-satuan', 'Satuan::simpan');
$routes->get('/edit-satuan/(:num)', 'Satuan::edit/$1');
$routes->post('/update-satuan', 'Satuan::update');
$routes->get('/delete-satuan/(:num)', 'Satuan::delete/$1');
// route jobsheet admin
$routes->get('/detail-alat/(:num)', 'Jobsheet::detail_alat/$1');
$routes->get('/detail-bahan/(:num)', 'Jobsheet::detail_bahan/$1');
$routes->get('/detail-langkah-kerja/(:num)', 'Jobsheet::detail_langkah/$1');
$routes->get('/jobsheet-pdf/(:num)', 'Jobsheet::print_jobsheet_pdf_admin/$1');
// route log book admin
$routes->get('/detail-logbook-kelompok/(:num)', 'Logbook::detail_admin/$1');
$routes->get('/logbook-pdf/(:num)', 'Logbook::print_logbook_pdf_admin/$1');
// route penilaian admin
$routes->get('/penilaian', 'Penilaian::index');
$routes->get('/tambah-penilaian', 'Penilaian::tambah');
$routes->post('/simpan-penilaian', 'Penilaian::simpan');
$routes->get('/edit-penilaian/(:num)', 'Penilaian::edit/$1');
$routes->post('/update-penilaian', 'Penilaian::update');
$routes->get('/delete-penilaian/(:num)', 'Penilaian::delete/$1');
// route penilaian admin
$routes->get('/distribusi', 'Distribusi::index');
$routes->get('/tambah-distribusi', 'Distribusi::tambah');
$routes->post('/simpan-distribusi', 'Distribusi::simpan');
$routes->get('/edit-distribusi/(:num)', 'Distribusi::edit/$1');
$routes->post('/update-distribusi', 'Distribusi::update');
$routes->get('/delete-distribusi/(:num)', 'Distribusi::delete/$1');
// route manage users admin
$routes->get('/manage-users', 'Users::index');
$routes->get('/tambah-users', 'Users::tambah');
$routes->post('/simpan-users', 'Users::simpan');
$routes->get('/edit-users/(:num)', 'Users::edit/$1');
$routes->post('/update-users', 'Users::update');
$routes->get('/delete-users/(:num)', 'Users::delete/$1');
// route setting admin
$routes->get('/setting', 'Setting::index');
$routes->post('/update-setting', 'Setting::update');
// route profile admin dan users
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/update', 'Profile::update');
// route evaluasi admin
$routes->get('/evaluasi', 'Evaluasi::index');
$routes->get('/laporan-evaluasi', 'Evaluasi::laporan_evaluasi_pdf');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
