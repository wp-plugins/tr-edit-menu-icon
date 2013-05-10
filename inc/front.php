<?php
add_filter('walker_nav_menu_start_el','tr_walker_nav_menu_start_el',11,4);
function tr_walker_nav_menu_start_el($item_output, $item, $depth, $args)
{
    $item_id = $item->ID;    
    $menuicon = get_post_meta($item_id ,'_trmenuicon',true);
    if(!empty($menuicon))
    {
        $icon='<span class="menu-icon"><img src="'.$menuicon.'" class="iconmenu" alt=""/></span>';
        $item_output = preg_replace("/(\<a[^\>]*\>)/","$1{$icon}",$item_output);
    }
    return $item_output;
}