<?php
/**
 * Offcanvas Button Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div <?php echo wp_kses_post( $button_wrapper ?? '' ); ?>>
	<?php echo wp_kses_post( $button_opening_tag ?? '' ); ?>
	<?php if (empty($settings['cxf_button_icon_align']) || 'left' === $settings['cxf_button_icon_align']) : ?>
		<span class="cxf--btn_icon">
			<?php echo wp_kses( $icon_Html, cxf_get_svg_rules() ); ?>
		</span>
	<?php endif; ?>
	<?php echo esc_html( $settings['cxf_button_text'] ); ?>
	<?php if ('right' === $settings['cxf_button_icon_align']) : ?>
		<span class="cxf--btn_icon">
			<?php echo wp_kses( $icon_Html, cxf_get_svg_rules() ); ?>
		</span>
	<?php endif; ?>
	<?php echo wp_kses_post( $button_closing_tag ?? '' ); ?>
</div>