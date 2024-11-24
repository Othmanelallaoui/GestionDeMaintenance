<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::login');
$routes->get('auth/login', 'Auth::login');

$routes->post('/auth/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/client/dashboard', 'Client::index');

$routes->get('/technicien/dashboard', 'Technicien::index');

//admin routes
$routes->get('/admin/dashboard', 'Admin::index');
$routes->get('/admin/gestion_technicien', 'Admin::gestion_technicien');
$routes->get('/admin/gestion_client', 'Admin::gestion_client');
$routes->get('admin/ajouter_technicien','Admin::ajouter_technicien');
$routes->post('admin/store_technicien','Admin::store_technicien');
$routes->post('admin/gestion_technicien', 'Admin::gestion_technicien');
$routes->get('/admin/reset_password/(:num)', 'Admin::reset_password/$1'); 
$routes->get('/profil', 'Auth::profil');
$routes->get('/admin/profil', 'Admin::profil');



$routes->get('/technicien/edit/(:num)', 'Technicien::edit/$1'); 
$routes->get('/technicien/delete/(:num)', 'Technicien::delete/$1'); 
$routes->post('/technicien/update/(:num)', 'Technicien::update/$1');



$routes->get('/client/edit/(:num)', 'Client::edit/$1'); 
$routes->get('/client/delete/(:num)', 'Client::delete/$1'); 
$routes->post('/client/update/(:num)', 'Client::update/$1');


$routes->get('/auth/registerClient', 'Client::create');
$routes->post('/client/store', 'Client::store');




// $routes->get('/testDbConnection', 'TestController::testDbConnection');



