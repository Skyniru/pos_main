<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Home::register');
$routes->post('/register/verify', 'Home::verifyRegister');
$routes->get('/dashboard', 'Dashboard::index');

// To set a route use this naming scheme;
//$routes->get('/name_of_function/sub_function', 'Name_of_controller::Name_of_Function');
//Ex:
//$routes->post('/register/verify', 'Home::verifyRegister');
//$routes->get('/name_of_function', 'Name_of_controller::Name_of_Function');
//Ex:
//$routes->get('/sample', 'Home::sample');


$routes->get('/sample', 'Home::sample');


// Login routes
$routes->post('/login', 'Home::login');
$routes->post('/login/verify', 'Home::verifyLogin');
$routes->get('/inventory', 'Inventory::index', ['filter' => 'auth']);


