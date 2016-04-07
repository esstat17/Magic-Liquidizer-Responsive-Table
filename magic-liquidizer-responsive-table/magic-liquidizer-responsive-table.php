<?php
defined( 'ABSPATH' ) OR exit;
/*
Plugin Name: Magic Liquidizer Responsive Table
Plugin URI: http://www.innovedesigns.com/wordpress/magic-liquidizer-responsive-table-rwd-you-must-have-wp-plugin/
Author: Elvin Deza
Description: A simple and lightweight plugin that makes HTML &lt;table&gt; tag become responsive. After activation, go to Dashboard > Magic Liquidizer Lite > Table.
Version: 1.0.6
Tags: responsive, table, fluid, mobile screens
Author URI: http://innovedesigns.com/author/esstat17

/--------------------------------------------------------------------\
|                                                                    |
| License: GLP Version 3                                             |
|                                                                    |
| Magic Liquidizer Responsive Table - Make HTML Table Responsive.    |
| Copyright (C) 2014, Elvin Deza,                                    |
| http://innovedesigns.com/                                          |
| All rights reserved.                                               |
|                                                                    |
| By using the software, you agree to be bound by the terms of		 | 		
| this license.														 |
| 																	 |
|                                                                    |
\--------------------------------------------------------------------/
*/

// protect yourself
if ( !function_exists( 'add_action') ) {
	echo "Function add_action doesn't exist";
	exit;
}

if (!class_exists('magic_liquidizer_wp_class_lite')) { // avoiding class duplication

class magic_liquidizer_wp_class_lite {
	// when object is created
	function __construct() {
		add_action('admin_menu', array($this, 'magic_liquidizer_menu_lite')); // add item to menu
		// add_action( 'admin_enqueue_scripts', array( $this, 'ml_enqueue_color_picker' ), 3 );
		
		add_action('wp_enqueue_scripts', array($this, 'magic_liquidizer_lite_scripts')); // add plugin to site
		/* wp_head can hook here */
		// add_action( 'wp_head', array( $this, 'iheadhook' ), 1 );
		// add_action( 'headfnhooks', array( $this, 'iviewport' ), 1 );
	}
	function magic_liquidizer_menu_lite() {
		add_menu_page('Magic Liquidizer Lite', 'Magic Liquidizer Lite', 'manage_options', 'magic-liquidizer-page-lite', array($this, 'ml_settings_fn_lite'),'' );
		add_submenu_page('magic-liquidizer-page-lite', 'Setup Magic Liquidizer', 'Setup Wizard', 'manage_options', 'magic-liquidizer-page-lite', array($this, 'ml_settings_fn_lite'),29 );
		add_submenu_page('magic-liquidizer-page-lite', 'About Magic Liquidizer and More', 'About', 'manage_options', 'magic-liquidizer-about', array($this, 'magic_liquidizer_about'),30 );
	}

	function ml_settings_fn_lite(){

		echo '<div id="ml-lite" class="wrap ml-lite">
		<h2 class="title">Magic Liquidizer Lite for Wordpress</h2>
		Easily Converts Your Non-Responsive Theme to Become Flawlessly Responsive.
		';
	if(isset($_POST['submit']) && check_admin_referer('liquidizer_lite_action','liquidizer_lite_ref') ) {
	
		$liquidizer_lite_options = array(
		
		/* Database submission query for all Magic liquidizer plugins (It must consist all) */
			/* Responsive Form */
			'liquidizer_lite_wp_which_form_element' => esc_js(trim($_POST['liquidizer_lite_wp_which_form_element'])),
			'liquidizer_lite_wp_form_width' => esc_js(trim($_POST['liquidizer_lite_wp_form_width'])),
			'liquidizer_lite_wp_form' => isset($_POST['liquidizer_lite_wp_form']),
			
			/* Navigation Bar */
			'liquidizer_lite_wp_which_navigationbar_element' => esc_js(trim($_POST['liquidizer_lite_wp_which_navigationbar_element'])),
			'liquidizer_lite_wp_navigationbar_width' => esc_js(trim($_POST['liquidizer_lite_wp_navigationbar_width'])),
			'liquidizer_lite_wp_navigationbar' => isset($_POST['liquidizer_lite_wp_navigationbar']),			
			'liquidizer_lite_wp_navcolor' => esc_js(trim($_POST['liquidizer_lite_wp_navcolor'])),
			'liquidizer_lite_wp_navselect' => esc_js(trim($_POST['liquidizer_lite_wp_navselect'])),
			'liquidizer_lite_wp_home' => esc_url(trim($_POST['liquidizer_lite_wp_home'])),
			'liquidizer_lite_wp_info' => esc_url(trim($_POST['liquidizer_lite_wp_info'])),
			'liquidizer_lite_wp_contact' => esc_url(trim($_POST['liquidizer_lite_wp_contact'])),			
			
			/* Responsive Table */
			'liquidizer_lite_wp_which_table_element' => esc_js(trim($_POST['liquidizer_lite_wp_which_table_element'])),
			'liquidizer_lite_wp_table_width' => esc_js(trim($_POST['liquidizer_lite_wp_table_width'])),
			'liquidizer_lite_wp_table' => isset($_POST['liquidizer_lite_wp_table'])
				
		);
	
	/* Handling variable array */	
		foreach($liquidizer_lite_options as $x=>$x_value) {
			if ( get_option( $x ) !== false ) {
				update_option($x, $x_value);
			} else {			
				add_option( $x, $x_value, '', 'yes' );
			}
		}
	   		
	   
	} // end of &_Post
		
	echo '<form method="post" action="'. esc_attr($_SERVER["REQUEST_URI"]) .'">';
		
			wp_nonce_field('liquidizer_lite_action','liquidizer_lite_ref');
	
	echo '<table class="form-table" style="color: #bbb;">
      
	    <tbody>
	    <tr>
		  <td>';
		  		  	  
	do_action( 'ml_hook_body');
	do_action( 'ml_hook_footer');   
	   
	echo '';
	} // ml_settings_fn_lite() ends
	
	// Submenu
	function magic_liquidizer_about(){
		echo ' <div id="liquidizer-wp-about" class="wrap">
	    
	    <h2 class="title">About Magic Liquidizer</h2>Instruction. FAQ. Supports. and more..<br />
	    
	    <ul class="about-list">
	    	<li><a href="http://www.innovedesigns.com/" target="_blank">Plugin Home</a></li>
	    	<li><a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank">Plugin Page</a></li>
	    	<li><a href="http://www.innovedesigns.com/responsive/magic-liquidizer/faq/" target="_blank">FAQ</a></li>
	    	<li><a href="http://demo.innovedesigns.com/wordpress/" target="_blank">Demo</a></li>
	    	<li><a href="http://www.innovedesigns.com/contact/" target="_blank">Contact Us</a></li>	    	
	    </ul>
	    
	    ';
	}
		
	
	// you can do more wp_head hooks
  	function iheadhook() {
		do_action( 'headfnhooks' );	
	}
	// add initial viewport
   	function iviewport() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";	
	}
		 
   	function ml_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'my-script-handle', plugins_url('idjs/init.jquery.colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, false );
	}
   
    // add Exec Liquidizer
    
    function magic_liquidizer_lite_scripts() {    	
    	// add liquidizer    	 
    	wp_register_script( 'magic-liquidizer-responsive-js', plugins_url('idjs/ml.noconflict.js', __FILE__), array('jquery'), '1.0.0', false);    	
    	wp_enqueue_script( 'magic-liquidizer-responsive-js');
    	
    } // end liquidizer_lite_scripts
	
}
new magic_liquidizer_wp_class_lite();


} //endif; magic_liquidizer_wp_class_lite

