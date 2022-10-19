<?php
/**
 * Skins actions
 */
?>
<div class="jet-skins-actions">
	<a href="<?php $this->synch_skins_link(); ?>" class="cx-button cx-button-success-style"><?php
		_e( 'Synchronise Skins Library', 'zemez-dashboard' );
	?></a>
	<?php

		if ( null === $this->has_license ) {
			$this->has_license = \Zemez_Dashboard\Utils::get_license();
		}

		if ( empty( $this->has_license ) ) {
			printf(
				'<a href="%1$s" class="cx-button cx-button-primary-style">%2$s</a>',
				\Zemez_Dashboard\Utils::active_license_link(),
				__( 'Activate License to Install Skins', 'zemez-dashboard' )
			);
		}

	?>
</div>
