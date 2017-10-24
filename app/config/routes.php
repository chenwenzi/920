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
$route['default_controller'] = 'home';
$route['translate_uri_dashes'] = FALSE;

$route['404_override'] = '';

$route['c/(\d+)']  = "home/category/$1";

$route['p'] = "home/article"; //作品列表页
$route['p/(:num)'] = "home/article/$1"; //作品详情页

$route['u'] = "home/profile"; //个人列表页
$route['u/p'] = "home/profile/0/1"; //个人列表页 第一页
$route['u/p/(:num)'] = "home/profile/0/$1"; //个人列表页 分页
$route['u/(:num)'] = "home/profile/$1"; //个人档详情页

$route['s'] = "home/school"; //学校列表页
$route['s/p'] = "home/school/0/1"; //学校列表页 第一页
$route['s/p/(:num)'] = "home/school/0/$1"; //学校列表页 分页
$route['s/(:num)'] = "home/school/$1"; //学校档详情页

$route['v'] = "home/like";
$route['v/(:num)'] = "home/like/$1";
$route['z'] = "home/likeu";
$route['z/(:num)'] = "home/likeu/$1";


