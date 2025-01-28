<?php
/**
 * Marquee Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div <?php echo wp_kses_post( $sliderWrapperAttributes ?? '' ); ?>>
	<div class="swiper-wrapper">
		<?php
		foreach ($items as $key => $item) :
		?>
			<div class="swiper-slide cxf--marquee-item">
				<div class="cxf--marquee-wrapper">
					<?php if ($item['marquee_image'] && ! empty($item['marquee_image']['url'])) : ?>
						<div class="cxf--marquee-image-wrapper">
							<?php echo wp_kses_post( $marquee_size_image[$key] ?? '' ); ?>
						</div>
					<?php endif; ?>
					<?php if ($item['marquee_text']) : ?>
						<h3 class="cxf--marquee-text"><?php echo esc_html($item['marquee_text']); ?></h3>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php if ('yes' === $settings['allow_pagination']) : ?>
		<div class="cdx-portfolio-pagination swiper-pagination"></div>
	<?php endif; ?>
</div>