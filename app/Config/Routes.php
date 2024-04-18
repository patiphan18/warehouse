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
$routes->setDefaultController('Warehouse');
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

$routes->add('/', 'User::index', ['filter' => 'auth']);
$routes->get('/user/show_profile', 'User::show_profile', ['filter' => 'auth']);
$routes->get('/user/show_change_password', 'User::show_change_password', ['filter' => 'auth']);
$routes->get('/user/change_password', 'User::show_change_password', ['filter' => 'auth']);

$routes->get('/medicine/show_medicine', 'Medicine::show_medicine', ['filter' => 'auth']);
$routes->get('/medicine/insert_medicine', 'Medicine::insert_medicine', ['filter' => 'auth']);
$routes->get('/medicine/edit_medicine', 'Medicine::insert_medicine', ['filter' => 'auth']);

$routes->get('/lot/show_lot', 'Lot::show_lot', ['filter' => 'auth']);
$routes->get('/lot/insert_lot', 'Lot::insert_lot', ['filter' => 'auth']);
$routes->get('/lot/export_lot', 'Lot::export_lot', ['filter' => 'auth']);
$routes->get('/lot/update_lot_status', 'Lot::update_lot_status', ['filter' => 'auth']);

$routes->get('/moving/show_moving', 'Moving::show_moving', ['filter' => 'auth']);

$routes->get('/logout', 'Warehouse::logout');

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
