<?php
/**
 * Activate license control
 */
?>
<div class="jet-core-license">
	<div class="jet-core-license__errors"><?php echo $error_message; ?></div>
	<label for="jet_core_license"><?php esc_html_e( 'Your License Key', 'zemez-dashboard' ); ?></label>
	<div class="jet-core-license__form">
		<input id="jet_core_license" class="jet-core-license__input cx-ui-text" value="<?php echo $formated_license; ?>">
		<button type="button" class="cx-button cx-button-normal-style" id="jet_deactivate_license"><?php
			esc_html_e( 'Deactivate', 'zemez-dashboard' );
		?></button>
	</div>
	<?php esc_html_e( 'Status:', 'zemez-dashboard' ); ?>&nbsp;
	<?php
		$status = zemez_dashboard()->api->license_status( $license );
		printf(
			'<span class="jet-core-license__status status-%1$s">%2$s</span>',
			( true === $status['success'] ? 'success' : 'error' ),
			$status['message']
		);
	?>
</div>