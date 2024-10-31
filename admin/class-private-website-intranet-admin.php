<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://globalisp.pt/
 * @since      1.0.0
 *
 * @package    Private_Intranet
 * @subpackage Private_Intranet/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Private_Intranet
 * @subpackage Private_Intranet/admin
 * @author     Global ISP <geral@globalisp.pt>
 */

class Private_Intranet_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Private_Intranet_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Private_Intranet_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/private-website-intranet-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Private_Intranet_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Private_Intranet_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/private-website-intranet-admin.js', array( 'jquery' ), $this->version, false );

	}

	function private_intranet_create_menu(){
		add_menu_page(
			__('Private Intranet Dashboard', 'private-website-intranet'), // Page Title
			'Private Intranet', // Menu Name
			'manage_options', // Capability required (Only Admins)
			'private-website-intranet-menu-page', // Menu/Page Slug
			'private_intanet_menu_page_content', // Callback Function
			'', // Icon URL
			500 // Position
		);
	}

	function private_intranet_register_settings(){
		add_settings_section(
			'private-website-intranet-section-1', // ID of the section
			__('Settings', 'private-website-intranet'), // Title of the section
			'private_intranet_section_callback', // Callback function of the section
			'private-website-intranet-menu-page' // Slug of the settings/menu page
		);

		add_settings_field(
			'private-website-intranet-redirect-after-login', // ID of the field
			__('Page to Redirect after Login', 'private-website-intranet'), // Title of the field
			'private_intranet_redirect_after_login_callback', // Callback of the field
			'private-website-intranet-menu-page', // Slug of the settings/menu page
			'private-website-intranet-section-1', // ID of the section we want to associate this field to
			'' // Arguments to pass to the above callback
		);

		register_setting(
			'private-website-intranet-menu-page', // Option group (Name of the menu page)
			'private-website-intranet-redirect-after-login', // Option (Name of the field)
			'' // Array of data to describe the setting when registered.
		);

		add_settings_field(
			'private-website-intranet-login-page', // ID of the field
			__('The actual Login Page', 'private-website-intranet'), // Title of the field
			'private_intranet_login_page_callback', // Callback of the field
			'private-website-intranet-menu-page', // Slug of the settings/menu page
			'private-website-intranet-section-1', // ID of the section we want to associate this field to
			'' // Arguments to pass to the above callback
		);

		register_setting(
			'private-website-intranet-menu-page', // Option group (Name of the menu page)
			'private-website-intranet-login-page', // Option (Name of the field)
			'' // Array of data to describe the setting when registered.
		);

		add_settings_field(
			'private-website-intranet-use-shortcode', // ID of the field
			__('Use shortcode to place the login form?', 'private-website-intranet'), // Title of the field
			'private_intranet_use_shortcode_callback', // Callback of the field
			'private-website-intranet-menu-page', // Slug of the settings/menu page
			'private-website-intranet-section-1', // ID of the section we want to associate this field to
			'' // Arguments to pass to the above callback
		);

		register_setting(
			'private-website-intranet-menu-page', // Option group (Name of the menu page)
			'private-website-intranet-use-shortcode', // Option (Name of the field)
			'' // Array of data to describe the setting when registered.
		);

	}

} // End of Private_Intranet_Admin Class

function private_intanet_menu_page_content(){
	require_once dirname( __FILE__ ) . '/partials/private-website-intranet-admin-display.php';
}

function private_intranet_section_callback(){
	_e("All the configurations related to the 'Private Intranet' plugin are made here.
	No other configurations needed.", "private-website-intranet");
}

function private_intranet_redirect_after_login_callback() {
	$current_page_id = get_option('private-website-intranet-redirect-after-login', '');
	$current_page_title = get_the_title( $current_page_id );

	?>

	<select id="private-website-intranet-redirect-after-login" name="private-website-intranet-redirect-after-login">
	<option value=" <?php echo $current_page_id ?> "><?php echo esc_attr( __( $current_page_title ) ); ?></option>
	<?php
	 $pages = get_pages();
	 foreach ( $pages as $page ){
		 if ($page->ID == $current_page_id){
			 $page = '';
		 }
		 else{
		 $option = '<option id="" name=""
		 value="' . $page->ID . '">'. $page->post_title .'</option>';
		 echo $option;
	 		}
	 	}
	?>
	</select>

 <?php
 } // End of private_intranet_redirect_after_login_callback() function

function private_intranet_login_page_callback() {
	$current_page_id = get_option('private-website-intranet-login-page', '');
	$current_page_title = get_the_title( $current_page_id );

	?>

	<select id="private-website-intranet-login-page" name="private-website-intranet-login-page">
	<option value=" <?php echo $current_page_id ?> "><?php echo esc_attr( __( $current_page_title ) ); ?></option>
	<?php
	 $pages = get_pages();
	 foreach ( $pages as $page ){
		 if ($page->ID == $current_page_id){
			 $page = '';
		 }
		 else{
		 $option = '<option id="" name=""
		 value="' . $page->ID . '">'. $page->post_title .'</option>';
		 echo $option;
	 		}
	 	}
	?>
	</select>

 <?php

	function private_intranet_use_shortcode_callback(){
		$current_use_shortcode_value = get_option('private-website-intranet-use-shortcode');

		$html = '<input type="checkbox" id="private-website-intranet-use-shortcode"
		name="private-website-intranet-use-shortcode" value="1"' .
		checked( 1, $current_use_shortcode_value, false ) .
		'>';
		echo $html;

		_e('Check to use the shortcode [private-website-intranet-login] in the defined login page above in order
		for the login form to appear', 'private-website-intranet');
	}

 } // End of private_intranet_login_page_callback()
