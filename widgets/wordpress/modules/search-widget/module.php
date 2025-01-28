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

namespace CodexShaper\Framework\Widgets\Wordpress\Modules\SearchWidget;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use CodexShaper\Framework\Foundation\Module as ModuleBase;

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
class Module extends ModuleBase {

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
		return 'cxf-wp-module-search-widget';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Search_Widget',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/cxf-wp-widget-search-widget.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			'cxf-wp-widget-search-widget',
			$this->get_css_assets_url( 'cxf-wp-widget-search-widget', null, true, true ),
			array(),
			CXF_VERSION
		);
	}
}
