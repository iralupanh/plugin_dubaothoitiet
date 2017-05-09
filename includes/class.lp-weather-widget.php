<?php 
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
//function lp_weather(){
    //register_widget('LP_Weather_Widget');
//}
//add_action('widgets_init','lp_weather');
class LP_Weather_Widget extends WP_Widget{
    //khoi tao widget
    public function __construct(){
       parent:: __construct(
           'lp-weather-widget',
           __('LP_WEATHER','lp_weather'),
           array('description'=>__('weather all city on the world','lp_weather'))
           );
        add_action('widgets_init', function(){
            register_widget('LP_Weather_Widget');
        });
        
        add_action('wp_enqueue_scripts',function(){
            wp_register_style('lp-css', LP_WEATHER_PLUGIN_URL.'scripts/css/style.css');
            wp_enqueue_style('lp-css');
            wp_register_script('lp-js',LP_WEATHER_PLUGIN_URL.'scripts/js/functions.js',['jquery']);
            wp_localize_script('lp-js','tp',['url'=>admin_url('admin-ajax.php')]);
            wp_enqueue_script('lp-js');
        });
       
    }
    
    //nhap lieu cho widget
    public function form($instance){
        $title = (isset($instance['title']) && !empty($instance['title'])) ? apply_filters('widget_title',$instance['title']) : __('LP Widget Title','lp_weather');
        $unit = (isset($instance['unit']) && !empty($instance['unit'])) ? $instance['unit'] : 'celsius';
        require(LP_WEATHER_PLUGIN_DIR.'views/lp-weather-widget-form.php');
    }
    //cap nhat dulieu cho widget
    public function update($new_instance, $old_instance){
        $instance = [];
        $instance['title'] = (isset($new_instance['title']) && !empty($new_instance['title'])) ? apply_filters('widget_title',$new_instance['title']) : __('LP Widget Title','lp_weather');
        $instance['unit'] = (isset($new_instance['unit']) && !empty($new_instance['unit'])) ? $new_instance['unit'] : 'celsius' ;
        return $instance;
    }
    //hien thi ra ben ngoai trinh duyet
    public function widget($args, $instance){
        $title = (isset($instance['title']) && !empty($instance['title'])) ? apply_filters('widget_title',$instance['title']) : __('LP Widget Title','lp_weather');
        if(get_option('lp_weather_setting')){
            $city_name = get_option('lp_weather_setting')['city_name'];
        }else {
            $city_name = 'Ho+Chi+Minh';
        }
        $widget_option = $instance;
        $data = LP_Weather_API :: get_weather($city_name);
        require(LP_WEATHER_PLUGIN_DIR.'views/lp-weather-widget-view.php');
    }
}