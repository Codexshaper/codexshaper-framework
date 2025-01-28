<?php
/**
 * Nav-Menu Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div <?php echo wp_kses_post( $wrapper ?? '' ); ?>>
	<?php if ( $show_mobile_menu ) : ?>
		<button type="button" class="cxf-menu-hamburger" aria-label="Offcanvas Button" data-breakpoint="<?php echo esc_attr( $breakpoint ); ?>" data-id="<?php echo esc_attr( $id ); ?>">
			<?php echo wp_kses( $menu_hamburger_icon, cxf_get_svg_rules() ); ?>
		</button>
	<?php endif; ?>
	<?php
	// PHPCS - escaped by WordPress with "wp_nav_menu".
	echo $menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</div>
<?php if ( 'yes' === $settings['show_mobile_menu'] ) : ?>
	<div class="cxf-menu-overlay"></div>
<?php endif; ?>
