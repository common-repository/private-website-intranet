<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://globalisp.pt/
 * @since      1.0.0
 *
 * @package    Private_Intranet
 * @subpackage Private_Intranet/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

	if (!current_user_can('manage_options')) {
			wp_die( __('You do not have sufficient permission to access this page.', 'private-website-intranet') );
	}

	?>

	<div class="wrap">
			<h1><?= esc_html(get_admin_page_title()); ?></h1>

		<?php settings_errors(); ?>
	  <form method="post" action="options.php">

			<?php settings_fields( 'private-website-intranet-menu-page' ) ?>
		  <?php do_settings_sections( 'private-website-intranet-menu-page', 'private-website-intranet-section-1' ); ?>

		<?php submit_button(__('Save all changes','private-website-intranet'), 'primary','submit', TRUE); ?>

	</form>

</div>
