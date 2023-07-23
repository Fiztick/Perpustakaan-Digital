<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setAutoRoute(false);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Auth::index');

$routes->group('auth', static function ($routes) {
    $routes->get('/', 'Auth::Index');
    $routes->get('login', 'Auth::proses');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('register', static function ($routes) {
    $routes->get('/', 'Register::Index');
    $routes->post('proses', 'Register::proses');

});

$routes->group('buku', static function ($routes) {
    $routes->get('/', 'Book::Index');
    $routes->get('list-buku', 'Book::index');
    $routes->get('kelola-buku', 'Book::master');
    $routes->get('create', 'Book::create');
    $routes->post('store', 'Book::store');
    $routes->get('edit', 'Book::edit');
    $routes->put('update', 'Book::update');
    $routes->delete('delete', 'Book::delete');
    $routes->get('download', 'Book::download');
    $routes->get('export', 'Book::exportExcel');
});

$routes->group('kategori', static function ($routes) {
    $routes->get('/', 'Category::index');
    $routes->get('list-kategori', 'Category::index');
    $routes->get('create', 'Category::create');
    $routes->post('store', 'Category::store');
    $routes->get('edit', 'Category::edit');
    $routes->put('update', 'Category::update');
    $routes->delete('delete', 'Category::delete');
});



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
