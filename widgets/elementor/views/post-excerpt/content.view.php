<?php
/**
 * Post-excerp Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

echo wp_kses_post(
	sprintf(
		'%1$s %2$s %3$s',
		'<div class="cxf-post-excerpt">',
		$excerpt,
		'</div>'
	)
);
