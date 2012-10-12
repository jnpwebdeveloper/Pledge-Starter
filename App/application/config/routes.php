<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller']  = 'project';

$route['login'] = "users/login";

$route['paypal/process/(:any)'] = 'transaction/process/$1';

// Admin routes
$route['admin'] = "admin";
$route['admin/([a-zA-Z_-]+)/(:any)'] = "$1/admin/$2";
$route['admin/([a-zA-Z_-]+)'] = "$1/admin/index";

$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */