<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'login';

// Authentication Routes
$route['login'] = 'login';
$route['authenticate'] = 'login/authenticate';
$route['logout'] = 'login/logout';

$route['dashboard'] = 'dashboard';

// User Management Routes
$route['users'] = 'users';
$route['users/add'] = 'users/add';
$route['users/store'] = 'users/store';
$route['users/edit/(:num)'] = 'users/edit/$1';
$route['users/update/(:num)'] = 'users/update/$1';
$route['users/delete/(:num)'] = 'users/delete/$1';
$route['users/change-status'] = 'users/changeStatus';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;
