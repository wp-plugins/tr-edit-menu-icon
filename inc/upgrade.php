<?php

if(!class_exists('TR_Upgrade_plugin')):

class TR_Upgrade_plugin
{
    var $dir,$dirname,$plugin;
    var $checkurl = 'http://ngoctrinh.net/version/check.php?';
    
    function TR_Upgrade_plugin($dir)
    {
        $this->dir = $dir;
        
        add_action('admin_init',array(&$this,'setup'));
        
        // Make sure plugin update is handled
        add_filter('site_transient_update_plugins', array(&$this,'set_plugin_update'));
        add_filter('pre_site_transient_update_plugins', array(&$this,'site_transient_update_plugins'),99);

        if(!@session_id())@session_start();
    }
    
    function setup()
    {
        $this->dirname  = plugin_basename($this->dir);
        $plugins        = get_plugins( '/' . $this->dirname );
        foreach($plugins as $file => $plugin)
        {
            $plugin['file'] = $file;
            $this->plugin = $plugin;
        }
        if(isset($_GET['checkupdate']))
        {
            $this->checkupdate();
        }
        add_action('trlp_cron_daily',array(&$this,'checkupdate'));
    }
    
    function checkupdate()
    {
        $url = $this->checkurl.'plugin='.$this->dirname.'&url='.get_bloginfo('url').'&version='.$this->plugin['Version'];
        $request = new WP_Http;
        $return  = $request->request($url, array('timeout' => 20));
        if(!is_wp_error($return))
        {
            $return  = @unserialize($return['body']);
            update_option($this->dirname.'_info',$return);
        }
        
        $_SESSION[$this->dirname.'_check_version'] = true;
    }
    
    function set_plugin_update($current)
    {
        if(empty($this->dirname))
        {
            $this->setup();
        }
        if(!$_SESSION[$this->dirname.'_check_version'])
        {
            $this->checkupdate();
        }
        $pr_data = get_option($this->dirname.'_info',array());
        // Check if the plugin needs to be updated
        $plugin_file = $this->dirname . '/' . $this->plugin['file'];

        if(version_compare(@$pr_data['latest_plugin_version'] , @$this->plugin['Version'],'>'))
        {
            // It does need to be updated
            $update_array = new stdClass();
            
            $update_array->id          = '0';
            $update_array->slug        = $this->dirname;
            $update_array->new_version = $pr_data['latest_plugin_version'];
            $update_array->url         = $pr_data['url'];
            $update_array->package     = $pr_data['package'];    
            $current->response[$plugin_file] = $update_array;
        }else{
            unset($current->response[$plugin_file]);
        }
        return $current;
    }
    
    function site_transient_update_plugins($current)
    {
        if($current !=false)
        {
            return $this->set_plugin_update($current);
        }
        return $current;
    }
    
}

endif;

//main
new TR_Upgrade_plugin(dirname(dirname(__FILE__)));

