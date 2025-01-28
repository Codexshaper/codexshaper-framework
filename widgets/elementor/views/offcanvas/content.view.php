<?php
/**
 * Offcanvas Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div <?php echo wp_kses_post( $wrapper ?? '' ); ?>>
	<div class="cxf--offcanvas-style">"
		<?php echo $render_header; ?>
		<div class="cxf--offcanvas-content-wrap">
			<?php echo $render_contact_content; ?>
			<?php echo $render_menu; ?>
		</div>
	</div>
</div>