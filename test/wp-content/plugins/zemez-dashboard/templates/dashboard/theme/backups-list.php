<?php
/**
 * Backups list
 */
?>
<div class="jet-backups">
	<table>
		<thead>
			<tr>
				<th class="jet-backups-file"><?php
					_e( 'File', 'zemez-dashboard' );
				?></th>
				<th class="jet-backups-date"><?php
					_e( 'Created', 'zemez-dashboard' );
				?></th>
				<th class="jet-backups-actions"><?php
					_e( 'Actions', 'zemez-dashboard' );
				?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $backups as $backup ) { ?>
			<tr>
				<td class="jet-backups-file"><?php echo $backup['name']; ?></td>
				<td class="jet-backups-date"><?php echo $backup['date']; ?></td>
				<td class="jet-backups-actions"><?php echo $this->get_backup_actions( $backup['name'] ); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>