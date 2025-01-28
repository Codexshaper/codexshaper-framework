<?php
/**
 * Post-Commenta Widget alert View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="cxf-alert cxf-alert-danger" role="alert">
	<span class="cxf-alert-title">
		<?php esc_html_e('Comments are closed.', 'codexshaper-framework'); ?>
	</span>
	<span class="cxf-alert-description">
		<?php esc_html_e('Switch on comments from either the discussion box on the WordPress post edit screen or from the WordPress discussion settings.', 'codexshaper-framework'); ?>
	</span>
</div>