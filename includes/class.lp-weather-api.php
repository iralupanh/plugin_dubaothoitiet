<?php 
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class LP_Weather_API {
    //lay chuoi json
    public static function get_JSON($json){
        return json_decode($json, true);
    }//end function get_JSON
    
    //gui request toi website
    public static function request($city= 'HaNoi', $like = true, $mode = 'json'){
        $type = ($like) ? 'like' : 'accurate';
        $city = urlencode(trim($city));
        $url = "http://api.openweathermap.org/data/2.5/find?q={$city}&type={$type}&mode={$mode}&appid=83fe83388b6bff796a1402b330e5e4cc";
        @$fget =file_get_contents($url);// lay du lieu tu bien url
        if($fget){
            return self::get_JSON($fget);
        }
        return false;
    }//end function request
    
    //lay du lieu tu trang web https://openweathermap.org
    public static function get_weather($data=[],   $mode = 'json'){
        $old_data   = get_transient('lp_weather_data');
        if(!$old_data && $data)//neu data ko rong va co gia tri
        {
            foreach($data as $city_name){
                $url = "http://api.openweathermap.org/data/2.5/weather?q={$city_name}&units=metric&mode={$mode}&appid=83fe83388b6bff796a1402b330e5e4cc";
                $fget = file_get_contents($url);
                if($fget){
                    $return[] = self :: get_JSON($fget);
                }
            }
            if($return){
                set_transient('lp_weather_data',$return, 10800);
                return $return;
            }
        }else {
            foreach($old_data as $key => $value){
                if(empty($value)){
                    unset($old_data[$key]);
                }
            }
            if($old_data){
                $old_data = array_values($old_data);
                return $old_data;
            }
        }
        return false;
    }// End function get_weather
    
    public static function get_temperature($temp = 0, $option ='celcius'){
        switch($option){
            case 'celsius' :
                return $temp.' &#x2218;C';
                break;
            case 'fahrenheit':
                return ($temp * 9 / 5 + 32).'F';
                break;
        }
    }//END function get_temperature
    
    public static function get_weather_icon($code='01d'){
        return "http://openweathermap.org/img/w/{$code}.png";
    }//End fuction get_weather_icon
    
}