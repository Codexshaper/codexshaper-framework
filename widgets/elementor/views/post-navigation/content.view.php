<?php
/**
 * Post-navigation Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<nav <?php echo wp_kses_post( $post_navigation_wrapper ?? '' ); ?>>
	<?php if ( $has_prev ) : ?>
		<div <?php echo wp_kses_post( $post_prev_link_wrapper ); ?>>
			<a href="<?php echo esc_url( $prev_permalink ); ?>" aria-label="Previous post link">
				<?php if ( 'top' === $title_position ) : ?>
					<?php
					echo wp_kses(
						$post_prev_title,
						array(
							'h4' => array(
								'class' => array(),
							),
						)
					);
					?>
				<?php endif; ?>
				<span class="next-prev">
					<?php echo wp_kses( $prev_icon, cxf_get_svg_rules() ); ?>
					<?php echo esc_html( $post_prev_label ); ?>
				</span>
				<?php if ( 'bottom' === $title_position ) : ?>
					<p>
						<?php
						echo wp_kses(
							$post_prev_title,
							array(
								'h4' => array(
									'class' => array(),
								),
							)
						);
						?>
					</p>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( $has_next ) : ?>
		<div <?php echo wp_kses_post( $post_next_link_wrapper ); ?> class="cxf--post-next">
			<a href="<?php echo esc_url( $next_permalink ); ?>" aria-label="Next post link">
				<?php if ( 'top' === $title_position ) : ?>
					<?php
					echo wp_kses(
						$post_next_title,
						array(
							'h4' => array(
								'class' => array(),
							),
						)
					);
					?>
				<?php endif; ?>
				<span class="next-prev">
					<?php echo esc_html( $post_next_label ); ?>
					<?php echo wp_kses( $next_icon, cxf_get_svg_rules() ); ?>
				</span>
				<?php if ( 'bottom' === $title_position ) : ?>
					<p>
						<?php
						echo wp_kses(
							$post_next_title,
							array(
								'h4' => array(
									'class' => array(),
								),
							)
						);
						?>
					</p>
				<?php endif; ?>
			</a>
		</div>
	<?php endif; ?>
</nav>
