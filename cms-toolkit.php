<?php
/*
Plugin Name: WordPress CMS Toolkit
Plugin URI: http://github.com/CFPB/cms-toolkit/
Description: This plugin contains classes that help developers turn WordPress into a full CMS.

This plugin provides tools for extending WordPress for as a CMS. This includes 
things like the function `build_post_type()` a helper function for WordPress 
core's `register_post_type` function. The goal was the promote DRY coding 
practices and a simplified process for creating admin meta boxes. While it is 
currently integrated with WordPress as a plugin, it may be more helpful to 
think of it as a library. A collection of methods which, when installed, are 
available throughout the application and make building complex functionality 
in WordPress a little easier.

Version: 1.0
Author: Greg Boone, Aman Kaur, Matthew Duran
Author URI: http://github.com/cfpb/
License: Public Domain work of the Federal Government

Code complexity: 5, OK. (pdepend --summary-xml=QA/scotlandphp-summary.xml scotland.php)
Passes phpcs --standard=WordPress
*/
function cfpb_build_plugin() {
	define( 'CFPB_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
	define( 'CFPB_INC', CFPB_DIR . trailingslashit( 'inc' ) );
	require_once( CFPB_INC . 'meta-box-models.php');
	require_once( CFPB_INC . 'meta-box-callbacks.php');
	require_once( CFPB_INC . 'meta-box-view.php');
	require_once( CFPB_INC . 'meta-box-html.php');
	require_once( CFPB_INC . 'capabilities.php');
	require_once( CFPB_INC . 'post-types.php');
	require_once( CFPB_INC . 'taxonomies.php');
	define( 'DEPENDENCIES_READY', true);
	add_action('admin_enqueue_scripts', 'cfpb_cms_toolkit_scripts');
}

function cfpb_cms_toolkit_scripts() {
	wp_enqueue_script('cms_tookit', plugins_url('/js/functions.js', __FILE__), 'jquery', '1.0', true );
	wp_register_style( 'cms_toolkit_styles', plugins_url('/css/styles.css', __FILE__ ), null, '1.0');
	wp_enqueue_style( 'cms_toolkit_styles' );
}

add_action( 'plugins_loaded', 'cfpb_build_plugin', $priority = 1 );
