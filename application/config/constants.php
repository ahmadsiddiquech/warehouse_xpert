<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

// User Constants
////////////////// ADMIN ///////////////
if($_SERVER['HTTP_HOST'] == 'ds-pc' || $_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.100.13'){
	// ************** FOR LOCAL SERVER
	define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/');
	define('HTTPS_BASE_URL', 'https://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/');
	define('BASE_URL_NEWS_LISTING', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/front/');
	define('FOOTER_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/template/');
	define('IMAGE_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/uploads/');
	define('CAPTCHA_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/captcha/');
	define('ADMIN_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/admin/');
	define('STATIC_ADMIN_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/css/');
	define('STATIC_ADMIN_JS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/js/');
	define('STATIC_ADMIN_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/images/');
	///////////////////FRONT///////////////////////////////
	define('STATIC_FRONT_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/css/');
	define('STATIC_FRONT_JS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/js/');
	define('STATIC_FRONT_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/images/');
}
else{
	// ************** FOR LIVE SERVER
	define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/');
	define('HTTPS_BASE_URL', 'https://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/');
	define('BASE_URL_NEWS_LISTING', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/front/');
	define('FOOTER_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/template/');
	define('CAPTCHA_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/captcha/');
	define('IMAGE_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/uploads/');
	define('ADMIN_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/admin/');
	define('STATIC_ADMIN_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/css/');
	define('STATIC_ADMIN_JS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/js/');
	define('STATIC_ADMIN_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/admin/theme1/images/');
	define('STATIC_FRONT_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/css/');
	define('STATIC_FRONT_JS', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/js/');
	define('STATIC_FRONT_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/warehouse_xpert/static/front/warehouse_xpert/images/');
	define('STATIC_FRONT_NOTIFICATION', '../warehouse_xpert/static/front/warehouse_xpert/notification/');

	// define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
	// define('HTTPS_BASE_URL', 'https://'.$_SERVER['HTTP_HOST'].'/');
	// define('BASE_URL_NEWS_LISTING', 'http://'.$_SERVER['HTTP_HOST'].'/front/');
	// define('FOOTER_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/template/');
	// define('CAPTCHA_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/captcha/');
	// define('IMAGE_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/uploads/');
	// define('ADMIN_BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/admin/');
	// define('STATIC_ADMIN_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/static/admin/theme1/css/');
	// define('STATIC_ADMIN_JS', 'http://'.$_SERVER['HTTP_HOST'].'/static/admin/theme1/js/');
	// define('STATIC_ADMIN_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/static/admin/theme1/images/');
	// define('STATIC_FRONT_CSS', 'http://'.$_SERVER['HTTP_HOST'].'/static/front/warehouse_xpert/css/');
	// define('STATIC_FRONT_JS', 'http://'.$_SERVER['HTTP_HOST'].'/static/front/warehouse_xpert/js/');
	// define('STATIC_FRONT_IMAGE', 'http://'.$_SERVER['HTTP_HOST'].'/static/front/warehouse_xpert/images/');
}

define('ACTUAL_ADDwarehouseT_IMAGE_PATH', 'uploads/add_warehouset/actual_images/');
define('LARGE_ADDwarehouseT_IMAGE_PATH', 'uploads/add_warehouset/large_images/');
define('MEDIUM_ADDwarehouseT_IMAGE_PATH', 'http://localhost/warehouse_xpert/uploads/add_warehouset/medium_images/');
define('SMALL_ADDwarehouseT_IMAGE_PATH', 'uploads/add_warehouset/small_images/');

define('ACTUAL_ANNOUNCEMENT_IMAGE_PATH', 'uploads/announcement/actual_images/');
define('LARGE_ANNOUNCEMENT_IMAGE_PATH', 'uploads/announcement/large_images/');
define('MEDIUM_ANNOUNCEMENT_IMAGE_PATH', 'uploads/announcement/medium_images/');
define('SMALL_ANNOUNCEMENT_IMAGE_PATH', 'uploads/announcement/small_images/');


define('DATA_SAVED', 'saved successfully');
define('DATA_UPDATED', 'updated successfully');

//****Form Validations****//
define('TEXT_BOX_RANGE',5000);
define('TEXT_AREA_RANGE',255);
//****Form Validations****//
define('RADIO_BUTTON',1);
define('CHECK_BOX',2);
define('DROPDOWN',3);
//define('MULTI_DROPDOWN',4);
define('TEXTBOX',5);
define('NUMBER_BOX',6);
define('DATE_BOX',7);
define('YEAR_BOX',8);
define('CURRENCY_BOX',9);
define('MILEAGE_BOX',10);
define('CC_BOX',11);
////////////////// Pagination constants ///////////////
define('PRE_warehouseT',0);
define('FREE_warehouseT',1);
define('PAID_warehouseT',2);
define('EXPIRED_warehouseT',3);
define('REJECTED_warehouseT',4);

define('UN_PUBLISHED',0);
define('PUBLISHED',1);

define('LIMIT',5);
define('NUM_LINKS',3);
define('OUTLET',$_SERVER['HTTP_HOST']);


/******************************/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */

/* Location: ./application/config/constants.php */
?>