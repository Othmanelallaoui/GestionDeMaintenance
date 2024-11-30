<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->get('auth/login', 'Auth::login');

$routes->post('/auth/loginProcess', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/client/dashboard', 'Client::index');

$routes->get('/technicien/dashboard', 'Technicien::index');

//admin routes
$routes->get('/admin/dashboard', 'Admin::index');
$routes->get('/admin/gestion_technicien', 'Admin::gestion_technicien');
$routes->get('/admin/gestion_clients', 'Admin::gestion_clients');
$routes->get('/admin/gestion_demandes', 'Admin::gestion_Demandes');
$routes->get('/admin/archive_demandes', 'Admin::archive_Demandes');



$routes->get('admin/ajouter_technicien', 'Admin::ajouter_technicien');
$routes->post('admin/store_technicien', 'Admin::store_technicien');
$routes->post('admin/gestion_technicien', 'Admin::gestion_technicien');
$routes->post('/admin/gestion_clients', 'Admin::gestion_clients');
$routes->get('/admin/reset_password/(:num)', 'Admin::reset_password/$1');
$routes->get('/profil', 'Auth::profil');
$routes->get('/admin/profil', 'Admin::profil');
$routes->get('/admin/assigner_taches_technicien','Admin::assigner_taches');
$routes->post('/admin/assigner_tache','Admin::assigner_tache');




$routes->get('/technicien/edit/(:num)', 'Technicien::edit/$1');
$routes->get('/technicien/delete/(:num)', 'Technicien::delete/$1');
$routes->post('/technicien/update/(:num)', 'Technicien::update/$1');
$routes->post('/technicien/modifier-disponibilite', 'Technicien::modifierDisponibilite');


$routes->get('/technicien/mes_taches', 'Technicien::mes_taches');
$routes->post('/technicien/terminer_tache/(:num)', 'Technicien::terminer_tache/$1');
$routes->get('/technicien/mes_taches_terminees', 'Technicien::mes_taches_terminées');






$routes->get('/client/edit/(:num)', 'Client::edit/$1');
$routes->get('/client/delete/(:num)', 'Client::delete/$1');
$routes->post('/client/update/(:num)', 'Client::update/$1');
$routes->get('/client/createOrder', 'Client::createOrder');
$routes->get('/client/contact', 'Client::contact');
$routes->post('/client/contactSend', 'Client::contactSend');

$routes->post('/client/storeOrder', 'Client::store_order');
$routes->post('/client/annulerDemande/(:num)', 'Client::annulerDemande/$1');

$routes->get('/client/mesDemandes', 'Client::mesDemandes');
$routes->get('/client/profil', 'Client::profil');
$routes->post('/client/updateProfil', 'Client::updateProfil');






$routes->get('/auth/registerClient', 'Client::create');
$routes->post('/client/store', 'Client::store');




// $routes->get('/testDbConnection', 'TestController::testDbConnection');
