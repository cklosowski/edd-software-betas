<?php
/*
Plugin Name: Easy Digital Downloads - Software Betas
Plugin URI: https://filament-studios.com
Description: Allows stores to provide easy access of Beta versions to purchasing customers
Version: 1.0
Author: Filament Studios
Author URI: http://filament-studios.com
Text Domain: edd-bf-txt
*/

function edd_render_beta_files_field( $post_id = 0 ) {
	$type             = edd_get_download_type( $post_id );
	$files            = edd_get_download_files( $post_id );
	$variable_pricing = edd_has_variable_prices( $post_id );
	$display          = $type == 'bundle' ? ' style="display:none;"' : '';
	$variable_display = $variable_pricing ? '' : 'display:none;';
?>
	<div id="edd_beta_files"<?php echo $display; ?>>
		<p>
			<strong><?php _e( 'Beta Downloads:', 'edd' ); ?></strong>
		</p>

		<input type="hidden" id="edd_beta_files" class="edd_repeatable_upload_name_field" value=""/>

		<div id="edd_file_fields" class="edd_meta_table_wrap">
			<table class="widefat edd_repeatable_table" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<!--drag handle column. Disabled until we can work out a way to solve the issues raised here: https://github.com/easydigitaldownloads/Easy-Digital-Downloads/issues/1066
						<th style="width: 20px"></th>
						-->
						<th style="width: 20%"><?php _e( 'File Name', 'edd' ); ?></th>
						<th><?php _e( 'File URL', 'edd' ); ?></th>
						<th class="pricing" style="width: 20%; <?php echo $variable_display; ?>"><?php _e( 'Price Assignment', 'edd' ); ?></th>
						<?php do_action( 'edd_download_file_table_head', $post_id ); ?>
						<th style="width: 2%"></th>
					</tr>
				</thead>
				<tbody>
				<?php
					if ( ! empty( $files ) && is_array( $files ) ) :
						foreach ( $files as $key => $value ) :
							$name = isset( $value['name'] ) ? $value['name'] : '';
							$file = isset( $value['file'] ) ? $value['file'] : '';
							$condition = isset( $value['condition'] ) ? $value['condition'] : false;

							$args = apply_filters( 'edd_file_row_args', compact( 'name', 'file', 'condition' ), $value );
				?>
						<tr class="edd_repeatable_upload_wrapper edd_repeatable_row">
							<?php do_action( 'edd_render_file_row', $key, $args, $post_id ); ?>
						</tr>
				<?php
						endforeach;
					else :
				?>
					<tr class="edd_repeatable_upload_wrapper edd_repeatable_row">
						<?php do_action( 'edd_render_file_row', 0, array(), $post_id ); ?>
					</tr>
				<?php endif; ?>
					<tr>
						<td class="submit" colspan="4" style="float: none; clear:both; background: #fff;">
							<a class="button-secondary edd_add_repeatable" style="margin: 6px 0 10px;"><?php _e( 'Add New File', 'edd' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php
}
add_action( 'edd_meta_box_files_fields', 'edd_render_beta_files_field', 30 );
