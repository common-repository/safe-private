<?php
/*
Plugin Name: Safe Private
Plugin URI: http://www.sherpah.net/
Description: A Safe Wordpess Private Website
Version: 1.3
Author: Sherpah.net
Author URI: http://www.sherpah.net/
License: GPLv2 or later
*/

/*
Plugin Activation /Deactivation
*/

function safe_private_activation() {
}
register_activation_hook(__FILE__, 'safe_private_activation');

     function safe_private_deactivation() {
}
register_deactivation_hook(__FILE__, 'safe_private_deactivation');

/*
Custom Login Page: Css
*/

function safe_private_login_head() {
     $is_private  =  (isset($_GET['priv'])) ? true : false;
     if (!$is_private) return;
     echo '<style type="text/css">' . "\n" . 
'#login_error {text-align:center;margin:30px 0px 0px 0px;padding: 10px 0px 10px 0px; 
border:solid red 2px;}' . "\n" . 
'</style>' . "\n";
}

/*
Custom Login Page: Html
*/

function safe_private_login_footer() {
     $is_private  =  (isset($_GET['priv'])) ? true : false;
     if (!$is_private) return;
     echo '<div id="login_error">' . "\n". 	
     '<strong>' . __('Access denied') . '</strong>&nbsp;: ' . __('You do not have permission to access this Website.') . '<br />'  . "\n" 
     . __('This is a private area, You must be a member of ') . '<strong>' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</strong>' . ".\n" 
     . '</div>' . "\n";
}

/*
Redirect function
*/

function safe_private() {
     if (!is_user_logged_in() ) {
           $redirect_url = esc_url( wp_login_url() ) . '?priv=1';
           wp_safe_redirect($redirect_url);
           exit;
     }
}

/*
Main features
*/

if (!is_admin() ) {
     add_action( 'parse_request', 'safe_private' );
}
add_action( 'login_head', 'safe_private_login_head' );
add_action( 'login_footer', 'safe_private_login_footer' );
?>