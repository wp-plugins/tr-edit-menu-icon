<?php
/*
Plugin Name: Tr Edit Menu Icon
Plugin URI: http://ngoctrinh.net/
Description: Edit Menu Icon
Version: 1.0.3
Author: Trinh
Author URI: http://ngoctrinh.net/
License: GPL2
*/
define('TREMI_URL', plugins_url('/',__FILE__));
define('TREMI_PATH',plugin_dir_path(__FILE__).'/');


include_once(TREMI_PATH.'inc/init.php');
//install admin 
if(is_admin())
{      
    include_once(TREMI_PATH.'inc/admin.php'); 
}else
{
    include_once(TREMI_PATH.'inc/front.php');  
}


