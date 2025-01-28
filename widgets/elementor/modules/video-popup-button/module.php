<?php
/**
 * Module module file
 *
 * @category   Module
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\VideoPopupButton;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use CodexShaper\Framework\Foundation\Elementor\Module as BaseModule;

/**
 * Module module class
 *
 * @category   Class
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
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
		return 'cxf--eb-module-video-popup-button';
	}

	/**
	 * Get asset base url
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_assets_base_url(): string {
		return CXF_URL . 'widgets/elementor/';
	}
	
	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Video_Popup_Button',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/dioexpress-eb-cxf--eb-widget-video-popup-button.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			'cxf--eb-widget-video-popup-button',
			$this->get_css_assets_url( 'cxf--eb-widget-video-popup-button', null, true, true ),
			array( 'cxf-eb-magnefic' ),
			CXF_VERSION
		);
	}

	/**
	 * Register scripts.
	 *
	 * `/assets/js/cxf--eb-widget-video-popup-button.min.js`.
	 *
	 * @return void
	 */
	public function register_scripts() {
		wp_register_script(
			'cxf--eb-widget-video-popup-button',
			$this->get_js_assets_url( 'cxf--eb-widget-video-popup-button', null, true, true ),
			array( 'cxf-eb-magnefic' ),
			CXF_VERSION,
			array( 'in_footer' => true )
		);
	}
}
