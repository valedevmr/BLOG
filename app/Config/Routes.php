<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->post('/api/users', 'User::create');
$routes->post('/api/login', 'Login::auth');
//rutas para los blogs
$routes->get('/api/blog', 'Blog::index', ['filter' => 'authmiddleware']);
$routes->post('/api/blog', 'Blog::create', ['filter' => 'authmiddleware']);
$routes->put('/api/blog/(:segment)', 'Blog::update/$1', ['filter' => 'authmiddleware']);
$routes->delete('/api/blog/(:segment)', 'Blog::delete/$1', ['filter' => 'authmiddleware']);
$routes->get('/api/blog/(:segment)', 'Blog::show/$1', ['filter' => 'authmiddleware']);
