<?php 
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */
require_once plugin_dir_path( __FILE__ ) . "pages/settings.php";
require_once plugin_dir_path( __FILE__ ) . "base/redirect.php";
require_once plugin_dir_path( __FILE__ ) . "base/notices.php";


final class Init
{
  /**
   *  Store all the classes inside array
   *  @return array Full list of classes
   */
  public static function get_services()
  {
    return array(
      // Settings::class,
      // Redirect::class,
      'eslam\redirect\Notices',
      'eslam\redirect\Settings',
      'eslam\redirect\Redirect',
      // 'Notices',
    );
  }

  /**
   * Loop through the classes,initialise and call register function
   * @return
   */
  public static function register_services()
  {
    // new Redirect();
    
    foreach( self::get_services() as $class ) {
      $service = self::instantiate( $class );
      if ( method_exists( $service, 'register' ) ) {
        $service->register();
      }
    }
  }

  /**
   * Initialise the class
   * @param class $class      class from the services array
   * @return class instance   new instance of class
   */
  private static function instantiate( $class )
  {
    $service = new $class();

    return $service;
  }
}
