<?php
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

require_once plugin_dir_path( __DIR__ ) . "base/controller.php";

class Notices extends Controller
{

  public function register() {

    add_action( 'admin_notices', array( $this, 'plugin_activated_notice' ) );

  }

  public function plugin_activated_notice() {

    // Check transient, if available display notice
    if( get_transient( '__eslam_me_instructions' ) ){
      echo "<div class='updated notice is-dismissible'>";
      echo '<p>Add your welcome or landing page URL on the <a href="' . menu_page_url( $this->slug, false ) . '">settings page</a> to get started</p>';
      echo "</div>";

      /* Delete transient, only display this notice once. */
      delete_transient( '__eslam_me_instructions' );
    }
    
  }

}
