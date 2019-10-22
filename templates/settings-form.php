<h2><?php echo $this->plugin_name; ?>.</h2>
<p>Easy simple to the point plug-in allow you to set page so users get redirected to it if they landed on your home page or any page or post. Your visitors will be redirected to the set URL if it is the first time they visit your website and for X days, hours or minutes (you set the number in the configration) if they visit again within the time they will not be redirected again.</p>
<form method="post" action="options.php">
  <?php
    settings_fields( $this->slug . '-settings-group' );
    do_settings_sections( $this->slug . '_settings' );
  ?>
  <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
<div style=" font-size: 18px;">
	<a href="https://goo.gl/TBGYZv" target="_blank"><img src="<?php echo $this->plugin_url . 'files/donate-paypal.png'; ?>" scale="0" style="float: left; max-width: 150px; padding-right: 20px;"></a>
	<h4>Show some love &amp; <a href="https://goo.gl/TBGYZv" target="_blank">donate with paypal</a></h4>
	<p><b>Developed by: </b><a target="_blank" href="http://eslam.me">Eslam Mahmoud</a></p>	
</div>