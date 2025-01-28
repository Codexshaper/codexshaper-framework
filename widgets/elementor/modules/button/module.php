<?php
/**
 * Module module file
 *
 * @category   Module
 * @package    codexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Button;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use CodexShaper\Framework\Foundation\Elementor\Module as BaseModule;

/**
 * Module module class
 *
 * @category   Class
 * @package    codexShaper_Framework
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
		return 'cxf--button-module';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Button',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/eb-widget-button.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			'cxf--button',
			$this->get_css_assets_url( 'cxf--button', null, true, true ),
			array(),
			CXF_VERSION
		);
	}
}
