<?php
/**
 * Offcanvas Widget Contact Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="cxf--contact-info-content">
	<?php
	if ('yes' == $settings['show_img'] && ! empty($settings['content_img']['url'])) :
	?>
		<div class="cxf--main-img-wrap">
			<?php echo wp_kses_post( $content_size_image ?? '' ); ?>
		</div>
	<?php endif; ?>
	<?php if (! empty($settings['cta_items'])) : ?>
		<div class="cxf--cta-wrap">
			<?php foreach ($settings['cta_items'] as $key => $cta_item) : ?>
				<p class="cxf-cta-item"><a class="cxf--cta-link" href="<?php echo esc_url($cta_item['cta_link']['url']); ?>"><?php echo esc_html($cta_item['cta_info_text']); ?><?php echo wp_kses( $cta_items_icons[$key], cxf_get_svg_rules() ); ?> </a></p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<?php if (! empty($settings['social_items'])) : ?>
		<div class="cxf--social-wrap">
			<ul class="cxf--social-items">
				<?php foreach ($settings['social_items'] as $key => $social_item) : ?>
					<li class="cxf--social-item"><a class="cxf--social-link" href="<?php echo esc_url($social_item['social_link']['url']); ?>"> <?php echo wp_kses( $social_items_icons[$key], cxf_get_svg_rules() ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
</div>