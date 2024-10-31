<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://globalisp.pt/
 * @since             1.0.0
 * @package           Private_Intranet
 *
 * @wordpress-plugin
 * Plugin Name:       Private Website - Intranet
 * Plugin URI:
 * Description:      Make your website private! Only logged in users can view your website. Perfect for intranets or in development websites. It forces the user to login in order to view and navigate the website. Use the shortcode [private-website-intranet-login] in your login page, and configure the options in the menu "Private Intranet".
 * Version:           1.1.1
 * Author:            Global ISP
 * Author URI:        https://globalisp.pt/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       private-website-intranet
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-private-website-intranet-activator.php
 */
function activate_private_intranet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-private-website-intranet-activator.php';
	Private_Intranet_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-private-website-intranet-deactivator.php
 */
function deactivate_private_intranet() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-private-website-intranet-deactivator.php';
	Private_Intranet_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_private_intranet' );
register_deactivation_hook( __FILE__, 'deactivate_private_intranet' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-private-website-intranet.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_private_intranet() {

	$plugin = new Private_Intranet();
	$plugin->run();

}
run_private_intranet();
