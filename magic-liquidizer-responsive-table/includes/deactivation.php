<?php
defined( 'ABSPATH' ) OR exit;

/*
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

function liquidizer_table_deactivation() {
	if(current_user_can( 'activate_plugins' )) {
	
		echo '<div class="margin-auto" style="width: 50%; position: relative; margin: 10% auto 0px; padding: 20px; border-radius: 10px 10px 10px 10px; background: none repeat scroll 0px 0px rgb(224, 224, 224); font-family: arial;"><title>Safe Uninstall Liquidizer</title>
		<h1>Clean Deactivation Notice</h1>
		<div id="wpwrap"><h2>Would you like to delete Magic Liquidizer\'s Database?</h2><br />
		<form action="" method="post">
		<input type="radio" name="yesorno" value="yes"><label>Yes</label>
		<input type="radio" name="yesorno" value="no" checked="checked"><label>No</label>
		<p class="submit"><input type="submit" value="Save Changes" class="button-primary" name="submit"></p>
		*Note: This will not affect your native wordpress database
		</form>
		</div></div>';
		
		
	/* Get post */
	
	if(isset($_POST['submit'])){
		if($_POST['yesorno'] == 'yes'){
			delete_option('liquidizer_lite_wp_table');
			delete_option('liquidizer_lite_wp_which_table_element');
			delete_option('liquidizer_lite_wp_table_width');
			
			return;
			echo '<div style="color:green">Liquidizer is Safely Uninstalled</div>';
			 
			
		} elseif($_POST['yesorno'] == 'no'){
			return;
			echo '<div style="color:green">Liquidizer is Safely Uninstalled</div>';
			 			
		} else {
			echo '<div class="warning" style="color:red">You haven\'t selected any options</div>';
		}
	}
	
   } else {
		echo 'You do not have permission to deactivate this plugin, please click go back!';
   }
   
   exit();
		
}	

