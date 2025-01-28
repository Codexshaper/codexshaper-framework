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

namespace CodexShaper\Framework\Widgets\Elementor\Modules\NavMenu;

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
		return 'cxf--nav-menu';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Nav_Menu',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/cxf--nav-menu.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		$widget_css_file = CXF_PATH . 'widgets/elementor/assets/css/cxf--nav-menu.min.css';
		$version         = file_exists( $widget_css_file ) ? filemtime( $widget_css_file ) : CXF_VERSION;
		wp_register_style(
			'cxf--nav-menu',
			$this->get_css_assets_url( 'cxf--nav-menu', null, true, true ),
			array(),
			$version,
		);

		wp_enqueue_style( 'cxf--nav-menu' );
	}

	/**
	 * Register scripts.
	 *
	 * @return void
	 */
	public function register_scripts() {
		$widget_js_file = CXF_PATH . 'widgets/elementor/assets/js/cxf--nav-menu.min.js';
		$version        = file_exists( $widget_js_file ) ? filemtime( $widget_js_file ) : CXF_VERSION;
		wp_register_script(
			'cxf--nav-menu',
			$this->get_js_assets_url( 'cxf--nav-menu', null, true, true ),
			array(),
			true,
			$version,
		);
	}
}
