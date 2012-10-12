<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller']  = 'welcome';

$route['login'] = "users/login";

$route['paypal/process/(:any)'] = 'transaction/process/$1';

$route['yard/(:num)']            = "yards/view/$1";
$route['yard/(:num)/make_offer'] = "yards/make_offer";

// Admin routes
$route['admin'] = "admin";
$route['admin/([a-zA-Z_-]+)/(:any)'] = "$1/admin/$2";
$route['admin/([a-zA-Z_-]+)'] = "$1/admin/index";

// Dashboard routes
$route['dashboard'] = "users/dashboard";
$route['dashboard/(:any)'] = "users/dashboard/$1";

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */