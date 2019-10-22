<?php
namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

class Controller
{

  public $version = '2.1';

  public $slug = 'eslam_me_wordpress_redirect_to_landing_page';

  public $plugin_name  = 'Redirect wordpress to welcome or landing page';

  public $plugin;

  public $plugin_path;

  public $plugin_url;

  public function __construct(){
    $this->plugin_path  = plugin_dir_path( dirname( dirname(__FILE__) ) );
    $this->plugin_url   = plugin_dir_url( dirname( dirname(__FILE__) ) );
    $this->plugin = plugin_basename( dirname( dirname( dirname(__FILE__) ) ) ) . '/' . $this->slug . '.php';
  }

  /**
   * Template
   * ---------------------------------------------
   * @param String | $filename | Name of the template
   * @return false
   * ---------------------------------------------
   **/

	public function template($filename) {

		// check theme
		$theme = get_template_directory() . "/$this->slug/$filename";

		if (file_exists($theme)) {
			$path = $theme;
		} else {
			$path = $this->plugin_path . "templates/$filename";
		}
		return $path;

	}

  /**
   * Template Include
   * ---------------------------------------------
   * @param String  | $template |  Name of the template
   * @param *       | $data     |  Data to pass to a template
   * @param String  | $name     |  Data value name
   * @return false
   * ---------------------------------------------
   **/

	public function template_include( $template, $data = null, string $name = null){

		if(isset($name)){ ${$name} = $data; }

    $path = $this->plugin_path . "templates/$template";

		include($path);
  }

}
