<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://globalisp.pt/
 * @since      1.0.0
 *
 * @package    Private_Intranet
 * @subpackage Private_Intranet/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Private_Intranet
 * @subpackage Private_Intranet/public
 * @author     Global ISP <geral@globalisp.pt>
 */
class Private_Intranet_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/private-website-intranet-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/private-website-intranet-public.js', array( 'jquery' ), $this->version, false );

	}

	function private_intranet_redirect_guest_user(){

		$login_page_id = get_option('private-website-intranet-login-page', '');
		$login_page_link = get_page_link($login_page_id);

		$redirect_after_login_page_id = get_option('private-website-intranet-redirect-after-login-page', '');
		$redirect_after_login_page_link = get_page_link($redirect_after_login_page_id);

		$current_page_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$wp_login = get_site_url() . '/wp-login';
		$wp_login_php = get_site_url() . '/wp-login.php';

			 if ( !is_user_logged_in() && ($login_page_id !== '') &&
				 		($login_page_link !== $current_page_url) &&
						($wp_login !== $current_page_url) &&
						($wp_login_php !== $current_page_url) ){
				 	wp_redirect($login_page_link);
				 	exit;
			}

		} // End private_intranet_redirect_guest_user() Function

	function private_intranet_redirect_loggedin_user() {
		$login_page_id = get_option('private-website-intranet-login-page', '');
		$login_page_link = get_page_link($login_page_id);

		$current_page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$redirect_after_login_page_id = get_option('private-website-intranet-redirect-after-login-page', '');
		$redirect_after_login_page_link = get_page_link($redirect_after_login_page_id);

			if ( is_user_logged_in() && ($current_page_link == $login_page_link) ) {
				wp_redirect($redirect_after_login_page_link);
				exit;
			}
	} // End private_intranet_redirect_loggedin_user() Function



} // End Private_Intranet_Public Class

function private_intranet_login_no_shortcode( $content ) {
	// Get the page content
	// If the user is logged out, tries to access the login page and the shortcode is not active, display the login form
	$login_page_id = get_option('private-website-intranet-login-page', '');
	$login_page_link = get_page_link($login_page_id);

	$current_page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$shortcode_in_use = get_option( 'private-website-intranet-use-shortcode');

	if ( !is_user_logged_in() && ( $shortcode_in_use != '1' ) &&
			($current_page_link === $login_page_link) ) {
		$redirect_after_login_page_id = get_option('private-website-intranet-redirect-after-login', '');
		$redirect_after_login_page_link = get_page_link($redirect_after_login_page_id);

		$form_args = array(
			'redirect' => $redirect_after_login_page_link
		);

		require_once dirname( __FILE__ ) . '/partials/private-website-intranet-public-login-form.php';
		return $content;
	}
	else {
		return $content;
	}
}

function private_intranet_login_shortcode() {

		$redirect_after_login_page_id = get_option('private-website-intranet-redirect-after-login', '');
		$redirect_after_login_page_link = get_page_link($redirect_after_login_page_id);
		$form_args = array(
			'echo' => false,
			'redirect' => $redirect_after_login_page_link
		);

		$form = '<div class="custom-login-form">' . wp_login_form($form_args) . '	</div>';

		return $form;

} // End private_intranet_login_shortcode() Function

if ( get_option( 'private-website-intranet-use-shortcode' ) == '1') {
	add_shortcode( 'private-website-intranet-login', 'private_intranet_login_shortcode' );
}
