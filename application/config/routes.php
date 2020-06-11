<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'UserAuthenticationControl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom url
// Login
$route['forgot-password'] = 'UserAuthenticationControl/forgotpassword';
$route['/'] = 'UserAuthenticationControl/index';
$route['logout'] = 'UserAuthenticationControl/logout';

$route['check-password'] = 'UserAuthenticationControl/check_password';
$route['update-password'] = 'UserAuthenticationControl/update_password';



// India outlet url routing
$route['india'] = 'IndiaControl/index';
$route['india/invoice'] = 'IndiaControl/invoice';
$route['india/sent-invoice'] = 'IndiaControl/sent_invoice';
$route['india/add-invoice'] = 'IndiaControl/addinvoice';
$route['india/edit-invoice'] = 'IndiaControl/editinvoce';
$route['india/upload-multiple-invoce'] = 'IndiaControl/uploadmultipleinvoce';
$route['submit-invoice'] = 'IndiaControl/postinvoice';
$route['invoice-format'] = 'sample_file/invoceUploadformat.csv';
$route['india/setting'] = 'IndiaControl/change_password';

// London outlet url routing
$route['london'] = 'londonControl/index';
$route['london/add-invoice'] = 'londonControl/add_invoice';
$route['london/stock-invoice'] = 'londonControl/stock_invoice';
$route['london/upload-invoice'] = 'londonControl/upload_invoice';
$route['london/update-stock-invoice'] = 'londonControl/update_stock_invoice';
$route['london/update-stock'] = 'londonControl/update_stock';
$route['london/update-invoice'] = 'londonControl/update_invoice';
$route['london/setting'] = 'londonControl/change_password';

// Manager url routing 
$route['manager'] = 'managerControl/index';
$route['manager/product-list'] = 'managerControl/product_list';
$route['manager/pending-invoice'] = 'managerControl/pending_invoice';
$route['manager/ageing-stock'] = 'managerControl/ageing_stock';
$route['manager/reconciliation-report'] = 'managerControl/reconciliation_report';
$route['manager/setting'] = 'managerControl/change_password';

// Admin url routing
$route['admin'] = 'adminControl/index';
$route['admin/users'] = 'adminControl/users_list';
$route['admin/edit-user/(:any)'] = 'adminControl/edit_users/$1';
$route['admin/add-user'] = 'adminControl/add_users';
$route['admin/get-state'] = 'adminControl/get_state';
$route['admin/get-cities'] = 'adminControl/get_city';
$route['admin/setting'] = 'adminControl/setting';





