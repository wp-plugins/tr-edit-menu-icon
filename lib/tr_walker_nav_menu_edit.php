<?php
class TR_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
    
    var $list_custom;
    
    function TR_Walker_Nav_Menu_Edit()
    {
        $this->list_custom = apply_filters('list_menu_icons',array());
        
    }
    
	function start_el(&$output, $item, $depth, $args) {
	   $return = '';
	   parent::start_el($return,$item,$depth,$args);
       $item_id = $item->ID;
       $menuicon = get_post_meta($item_id ,'_trmenuicon',true);
       
       ob_start();
       ?>
       <div class="custom_icon">
        <p class="description">
            <label>Icon</label>
            <img src="<?php echo $menuicon?>" id="trmenuicon_<?php echo $item_id?>" style="max-width: 50px;max-height:50px;" />
            <a class=" button uploadbutton" rel="<?php echo $item_id?>" href="media-upload.php?type=image&amp;post_id=<?php echo $post->ID ?>&amp;TB_iframe=true&amp;width=640&amp;height=376">Upload</a>
            <?php if(count($this->list_custom)> 0):?>
            <a class="thickbox button" rel="<?php echo $item_id?>" href="admin.php?tr_act=get_list_custom_icons&id=<?php echo $item_id?>">Select</a>
            <?php endif;?>
            <a class="button removeimageicon" rel="<?php echo $item_id?>">Remove</a>
            <input type="hidden" name="menu-item-icon[<?php echo $item_id; ?>]" id="trmenuiconvl_<?php echo $item_id?>" value="<?php echo $menuicon?>" />
       </p>
       </div>
       <?php
       $replace = ob_get_clean();
       $search = '<div class="menu-item-actions';
       $output.= str_replace($search,$replace.$search,$return);
       
	}
}
