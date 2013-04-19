<?php
add_filter('walker_nav_menu_start_el','tr_walker_nav_menu_start_el',11,4);
function tr_walker_nav_menu_start_el($item_output, $item, $depth, $args)
{
    $item_id = $item->ID;    
    $menuicon = get_post_meta($item_id ,'_trmenuicon',true);
    if(!empty($menuicon))
    {
        $item_output='<span class="menu-icon"><img src="'.$menuicon.'" class="iconmenu"/></span>'.$item_output;
    }
    return $item_output;
}