<?php
/**
 * Activate license control
 */
?>
<div class="jet-core-license">
	<p><?php
		esc_html_e( 'Enter your license key here, to activate Crocoblock, and get feature updates, premium support and unlimited access to the template library.', 'zemez-dashboard' );
	?></p>

	<ol>
		<li><?php esc_html_e( 'Log in to your account to get your license key.', 'zemez-dashboard' ); ?></li>
		<li><?php esc_html_e( 'Copy the license key from your account and paste it below.', 'zemez-dashboard' ); ?></li>
	</ol>

	<label for="zemez_license"><?php esc_html_e( 'Your License Key', 'zemez-dashboard' ); ?></label>
	<div class="jet-core-license__form">
		<input id="jet_core_license" class="jet-core-license__input cx-ui-text" placeholder="<?php esc_html_e( 'Please enter your license key here', 'zemez-dashboard' ); ?>">
		<button type="button" class="cx-button cx-button-primary-style" id="jet_activate_license"><?php
			esc_html_e( 'Activate', 'zemez-dashboard' );
		?></button>
	</div>
	<div class="jet-core-license__errors"><?php echo $error_message; ?></div>

	<?php esc_html_e( 'Your license key should look something like this:', 'zemez-dashboard' ); ?> eb845a05958893feb72E137a501f35bf
</div>