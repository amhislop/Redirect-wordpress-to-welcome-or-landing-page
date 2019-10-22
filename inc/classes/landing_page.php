<?php
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

require_once plugin_dir_path( __DIR__ ) . "base/controller.php";

class LandingPage extends Controller
{

  public $url;


  public $redirect_duration;


  public $cookie_name;


  public $redirect_from;


  public $valid_page;

  /**
   * Landing page construct
   * 
   * @param string Name of cookie to set
   */
  function __construct( $cookie_name ) {

    $this->cookie_name = $cookie_name;

    // get landing page url
    $this->url = get_option( $this->slug . '_url', null );

    // get landing page option (all || home)
    $this->redirect_from = get_option( $this->slug . '_for_all_pages', 'home' );

    $this->valid_page = $this->is_valid_page();

    $this->redirect_duration = $this->get_duration();

  }

  /**
   * Set cookie
   */
  function set_cookie() {

    // get cookie time
    setcookie( $this->cookie_name, true, $this->redirect_duration );
    
  }

  /**
   * Get duration as set in options
   * 
   * @return int duration time stamp
   */
  function get_duration() {

    $metric = get_option( $this->slug . '_cookie_time', 7 );
    $type   = get_option( $this->slug . '_cookie_time_type', 'days' );

    return strtotime("+$metric $type");

  }

  /**
   * Check if current page is feed or admin page otherwise return if current page is valid
   * 
   * @return boolean
   */
  function is_valid_page() {

    // If feed page we will do nothing or will be a bug :D
    // https://wordpress.org/support/topic/rss-feed-not-working-if-redirect-wordpress-to-welcome-or-landing-page-is-on
    if( is_feed() || is_admin() ) return false;

    return $this->redirect_from === 'all' || ( $this->redirect_from === 'home' && is_front_page() );

  }

  /**
   * Redirect page
   */
  function redirect() {

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Location: ". $this->url);

    die;
  }
}
