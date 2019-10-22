<?php

namespace eslam\redirect;

/**
 * @package EslamRedirectToLandingPage
 */

require_once plugin_dir_path( __DIR__ ) . "base/controller.php";

class Settings extends Controller
{

  public function register() {
    add_action( 'admin_init', array( $this, 'add_settings_fields' ) );
    add_action( 'admin_menu', array( $this, 'add_settings_menu' ) );
    add_filter( 'plugin_action_links_' .  $this->plugin, array( $this, 'add_settings_link' ) );
  }

  public function add_settings_link($links) {
    $settings_link = '<a href="' . menu_page_url( $this->slug, false ) . '">Settings</a>';
    array_push( $links, $settings_link );
    return $links;
  }

  public function add_settings_fields() {
    $prefix = $this->slug;

    // Add section
    add_settings_section( 
      $prefix . '-options-section', 
      'Redirection Settings', 
      array( $this, 'redirect_section_options' ), 
      $prefix . '_settings' 
    );
    
    // Setting: landing Page URL
    register_setting( $prefix . '-settings-group', $prefix . '_url' );
    add_settings_field( 
      $prefix . '_url', 
      'The welcome or landing page URL', 
      array( $this, 'page_url_setting' ), 
      $prefix . '_settings', 
      $prefix . '-options-section' 
    );
    
    // Setting redirect visitor duration
    register_setting( $prefix . '-settings-group', $prefix . '_cookie_time' );
    register_setting( $prefix . '-settings-group', $prefix . '_cookie_time_type' );
    add_settings_field( 
      $prefix . '_cookie_time', 
      'Redirect visitor every ', 
      array( $this, 'redirect_duration' ), 
      $prefix . '_settings', 
      $prefix . '-options-section' 
    );
    
    // Redirect on page selection
    register_setting( $prefix . '-settings-group', $prefix . '_for_all_pages' );
    add_settings_field( 
      $prefix . '_for_all_pages', 
      'Allow redirect from ', 
      array( $this, 'redirect_from' ), 
      $prefix . '_settings', 
      $prefix . '-options-section' 
    );
  }

  public function redirect_section_options() {

  }

  public function page_url_setting() {

    $site_url = get_site_url();
    $option = get_option($this->slug . '_url');
    echo "<input type='url' name='" . $this->slug . "_url' value='$option'><code>$site_url/landingPage</code>";

  }

  public function redirect_duration() {

    $option = get_option($this->slug . '_cookie_time');
    $type = get_option($this->slug . '_cookie_time_type');
    $valid_types = array( 'minutes', 'hours', 'days' );

    ?>
    <input type='number' name="<?php echo $this->slug . '_cookie_time'?>" value='<?php echo $option?>'>
    <select name="<?php echo $this->slug . '_cookie_time_type'?>">
      <?php foreach($valid_types as $valid_type) : ?>
        <option value='<?php echo $valid_type ?>' <?php echo selected( $valid_type === $type) ?>><?php echo ucfirst($valid_type); ?></option>
      <?php endforeach ?>
    </select>
    <?php
  }

  public function redirect_from() {
    
    $option = get_option($this->slug . '_for_all_pages', 'home');

    $values = array( 
      'home' => 'Home page only', 
      'all' => 'All pages' 
    );

    foreach($values as $key => $value) : ?>
      <label style='display: block;'>
        <input type='radio' <?php checked( $key === $option ); ?> name="<?php echo $this->slug . '_for_all_pages'?>" value='<?php echo $key ?>'> 
        <?php echo $value ?>
      </label>
    <?php endforeach;

  }


  public function add_settings_menu() {

    $menu_title = str_replace('wordpress ', '', $this->plugin_name);
    $page_title = str_replace('welcome or ', '', $menu_title);

    add_submenu_page( 
      'options-general.php', 
      $page_title,
      $menu_title,
      'manage_options',
      $this->slug,
      array( $this, 'settings_page_layout' )
    );

  }

  public function settings_page_layout() {
    if ( !current_user_can( 'manage_options' ) ) die;

    $this->template_include('settings-form.php');

  }
}
