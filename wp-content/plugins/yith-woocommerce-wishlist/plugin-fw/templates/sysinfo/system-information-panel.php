<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$system_info        = get_option( 'yith_system_info' );
$recommended_memory = '128M';

?>
<div id="yith-sysinfo" class="wrap yith-system-info">
    <h1>
        <span class="yith-logo"><img src="<?php echo yith_plugin_fw_get_default_logo() ?>" /></span> <?php _e( 'YITH System Information', 'yith-plugin-fw' ) ?>
    </h1>

	<?php if ( ! isset( $_GET['yith-phpinfo'] ) || $_GET['yith-phpinfo'] != 'true' ): ?>

        <table class="widefat striped">
			<?php foreach ( $system_info['system_info'] as $key => $item ): ?>
				<?php
				$to_be_enabled = strpos( $key, '_enabled' ) !== false;
				$has_errors    = isset( $item['errors'] );
				$has_warnings  = false;

				if ( $key == 'wp_memory_limit' && ! $has_errors ) {
					$has_warnings = $item['value'] < $recommended_memory;
				}

				?>
                <tr>
                    <th class="requirement-name">
						<?php echo $labels[ $key ]; ?>
                    </th>
                    <td class="requirement-value <?php echo( $has_errors ? 'has-errors' : '' ) ?> <?php echo( $has_warnings ? 'has-warnings' : '' ) ?>">
                        <span class="dashicons dashicons-<?php echo( $has_errors || $has_warnings ? 'warning' : 'yes' ) ?>"></span>

						<?php if ( $to_be_enabled ) {
							echo $item['value'] ? __( 'Enabled', 'yith-plugin-fw' ) : __( 'Disabled', 'yith-plugin-fw' );
						} elseif ( $key == 'wp_memory_limit' ) {
							echo esc_html( size_format( $item['value'] ) );
						} else {
							echo $item['value'];
						} ?>

                    </td>
                    <td class="requirement-messages">
						<?php if ( $has_errors ) : ?>
                            <ul>
								<?php foreach ( $item['errors'] as $plugin => $requirement ) : ?>
                                    <li>
										<?php if ( $to_be_enabled ) {
											echo sprintf( __( '%s needs %s enabled', 'yith-plugin-fw' ), '<b>' . $plugin . '</b>', '<b>' . $labels[ $key ] . '</b>' );
										} elseif ( $key == 'wp_memory_limit' ) {
											echo sprintf( __( '%s needs at least %s of available memory', 'yith-plugin-fw' ), '<b>' . $plugin . '</b>', '<span class="error">' . esc_html( size_format( YITH_System_Status()->memory_size_to_num( $requirement ) ) ) . '</span>' );
											echo '<br/>';
											echo sprintf( __( 'For optimal functioning of our plugins, we suggest setting at least %s of available memory', 'yith-plugin-fw' ), '<span class="error">' . esc_html( size_format( YITH_System_Status()->memory_size_to_num( $recommended_memory ) ) ) . '</span>' );

										} else {
											echo sprintf( __( '%s needs at least %s version', 'yith-plugin-fw' ), '<b>' . $plugin . '</b>', '<span class="error">' . $requirement . '</span>' );
										} ?>
                                    </li>
								<?php endforeach; ?>
                            </ul>
							<?php switch ( $key ) {

								case 'min_wp_version':
								case 'min_wc_version':
									echo __( 'Update it to the latest version in order to benefit of all new features and security updates.', 'yith-plugin-fw' );
									break;
								case 'min_php_version':
								case 'min_tls_version':
								case 'imagick_version':
									echo __( 'Contact your hosting company in order to update it.', 'yith-plugin-fw' );
									break;
								case 'wp_cron_enabled':
									echo sprintf( __( 'Remove %s from %s file', 'yith-plugin-fw' ), '<code>define( \'DISABLE_WP_CRON\', true );</code>', '<b>wp-config.php</b>' );
									break;
								case 'mbstring_enabled':
								case 'simplexml_enabled':
								case 'gd_enabled':
								case 'iconv_enabled':
								case 'opcache_enabled':
								case 'url_fopen_enabled':
									echo __( 'Contact your hosting company in order to enable it.', 'yith-plugin-fw' );
									break;
								case 'wp_memory_limit':
									echo sprintf( __( 'Read more %s here%s or contact your hosting company in order to increase it.', 'yith-plugin-fw' ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">', '</a>' );
									break;
								default:
									echo apply_filters( 'yith_system_generic_message', '', $item );

							} ?>
						<?php endif; ?>

						<?php if ( $has_warnings ) : ?>
                            <ul>
                                <li>
									<?php echo sprintf( __( 'For optimal functioning of our plugins, we suggest setting at least %s of available memory', 'yith-plugin-fw' ), '<span class="warning">' . esc_html( size_format( YITH_System_Status()->memory_size_to_num( $recommended_memory ) ) ) . '</span>' ); ?>
                                </li>
                            </ul>
							<?php echo sprintf( __( 'Read more %s here%s or contact your hosting company in order to increase it.', 'yith-plugin-fw' ), '<a href="https://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">', '</a>' ); ?>
						<?php endif; ?>
                    </td>
                </tr>
			<?php endforeach; ?>
        </table>

        <a href="<?php echo add_query_arg( array( 'yith-phpinfo' => 'true' ) ) ?> "><?php _e( 'Show full PHPInfo', 'yith-plugin-fw' ) ?></a>

	<?php else : ?>

        <a href="<?php echo add_query_arg( array( 'yith-phpinfo' => 'false' ) ) ?> "><?php _e( 'Back to System panel', 'yith-plugin-fw' ) ?></a>

		<?php

		ob_start();
		phpinfo( 61 );
		$pinfo = ob_get_contents();
		ob_end_clean();

		$pinfo = preg_replace( '%^.*<div class="center">(.*)</div>.*$%ms', '$1', $pinfo );
		$pinfo = preg_replace( '%(^.*)<a name=\".*\">(.*)</a>(.*$)%m', '$1$2$3', $pinfo );
		$pinfo = str_replace( '<table>', '<table class="widefat striped yith-phpinfo">', $pinfo );
		$pinfo = str_replace( '<td class="e">', '<th class="e">', $pinfo );
		echo $pinfo;

		?>

        <a href="#yith-sysinfo"><?php _e( 'Back to top', 'yith-plugin-fw' ) ?></a>

	<?php endif; ?>
</div>