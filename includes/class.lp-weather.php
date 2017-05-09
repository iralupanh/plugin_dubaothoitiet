<?php
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
class LP_Weather {
    //khoi tao class
    public  function __construct(){
     $lp_weather_widget = new LP_Weather_Widget;
     $lp_weather_setting = new LP_Weather_Setting;
    }
    public function activation_hook (){
        
    }
    public function deactivation_hook(){
        
    }
}