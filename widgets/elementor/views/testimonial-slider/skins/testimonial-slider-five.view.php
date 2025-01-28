<?php
/**
 * Testimonial_Five Widget View file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
?>

<section class="cdx-testimonial-area-9">
	<div <?php $parent->print_render_attribute_string( 'slider-wrapper' ); ?>>
		<div class="swiper-wrapper">
			<?php if ( ! empty( $settings['items'] ) ) : ?>
				<?php foreach ( $settings['items'] as $key => $item ) : ?>
					<div class="swiper-slide cdx-testimonial-slide-9">
						<div class="cdx-client-wrap">
							<?php if ( ! empty( $item['testimonial_author_image']['url'] ) ) : ?>
								<?php echo wp_kses_post( $author_size_image[ $key ] ); ?>
							<?php endif; ?>
						</div>
						<?php if ( ! empty( $item['testimonial_description'] ) ) : ?>
							<p class="cdx-content"><?php echo esc_html( $item['testimonial_description'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $item['testimonial_name'] ) ) : ?>
							<h2 class="cdx-name"><?php echo esc_html( $item['testimonial_name'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $item['testimonial_designation'] ) ) : ?>
							<h3 class="cdx-designation"><?php echo esc_html( $item['testimonial_designation'] ); ?></h3>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="cdx-navigation-wrap-9">
			<?php if ( ! empty( $settings['button_control'] ) && 'yes' === $settings['button_control'] ) : ?>
				<div class="cdx-prev-btn cdx-btn-navigation cxf--arrow-prev">PREV</div>
				<div class="cdx-next-btn cdx-btn-navigation cxf--arrow-next">NEXT</div>
			<?php endif; ?>
		</div>
	</div>
</section>
