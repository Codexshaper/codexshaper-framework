<?php
/**
 * Testimonial_Six Widget View file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
?>

<section class="cdx-testimonial-area-4" 
<?php
if ( ! empty( $settings['background_image']['url'] ) ) :
	?>
	style="background-image: url('<?php echo esc_url( $bg_img_url ); ?>');" <?php endif; ?>>
	<div class="row g-0 align-items-center">
		<div class="col-xl-6 col-lg-12">
			<div <?php $parent->print_render_attribute_string( 'thumb-slider-wrapper' ); ?>>
				<div class="swiper-wrapper">
					<?php
					if ( ! empty( $settings['items'] ) ) :
						foreach ( $settings['items'] as $key => $item ) :
							?>
							<div class="swiper-slide">
								<div class="cdx-testimonial-thumbslide-4">
									<?php if ( ! empty( $item['testimonial_author_image']['url'] ) ) : ?>
										<?php echo wp_kses_post( $author_size_image[ $key ] ); ?>
									<?php endif; ?>
								</div>
							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-12">
			<div class="cdx-right position-relative">
				<div <?php $parent->print_render_attribute_string( 'slider-wrapper' ); ?>>
					<div class="swiper-wrapper">
						<?php
						if ( ! empty( $settings['items'] ) ) :
							foreach ( $settings['items'] as $item ) :
								?>
								<div class="swiper-slide cdx-testimonial-item-4">
									<div class="cdx-review">
										<?php for ( $i = 0; $i < $item['rating_count_testimonial']; $i++ ) { ?>
											<span class="cdx-icon">
												<?php echo wp_kses( $star_icon, cxf_get_svg_rules() ); ?>
											</span>
										<?php } ?>
									</div>
									<?php if ( ! empty( $item['testimonial_title'] ) ) : ?>
										<h2 class="cdx-name"><?php echo esc_html( $item['testimonial_title'] ); ?></h2>
									<?php endif; ?>
									<?php if ( ! empty( $item['testimonial_description'] ) ) : ?>
										<p class="cdx-content"><?php echo esc_html( $item['testimonial_description'] ); ?></p>
									<?php endif; ?>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
				<!-- Navigation  -->
				<?php if ( 'yes' === $settings['button_control'] ) : ?>
					<div class="cdx-navigation-style-6">
						<div class="cdx-testimonial-next-4 cdx-navigation-btn cxf--arrow-next">
							<span class="cdx-icon">
								<?php echo wp_kses( $previous_btn_icon, cxf_get_svg_rules() ); ?>
							</span>
						</div>
						<div class="cdx-testimonial-prev-4 cdx-navigation-btn cxf--arrow-prev">
							<span class="cdx-icon">
								<?php echo wp_kses( $next_btn_icon, cxf_get_svg_rules() ); ?>
							</span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
