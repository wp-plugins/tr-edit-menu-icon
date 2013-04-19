<?php

$action = $_REQUEST['tr_act'];
if(function_exists('trmi_admin_ajax_'.$action))
{
    call_user_func('trmi_admin_ajax_'.$action);
}

function trmi_admin_ajax_get_list_custom_icons()
{
    $id = $_REQUEST['id'];
    $list_custom = apply_filters('list_menu_icons',array());
    ?>
    <div><h2>Select Icons</h2></div>
    <div class="list_icons" >
    
    <?php foreach($list_custom as $icon):?>
        <a class="add_select_icon" rel="<?php echo $id?>"><img src="<?php echo $icon?>" /></a>
    <?php endforeach;?>
    </div>
    <?php
    exit;
}