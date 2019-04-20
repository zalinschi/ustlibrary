<?php
/*
Plugin Name: Digital Library
Author: Zalinschi Veaceslav
Description: Plugin for creating a digital library
*/

//Definim constanta URL mapa pluginului
define( 'plugin_slug', 'ust-library' );
define( 'plugin_dir', WP_PLUGIN_DIR.'/'.plugin_slug.'/' );

// Facem Update la URL site-ului după ce a fost adăugat un CPT nou
	function b3c_library_activation(){ flush_rewrite_rules(); }
	register_activation_hook( __FILE__, 'b3c_library_activation' );

// Facem Update la URL site-ului după ce a fost șters CPT-ul
	function b3c_library_deactivation(){ flush_rewrite_rules(); }
	register_deactivation_hook( __FILE__, 'b3c_library_deactivation' );

//Incluziuni de fisier
	require_once( plugin_dir . '/includes/register-post-type.php');
	require_once( plugin_dir . '/includes/custom-fields.php');
	require_once( plugin_dir . '/includes/function.php');
	require_once( plugin_dir . '/includes/templates.php');
	require_once( plugin_dir . '/includes/shortcodes.php');
	require_once( plugin_dir . '/includes/pdf-viewer.php');


//REGISTER SCRIPT & STYLE
// Încărcăm CSS și JS pe Front-End(doar pe paginile POST TYPE-ului library)
function library_enqueue_front_end() {
	//if ( 'b3c_library' == get_post_type() ):
    wp_enqueue_style( 'b3c-library',  plugins_url('assets/library.css', __FILE__) ); 
    wp_enqueue_script( 'b3c-library', plugins_url('assets/library.js', __FILE__) , array('jquery'), '1.0', true);
	//endif;
}
add_action( 'wp_enqueue_scripts', 'library_enqueue_front_end' );
 

 /*
// load css into the admin pages
function mytheme_enqueue_options_style() {
    wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/css/admin.css' ); 
}
add_action( 'admin_enqueue_scripts', 'mytheme_enqueue_options_style' );
*/

add_action( 'plugins_loaded', 'true_load_plugin_textdomain' );
function true_load_plugin_textdomain() {
  load_plugin_textdomain( 'ust-library', false, dirname( plugin_basename(__FILE__) ).'/language/' ); 
}
