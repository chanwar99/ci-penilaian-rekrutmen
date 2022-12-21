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
$routes->setDefaultController('App\Controllers\Admin\Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->group('/', function ($routes) {
    $routes->add('', 'Admin\Dashboard::index', ['filter' => 'auth']);
    $routes->add('panggil-tes', 'Admin\Dashboard::test_call', ['filter' => 'auth']);
    $routes->add('panggil-lulus-tes', 'Admin\Dashboard::pass_test_call', ['filter' => 'auth']);
});

$routes->group('kelola-pelamar', function ($routes) {
    $routes->add('', 'Admin\Applicant::index', ['filter' => 'auth']);
    $routes->add('panggil', 'Admin\Applicant::call', ['filter' => 'auth']);
    $routes->add('modal', 'Admin\Applicant::modal', ['filter' => 'auth']);
    $routes->add('simpan', 'Admin\Applicant::save', ['filter' => 'auth']);
    $routes->add('hapus', 'Admin\Applicant::delete', ['filter' => 'auth']);
});

$routes->group('kelola-topik', function ($routes) {
    $routes->add('', 'Admin\Topic::index', ['filter' => 'auth']);
    $routes->add('panggil', 'Admin\Topic::call', ['filter' => 'auth']);
    $routes->add('modal', 'Admin\Topic::modal', ['filter' => 'auth']);
    $routes->add('simpan', 'Admin\Topic::save', ['filter' => 'auth']);
    $routes->add('hapus', 'Admin\Topic::delete', ['filter' => 'auth']);
});

$routes->group('kelola-soal', function ($routes) {
    $routes->add('', 'Admin\Question::index', ['filter' => 'auth']);
    $routes->add('panggil', 'Admin\Question::call', ['filter' => 'auth']);
    $routes->add('modal', 'Admin\Question::modal', ['filter' => 'auth']);
    $routes->add('simpan', 'Admin\Question::save', ['filter' => 'auth']);
    $routes->add('hapus', 'Admin\Question::delete', ['filter' => 'auth']);
});

$routes->group('kelola-tes', function ($routes) {
    $routes->add('', 'Admin\Test::index', ['filter' => 'auth']);
    $routes->add('panggil', 'Admin\Test::call', ['filter' => 'auth']);
    $routes->add('modal', 'Admin\Test::modal', ['filter' => 'auth']);
    $routes->add('simpan', 'Admin\Test::save', ['filter' => 'auth']);
    $routes->add('hapus', 'Admin\Test::delete', ['filter' => 'auth']);
});

$routes->group('hasil', function ($routes) {
    $routes->add('', 'Admin\Result::index', ['filter' => 'auth']);
    $routes->add('panggil', 'Admin\Result::call', ['filter' => 'auth']);
    $routes->add('modal', 'Admin\Result::modal', ['filter' => 'auth']);
    $routes->add('simpan', 'Admin\Result::save', ['filter' => 'auth']);
    $routes->add('hapus', 'Admin\Result::delete', ['filter' => 'auth']);
});

$routes->group('tes', function ($routes) {
    $routes->add('', 'Test\TestStart::index', ['filter' => 'test_start']);
    $routes->add('nilai', 'Test\TestStart::rate', ['filter' => 'test_start']);

    $routes->group('detail', function ($routes) {
        $routes->add('', 'Test\TestDetails::index', ['filter' => 'test_auth']);
        $routes->add('mulai', 'Test\TestDetails::start', ['filter' => 'test_auth']);
    });

    $routes->add('hasil', 'Test\TestResult::index', ['filter' => 'test_auth']);

    $routes->group('login', function ($routes) {
        $routes->add('', 'Auth\TestLogin::index');
        $routes->add('proses', 'Auth\TestLogin::process');
        $routes->add('keluar', 'Auth\TestLogin::logout');
    });
});


$routes->group('login', function ($routes) {
    $routes->add('/', 'Auth\Login::index');
    $routes->add('proses', 'Auth\Login::process');
    $routes->add('keluar', 'Auth\Login::logout');
});


/**
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
