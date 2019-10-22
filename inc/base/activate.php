<?php
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

require_once plugin_dir_path( __DIR__ ) . "base/controller.php";

class Activate
{
  
  public static function activate_plugin(){

    flush_rewrite_rules();

    $controller = new Controller();
    $prefix = $controller->slug;

    // Setup presets
    if( !get_option( $prefix . '_for_all_pages', false ) ) update_option( $prefix . '_for_all_pages', false );
    if( !get_option( $prefix . '_cookie_time', false ) ) update_option( $prefix . '_cookie_time', 7 );
    if( !get_option( $prefix . '_cookie_time_type', false ) ) update_option( $prefix . '_cookie_time_type', 'days' );

    // Check if Landing page url has been previously set
    if( !get_option( $prefix . '_url', false ) ) {
      // Set transient to display setup landing page notice
      set_transient( '__eslam_me_instructions', true, 60 );
    }
  }

}
