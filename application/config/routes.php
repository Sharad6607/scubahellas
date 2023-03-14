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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Dashboarad';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Admin and subadmin routes

$route['admin'] 	= 'admin/login';
$route['admin/login'] 	= 'admin/login';
$route['admin/profile'] 	= 'admin/admin/profile';
/*sub admin route*/
$route['admin/manage-subadmin'] 	= 'admin/subadmin/index';
$route['admin/manage-subadmin/(:num)'] 	= 'admin/subadmin/edit_subadmin';
$route['admin/manage-subadmin/add'] 	= 'admin/subadmin/add_subadmin';
$route['admin/manage-subadmin/delete/(:num)'] 	= 'admin/subadmin/delete_subadmin';
/*dives location route*/
$route['admin/manage-dives'] 	= 'admin/dives/index';
$route['admin/manage-dives/(:num)'] 	= 'admin/dives/edit_dives';
$route['admin/manage-dives/add'] 	= 'admin/dives/add_dives';
$route['admin/manage-dives/delete/(:num)'] 	= 'admin/dives/delete_dives';
/*vendors Route*/
$route['admin/vendors'] 	= 'admin/vendors/index';
$route['admin/vendors/(:num)'] 	= 'admin/vendors/edit_vendor';
$route['admin/vendors/add'] 	= 'admin/vendors/add_vendor';
$route['admin/vendors/delete/(:num)'] 	= 'admin/vendors/delete_vendor';

$route['admin/customers'] 	= 'admin/customers/index';
$route['admin/customers/(:num)'] 	= 'admin/customers/edit_customer';
$route['admin/customers/add'] 	= 'admin/customers/add_customer';
$route['admin/customers/delete/(:num)'] 	= 'admin/customers/delete_customer';

/* Booking Route */

$route['admin/manage-booking'] = 'admin/booking/index';

/*vendors dashbaorad login panel route*/


$route['vendor'] 	= 'vendor/login';
$route['vendor/login'] 	= 'vendor/login';
$route['vendor/profile'] 	= 'vendor/vendor/profile';

$route['vendor/manage-dives'] 	= 'vendor/dives/index';
$route['vendor/manage-dives/(:num)'] 	= 'vendor/dives/edit_dives';
$route['vendor/manage-dives/add'] 	= 'vendor/dives/add_dives';
$route['vendor/manage-dives/delete/(:num)'] 	= 'vendor/dives/delete_dives';

$route['admin/manage-dives-category'] 	= 'admin/dives_category/index';
$route['admin/manage-dives-category/(:num)'] 	= 'admin/dives_category/edit_dives';
$route['admin/manage-dives-category/add'] 	= 'admin/dives_category/add_dives';
$route['admin/manage-dives-category/delete/(:num)'] 	= 'admin/dives_category/delete_dives';


$route['admin/rental-products'] 	= 'admin/rental_products/index';
$route['admin/rental-products/(:num)'] 	= 'admin/rental_products/edit_products';
$route['admin/rental-products/add'] 	= 'admin/rental_products/add_products';
$route['admin/rental-products/delete/(:num)'] 	= 'admin/rental_products/delete_products';

$route['vendor/rental-products'] 	= 'vendor/rental_products/index';
$route['vendor/rental-products/(:num)'] 	= 'vendor/rental_products/edit_products';
$route['vendor/rental-products/add'] 	= 'vendor/rental_products/add_products';
$route['vendor/rental-products/delete/(:num)'] 	= 'vendor/rental_products/delete_products';

/* Blog Module Route */

$route['admin/manage-blog'] 	= 'admin/blog/index';
$route['admin/manage-blog/(:num)'] 	= 'admin/blog/edit_blog';
$route['admin/manage-blog/add'] 	= 'admin/blog/add_blog';
$route['admin/manage-blog/delete/(:num)'] 	= 'admin/blog/delete_blog';

$route['admin/manage-blog-category'] 	= 'admin/blog_category/index';
$route['admin/manage-blog/add'] 	= 'admin/blog_category/add_blog';

$route['admin/payment-history'] 	= 'admin/payment_history/index';