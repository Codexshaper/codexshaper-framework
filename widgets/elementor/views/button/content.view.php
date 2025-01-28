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
<div <?php echo $button_wrapper; ?>>
	<?php echo $button_opening_tag; ?>
	<?php if (empty($settings['cxf_button_icon_align']) || 'left' === $settings['cxf_button_icon_align']) : ?>
		<span class="cxf--btn_icon">
			<?php echo $icon_Html; ?>
		</span>
	<?php endif; ?>
	<?php echo $settings['cxf_button_text']; ?>
	<?php if ('right' === $settings['cxf_button_icon_align']) : ?>
		<span class="cxf--btn_icon">
			<?php echo $icon_Html; ?>
		</span>
	<?php endif; ?>
	<?php echo $button_closing_tag; ?>
</div>