<?php
add_action('admin_init','trmi_action_admin_init');
function trmi_action_admin_init()
{
    if(isset($_REQUEST['tr_act']))
    {
        include(dirname(__FILE__).'/admin_ajax.php');
    }
}
add_filter('wp_edit_nav_menu_walker','tr_wp_edit_nav_menu_walker',11,2);
function tr_wp_edit_nav_menu_walker($class,$menu_id)
{
    $class = 'TR_Walker_Nav_Menu_Edit';
    wp_enqueue_script('menuiconadmin',TREMI_URL.'js/admin.js');
    wp_enqueue_style('menuiconadmin',TREMI_URL.'css/style.css');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
    return $class;
}

add_action('wp_update_nav_menu_item','tr_wp_update_nav_menu_item',11,3);
function tr_wp_update_nav_menu_item($menu_id, $menu_item_db_id, $args)
{
    update_post_meta( $menu_item_db_id, '_trmenuicon', $_POST['menu-item-icon'][$menu_item_db_id] );
}