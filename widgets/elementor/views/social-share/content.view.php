<?php
/**
 * Social-Share Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div <?php echo wp_kses_post( $wrapper_attr ); ?>>
	<?php if (! empty($title_html)) : ?>
		<?php wp_kses_post( $title_html ); ?>
	<?php endif; ?>

	<div <?php echo wp_kses_post( $content_wrapper_attr ); ?>>
		<?php foreach ($social_share_items as $key => $item) : ?>
			<div <?php echo wp_kses_post( $item['wrapper_attr'] ); ?>>
				<div <?php echo wp_kses_post( $item['item_attr'] ); ?>>
					<?php if ($item['has_icon']) : ?>
						<span class="cxf--social-share-item-icon">
							<?php echo wp_kses( $share_icons[$key], cxf_get_svg_rules() ); ?>
						</span>
					<?php endif; ?>
					<?php if (($item['is_show_label']) || ($item['has_counter'])) : ?>
						<div class="cxf--social-share-item-content">
							<?php if ($item['is_show_label']) : ?>
								<span class="cxf--social-share-item-title">
									<?php echo $item['text'] ? esc_html($item['text']) : wp_kses_post($item['title']); ?>
								</span>
							<?php endif; ?>
							<?php if ($item['has_counter']) : ?>
								<span class="cxf--social-share-item-counter" data-counter="<?php echo esc_attr($item['network_name']); ?>"></span>
							<?php endif; ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>