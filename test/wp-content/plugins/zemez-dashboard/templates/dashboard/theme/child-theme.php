<?php
/**
 * Child theme template
 */
?>
<div class="jet-child-theme">
	<h4 class="jet-child-theme__name"><?php _e( 'Child Theme', 'zemez-dashboard' ); ?></h4>
	<div class="jet-child-theme__status">
		<b><?php _e( 'Status:', 'zemez-dashboard' ); ?></b>
		<span><?php echo $child_status['message']; ?></span>
	</div>
	<?php if ( 'not_installed' === $child_status['code'] ) : ?>
	<div class="jet-child-theme__install">
		<button class="cx-button cx-button-primary-style" data-action="install-child" type="button"><?php
			_e( 'Install', 'zemez-dashboard' );
		?></button>
	</div>
	<?php endif; ?>
	<div class="jet-child-theme__errors"></div>
</div>