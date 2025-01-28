<?php
/**
 * Offcanvas Widget Header View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="cxf--offcanvas-header">
	<a href="<?php echo esc_url($settings['header_logo_link']['url']); ?>">
		<div class="cxf--logo-wrapper">
			<?php if (! empty($settings['header_logo']['url'])) : ?>
				<?php echo wp_kses_post( $logo_size_image ?? '' ); ?>
			<?php endif; ?>
		</div>
	</a>
	<div class="offcanvas-close__button-wrapper offcanvas__close-2 offcanvas--close--button-js">
		<button type="button" class="cxf--close-btn" aria-label="Close Button">
			<?php if ($settings['close_button_text']) : ?>
				<span class="cxf--btn-text"><?php echo esc_html($settings['close_button_text']); ?></span>
			<?php
			endif;
			if ($settings['close_icon_btn']) :
			?>
				<span class="cxf--icon"><?php echo wp_kses( $close_btn_icon , cxf_get_svg_rules() ); ?> </span>
			<?php endif ?>
		</button>
	</div>
</div>