<?php
/**
 * Helper functions file
 *
 * @category   Helper
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

if ( ! function_exists( 'cxf_get_svg_rules' ) ) {

	/**
	 * Get svg rules
	 *
	 * @return array The svg rules.
	 */
	function cxf_get_svg_rules() {

		return array_merge(
			// Default option.
			wp_kses_allowed_html( 'post' ),
			// SVG options.
			array(
				'svg'   => array(
					'class'           => true,
					'aria-hidden'     => true,
					'aria-labelledby' => true,
					'role'            => true,
					'xmlns'           => true,
					'width'           => true,
					'height'          => true,
					'viewbox'         => true,
					'fill'            => true,
				),
				'g'     => array(
					'fill' => true,
					'id'   => true,
				),
				'title' => array( 'title' => true ),
				'path'  => array(
					'd'               => true,
					'fill'            => true,
					'id'              => true,
					'stroke'          => true,
					'stroke-width'    => true,
					'stroke-linecap'  => true,
					'stroke-linejoin' => true,
				),

			),
		);
	}
}