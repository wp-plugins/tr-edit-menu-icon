<?php
if(!session_id())@session_start();

spl_autoload_register('_tremi_autoloader');

function _tremi_autoloader($classname) {
   if(class_exists($classname))return;
   $class_dir = TREMI_PATH.'lib/';
    $filenames = array();
    $filenames[] = strtolower($classname);
    $filenames[] = $classname;
    $filenames[] = str_replace('_','/',$classname);

    foreach($filenames as $fn)
    {
        $full_path = $class_dir.$fn . '.php';

        if(is_file($full_path))
        {
            include_once $full_path;
            break;
        }
    }
} 