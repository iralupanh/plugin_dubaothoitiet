<p>
    <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Widget Title','lp_weather'); ?></label>
    <input type="text" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value= "<?php echo esc_attr($title);?>" class= "widefat"/>
</p>
<p>
    <label for="<?php echo $this->get_field_id('unit')?>"><?php _e('Unit','lp_weather');?></label>
    <select class= "widefat" id="<?php echo $this->get_field_id('unit')?>" name= "<?php echo $this->get_field_name('unit');?>">
        <option value="fahrenheit" <?php echo ($unit == 'fahrenheit') ? 'selected=selected': '' ;?>>fahrenheit</option>
        <option value="celsius" <?php echo ($unit == 'celsius') ? 'selected=selected' : '' ; ?>>celsius</option>
    </select>
</p>