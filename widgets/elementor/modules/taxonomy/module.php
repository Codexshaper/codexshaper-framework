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

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Taxonomy;

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
		return 'cxf--taxonomy';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Taxonomy',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/cxf--taxonomy.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		$widget_css_file = CXF_PATH . 'widgets/elementor/assets/css/cxf--taxonomy.min.css';
		$version         = file_exists( $widget_css_file ) ? filemtime( $widget_css_file ) : CXF_VERSION;
		wp_register_style(
			'cxf--taxonomy',
			$this->get_css_assets_url( 'cxf--taxonomy', null, true, true ),
			array(),
			$version
		);
	}
}