/*
if (class_exists('magic_liquidizer_wp_class_lite') && !class_exists('PremiumClassHeaderTable')) { 

	Class PremiumClassHeaderTable {

 		public function __construct() {
 			add_action('ml_hook_header', array($this, 'mabuhayTable')); 
 		}
 		
 		function mabuhayTable(){	
  
		$liquidizer_lite_options = array(
			'liquidizer_lite_wp_which_table_element' => esc_js(trim($_POST['liquidizer_lite_wp_which_table_element'])),
			'liquidizer_lite_wp_table_width' => esc_js(trim($_POST['liquidizer_lite_wp_table_width'])),
			'liquidizer_lite_wp_table' => isset($_POST['liquidizer_lite_wp_table'])			
		);
		
		echo 'mabuhay!';
		
 		}
	}
	new PremiumClassHeaderTable();

} */

if (class_exists('magic_liquidizer_wp_class_lite') &&  !class_exists('PremiumClassFooter') ) { 

	Class PremiumClassFooter {

 		public function __construct() {
 			add_action('ml_hook_footer', array($this, 'mabuhay'),1); 
 		}
 		function mabuhay(){
 			// checkboxes lists
	
 			echo '				
			
			  <br><br>
			  
			<h3 style="font-weight: bold;"><label for="liquidizer_lite_wp_selector" style="color: #333;">Magic Liquidizer Premium Settings. <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank">Update now!</a></label></h3>
			<h5 style="color: #333;">A complete solution for Responsive Web Design (RWD). See <a href="http://demo.innovedesigns.com/wordpress" target="_blank">DEMO</a></h5>
			<p><input id="liquidizer_lite_wp_video" class="disable" disabled="disabled" style="color: #bbb;" value="" name="liquidizer_lite_wp_video" type="text">
			<label>Responsive Video (e.g. body, #wrapper, etc)</label>
			</p> 
			<p>
			<input id="liquidizer_lite_wp_table" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_table" type="checkbox">
			<label>Make `table` responsive</label>
		    </p>  
			<p>
			<input id="liquidizer_lite_wp_image" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_image" type="checkbox">
			<label>Make `image` responsive</label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_form" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_form" type="checkbox">
			<label>Make `form` responsive</label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_addclasses" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_addclasses" type="checkbox">
			<label>Add Classes (a dirty way to add classes on each div elements)?</label>
			</p>
			<p>
			<input id="liquidizer_lite_wp_htmloverflow" class="disable" disabled style="color: #bbb;" value="1" name="liquidizer_lite_wp_htmloverflow" type="checkbox">
			<label>Disable Horizontal Scroll Bar (not recommended)?</label>
			</p>
			<br />
			<p>
			<h3>Responsive Navigation Bar Settings. <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank">Update now!</a></h3>
			</p>
			<p><input id="liquidizer_lite_navigationbar" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navigationbar" type="text">
			<label>Navigation #ID or .Class</label>
			</p>
			<p><input id="liquidizer_lite_navcolor" class="colorpick disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navcolor" type="text">
			<label style="vertical-align: super;">Navigation bar background color (Leave it as empty as default)</label>
			
			</p>
			<p><input id="liquidizer_lite_navselect" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_navselect" type="text">
			<label>Navigation Select (e.g .current, .current-menu-item, etc)</label>
			</p>
			<p><input id="liquidizer_lite_wp_home" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_home" type="url">
			<label>Enter your Home URL</label>
			</p>
			<p><input id="liquidizer_lite_wp_info" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_info" type="url">
			<label>Enter your About URL</label>
			</p>
			<p><input id="liquidizer_lite_wp_contact" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_contact" type="url">
			<label>Enter your Contact URL</label>
			</p>
			
			<br />
			<h3 style="color: #333">Advanced Settings. <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank">Update now!</a></h3>
			<p><input id="liquidizer_lite_wp_hidetonondesktop" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_hidetonondesktop" type="text">
			<label>Enter an IDs or Classes to keep hidden on Iphone or Ipad Screens (optional).</label>
			</p>
			<p><input id="liquidizer_lite_wp_hidetodesktop" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_hidetodesktop" type="text">
			<label>Enter an IDs or Classes to keep hidden on Desktop Screens (optional).</label>
			</p>
			<p><input id="liquidizer_lite_wp_transparent" class="disable" disabled style="color: #bbb;" value="" name="liquidizer_lite_wp_transparent" type="text">
			<label>Enter an IDs or Classes to keep background image transparent (optional).</label>
			</p>
			<br />
			<h3>Customize Media Queries. <a href="http://www.innovedesigns.com/wordpress/plugin/magic-liquidizer-instant-responsive-web-design-plugin-for-wordpress/" target="_blank">Update now!</a></h3>
			<p><textarea id="liquidizer_lite_wp_styles" class="disable" disabled style="color: #bbb;" name="liquidizer_lite_wp_styles" type="text" rows="10" cols="90"></textarea>
			<br />
			<label>Customize Media Queries (optional).</label>
			</p>
			
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>

		  </td>
	    </tr>
	    </tbody>
      </table>
	    </form>
	    
	    </div>';
 		}
	}
	new PremiumClassFooter();

} // endif;

 // This is a CLASS hook
if (class_exists('magic_liquidizer_wp_class_lite') && !class_exists('MagicLiquidizerResponsiveTableClass')) { 

	Class MagicLiquidizerResponsiveTableClass {
		
 		public function __construct() {
 			add_action('admin_menu', array($this, 'magic_liquidizer_table_menu')); // add item to menu
 			add_action('ml_hook_body', array($this, 'table_hook_fn'),1); 
 			add_action('wp_enqueue_scripts', array($this, 'magic_liquidizer_table_scripts'));
 			add_action('wp_enqueue_scripts', array($this, 'magic_liquidizer_table_style'));	
 		}
 		function magic_liquidizer_table_menu() {
			add_submenu_page('magic-liquidizer-page-lite', 'Magic Liqduizier Responsive Table', 'Table', 'manage_options', 'magic-liquidizer-table', array($this, 'table_hook_fna') );
		}
 		
 		function table_hook_fn(){
 				$checkedTable = get_option('liquidizer_lite_wp_table') ? 'checked="checked"' : '';
			echo '<h3 style="font-weight: bold; color: #333;"><label for="liquidizer_lite_wp_selector">Responsive Table Settings</label></h3>
			<p style="color: #333;">These are default values that may or may not work. <a href="http://www.innovedesigns.com/contact/" target="_blank"> Need help?</a></p>			
			<p>
			<input id="liquidizer_lite_wp_table" class="disable" style="color: #bbb;" value="1" name="liquidizer_lite_wp_table" type="checkbox" '. $checkedTable .'>
			<label style="color: #333;">Make &lt;table&gt; Responsive?</label>
			</p>
			<p><input id="liquidizer_lite_wp_which_table_element" value="' . get_option('liquidizer_lite_wp_which_table_element') .'" name="liquidizer_lite_wp_which_table_element" type="text">
			<label style="color: #333;">E.g. table, #id-table, .class-table. Specify your table\'s class or id.</label>
			</p>
			<p><input id="liquidizer_lite_wp_table_width" value="' . get_option('liquidizer_lite_wp_table_width') .'" name="liquidizer_lite_wp_table_width" type="text">
			<label style="color: #333;">Initiate responsive `table` at breakpoint e.g. 480px, 720px, 840px, or 960px</label>
			</p>
			<p class="submit"><input type="submit" name="submit" class="button-primary" value="Save Changes" /></p>
			
			';		
 		}
 		
 		function table_hook_fna(){
 		echo '<div id="ml-lite" class="table wrap ml-lite">
		<h2 class="title">Magic Liquidizer Responsive Table for Wordpress</h2>
		Make your html &lt;table&gt; responsive.
		';
 	
 	if(isset($_POST['submit']) && check_admin_referer('liquidizer_lite_action','liquidizer_lite_ref') ) {
	
		   /* Array DB _options */
		$liquidizer_lite_options = array(
			'liquidizer_lite_wp_which_table_element' => esc_js(trim($_POST['liquidizer_lite_wp_which_table_element'])),
			'liquidizer_lite_wp_table_width' => esc_js(trim($_POST['liquidizer_lite_wp_table_width'])),
			'liquidizer_lite_wp_table' => isset($_POST['liquidizer_lite_wp_table'])			
		);
	
	/* Handling variable array */	
		foreach($liquidizer_lite_options as $x=>$x_value) {
			if ( get_option( $x ) !== false ) {
				update_option($x, $x_value);
			} else {			
				add_option( $x, $x_value, '', 'yes' );
			}
		}
	   		
	   
	} // end of &_Post
		
	echo '<form method="post" action="'. esc_attr($_SERVER["REQUEST_URI"]) .'">';
		
			wp_nonce_field('liquidizer_lite_action','liquidizer_lite_ref');
	
	echo '<table class="form-table" style="color: #bbb;">
      
	    <tbody>
	    <tr>
		  <td>';
		  
 		 MagicLiquidizerResponsiveTableClass::table_hook_fn();	  	  
		//	do_action( 'ml_hook_body');
		//	do_action( 'ml_hook_footer');
		echo '</tbody>
      	</table>
	    </form>
	    </div>';
		
 		}
 		
 		function magic_liquidizer_table_style() {  	
			wp_register_style( 'magic-liquidizer-table-style', plugins_url('idcss/ml-responsive-table.css', __FILE__),array(), '1.0.6', 'all');
  			wp_enqueue_style( 'magic-liquidizer-table-style' );
		}
	
 		function magic_liquidizer_table_scripts() {    	 	 
    		wp_register_script( 'magic-liquidizer-table', plugins_url('idjs/ml.responsive.table.min.js', __FILE__), array('magic-liquidizer-responsive-js'), '1.0.6', false);    	
    		wp_enqueue_script( 'magic-liquidizer-table');	
    		add_action('wp_print_footer_scripts', array($this, 'execute_jquery_table_lite'));
    	
    	}
    	
    	    // textarea script
	function execute_jquery_table_lite() { 
    	echo 
"
<script type='text/javascript'>
	//<![CDATA[
    ml(document).ready(function() { 
    	ml('html').MagicLiquidizerTable({ whichelement: '".str_replace('  ', '', get_option('liquidizer_lite_wp_which_table_element'))."', breakpoint: '".str_replace(array('px','PX','Px','pX','p x',' '), '', get_option('liquidizer_lite_wp_table_width'))."', table: '".get_option('liquidizer_lite_wp_table')."' })
    })
	//]]>
</script>
    	
";  

	}
 				
	}
	new MagicLiquidizerResponsiveTableClass();

}
 		

register_activation_hook(__FILE__, 'liquidizer_table_activation');
// register_deactivation_hook(__FILE__, 'liquidizer_table_deactivation');
register_uninstall_hook(__FILE__, 'liquidizer_table_uninstall');

require_once (dirname(__FILE__) . '/includes/activation.php');
// require_once (dirname(__FILE__) .'/includes/deactivation.php');
require_once (dirname(__FILE__) .'/includes/uninstall.php');	

