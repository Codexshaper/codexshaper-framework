<?php
/**
 * Offcanvas Widget Button View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>

<button class="cdx-btn-open" aria-label="Open Button">
	<?php
	if ('text' == $settings['button_type']) :
	?>
		<span class="cdx-btn-text">
			<?php echo esc_html($settings['menu_button_text']); ?>
		</span>
	<?php endif; ?>
	<?php if ('icon' === $settings['button_type']) : ?>
		<?php echo wp_kses($menu_icon, cxf_get_svg_rules()); ?>
	<?php endif; ?>
</button>