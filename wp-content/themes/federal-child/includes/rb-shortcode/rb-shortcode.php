<?php
include 'shortcodeUsage.php';
include 'rb-shortcode-config.php';

class RbShortcode 
{
	function __construct() 
    {		
		add_action( 'admin_init', array( &$this, 'action_admin_init' ) );
	}
	
	function findAndFillMapCodes(array &$node){
		global $rb_shorcodesUsage;
		foreach($node as $shKey => &$shValue){
			if(is_array($shValue))
				$this->findAndFillMapCodes($shValue);
			else{
				if(isset($rb_shorcodesUsage[$shValue])){
					$shValue = array('type'=>'rb-dialog', 'label'=>$rb_shorcodesUsage[$shValue]['label'], 'code' => $shValue);
				}
			}
		}	
	}
	
	function action_admin_init() 
    {
		global $rb_shortcodeMap;
		wp_enqueue_script( 'jquery.form-validator', $this->plugin_url().'tinymce/js/jquery.form-validator.min.js' );
		wp_enqueue_script( 'rb-dialog', $this->plugin_url().'tinymce/js/rb-dialog.js' );
		wp_enqueue_script( 'rb-colorpicker', $this->plugin_url().'/tinymce/js/colorpicker.js' );
		
		$this->findAndFillMapCodes($rb_shortcodeMap);
		
		$rb_globals = array(
			'theme_url' => get_template_directory_uri(),
			'plugins' => $this->plugin_url(),
			'shortcodeMap' => json_encode($rb_shortcodeMap)
			);

		wp_localize_script( 'jquery.form-validator', 'rb_globals', $rb_globals );
	
		if ( current_user_can( 'edit_posts' ) 
		  && current_user_can( 'edit_pages' ) 
		  && get_user_option('rich_editing') == 'true' )  {
		  	
			add_filter( 'mce_buttons',          array( &$this, 'filter_mce_buttons'          ) );
			add_filter( 'mce_external_plugins', array( &$this, 'filter_mce_external_plugins' ) );
			
			wp_register_style('rbShortcodeStyles', $this->plugin_url() . 'css/styles.css');
			wp_enqueue_style('rbShortcodeStyles');
			
			wp_register_style('rb-colorpicker', $this->plugin_url() . 'css/colorpicker.css');
			wp_enqueue_style('rb-colorpicker');
			
		}
	}	
	
	function filter_mce_buttons( $buttons ) 
    {		
		array_push( $buttons, '|', 'rbshortcode_button');
		return $buttons;
	}
	
	function filter_mce_external_plugins( $plugins ) 
    {
		global $tinymce_version;
		if(version_compare($tinymce_version[0], 4, ">="))
			$plugins['RbShortcode'] = $this->plugin_url() . 'tinymce/rb-shortcode.js';
		else
			$plugins['RbShortcode'] = $this->plugin_url() . 'tinymce/rb-shortcode-v3.js';
        
        return $plugins;
	}
	
	
	function plugin_url() 
    {
		global $RbShortcodePluginUrl;
		return $RbShortcodePluginUrl;
	}

}

new RbShortcode();
?>
