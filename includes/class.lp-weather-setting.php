<?php 
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class LP_Weather_Setting {
    protected $options;
    protected $option_group = 'lp_weather_group';
    
    public function __construct(){
        $this->option = get_option('lp_weather_setting  ');
        //add menu
        add_action('admin_menu', function(){
            add_submenu_page(
                'options-general.php', // ten slug cua menu trang
                'LP Weather Setting', // ten cua trang hien thi
                'LP Setting', // ten cua menu
                'manage_options',// quyen de su dung duoc menu
                'lp_weather',
                [$this,'create_page']// ten phuong thuc can phai tao
                );
        });
        
        add_action('admin_init',[$this,'register_setting']);
        add_action('admin_enqueue_scripts',function(){
            wp_register_script('lp-js',LP_WEATHER_PLUGIN_URL.'scripts/js/functions.js',['jquery']);
            wp_localize_script('lp-js','tp',['url'=>admin_url('admin-ajax.php')]);
            wp_enqueue_script('lp-js');
        });
        add_action('wp_ajax_search_city_ajax',[$this,'search_city_ajax']);
    }
    
    public function create_page(){
        $option_group = $this->option_group;
         require(LP_WEATHER_PLUGIN_DIR.'views/lp-weather-setting.php');
    }
    
    public function register_setting(){
        register_setting(
            $this->option_group ,
            'lp_weather_setting',// ten cua setting de luu vao  csdl
            [$this,'save_setting'] // ten phuong thuc can tao de lam viec luu dl 
            );
    }
    
    public function save_setting($input){
        $new_input = [];
        if(isset($input['city_name']) && !empty($input['city_name'])){
            foreach($input['city_name'] as  $value){
                $new_input['city_name'][] =preg_replace('/[ ]/u','+',trim($value));
            }
        }else{
            $new_input['city_name'][] = 'Ho+Chi+Minh';
        }
        return $new_input;
    }
    
    public function search_city_ajax (){
        if(isset($_POST['city']) && !empty($_POST['city'])){
            $data = LP_Weather_API :: request($_POST['city']);
            wp_send_json_success($data);
        }
    }
    
}