<?php
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

require_once plugin_dir_path( __DIR__ ) . "base/controller.php";
require_once plugin_dir_path( __DIR__ ) . "classes/landing_page.php";

class Redirect extends Controller
{

  public function register() {
    add_action( 'wp', array( $this, 'redirect_handler' ) );

  }

  public function redirect_handler() {

    // If the user has the cookie set after having visted do nothing so as to not redirect again
    if( !empty($_COOKIE[$this->slug . '_url_visited']) ) return;

    $landing_page = new LandingPage( $this->slug . '_url_visited' );

    // Check if settings and page are valid
    if( empty( $landing_page->url ) || !$landing_page->valid_page ) return;

    // Set the cookie that say the user visited the landing page
    $landing_page->set_cookie();

    // Redirect the user to the landing page
    $landing_page->redirect();

    // Exit the plugin script
    die();

  }

}
