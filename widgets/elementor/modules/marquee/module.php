<?php
/**
 * Module module file
 *
 * @category   Module
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Marquee;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use CodexShaper\Framework\Foundation\Elementor\Module as BaseModule;

/**
 * Module module class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Module extends BaseModule {

	/**
	 * Get module name.
	 *
	 * Retrieve the module name.
	 *
	 * @since 1.7.0
	 * @access public
	 *
	 * @return string Module name.
	 */
	public function get_name() {
		return 'cxf--marquee';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Marquee',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/cxf--marquee.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			'cxf--marquee',
			$this->get_css_assets_url( 'cxf--marquee', null, true, true ),
			array( 'cxf-eb-swiper' ),
			CXF_VERSION
		);
	}

	/**
	 * Register scripts.
	 *
	 * @return void
	 */
	public function register_scripts() {
		$widget_js_file = CXF_PATH . 'widgets/elementor/assets/js/cxf--marquee.min.js';
		$version        = filemtime( $widget_js_file );
		wp_register_script(
			'cxf--marquee',
			$this->get_js_assets_url( 'cxf--marquee', null, true, true ),
			array(),
			$version,
			array( 'in_footer' => true )
		);
	}
}
