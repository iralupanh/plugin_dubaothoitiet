<?php
/*
Plugin Name: LP_Weather 
Description: Plugin du bao thoi tiet
Version: 1.0.0
Author: lupanh nguyen
Plugin URI: https://hocweb-iralupanh.c9users.io
Author URI: https://hocweb-iralupanh.c9users.io
Text Domain: lp_weather
*/
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
define('LP_WEATHER_VERSION','1.0.0');//Version cua plugin
define('LP_WEATHER_MINIMUM_VERSION','4.1.1');//version cua wordpress co the chay duoc plugin
define('LP_WEATHER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('LP_WEATHER_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once(LP_WEATHER_PLUGIN_DIR . 'includes/class.lp-weather-setting.php');
require_once(LP_WEATHER_PLUGIN_DIR . 'includes/class.lp-weather-widget.php');
require_once(LP_WEATHER_PLUGIN_DIR . 'includes/class.lp-weather-api.php');
require_once(LP_WEATHER_PLUGIN_DIR . 'includes/class.lp-weather.php');


$lp_weather = new LP_Weather;

