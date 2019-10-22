<?php
/**
 * Plugin Name: Redirect wordpress to welcome or landing page.
 * Plugin URI: http://eslam.me
 * Description: Easy simple to the point plug-in allow you to set page so users get redirected to it if they landed on your home page or any page or post
 * Version: 2.1
 * Author: Eslam Mahmoud
 * Author URI: http://eslam.me
 * License: GPL2
 */

//Blocking direct access to the plugin
defined('ABSPATH') or die("No script kiddies please!");

require_once plugin_dir_path( __FILE__ ) . "inc/init.php";

use eslam\redirect\Init;

/**
 * Activation Hook
 */
// function activate_eslam_redirect_plugin(){
  require_once plugin_dir_path( __FILE__ ) . "inc/base/activate.php";
//   eslam\redirect\Activate::activate_plugin();
// }
// register_activation_hook( __FILE__, 'activate_eslam_redirect_plugin' );
register_activation_hook( __FILE__, array('eslam\redirect\Activate', 'activate_plugin') );


/**
 * Intialize all the core classes of plugin
 */
if ( class_exists( 'eslam\redirect\Init' ) ) Init::register_Services();
