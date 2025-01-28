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

namespace CodexShaper\Framework\Widgets\Elementor\Modules\SocialShare;

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
		return 'cxf--social-share';
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_widgets() {
		return array(
			'Social_Share',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/cxf--social-share.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		$widget_css_file = CXF_PATH . 'widgets/elementor/assets/css/cxf--social-share.min.css';
		$version         = file_exists( $widget_css_file ) ? filemtime( $widget_css_file ) : CXF_VERSION;
		wp_register_style(
			'cxf--social-share',
			$this->get_css_assets_url( 'cxf--social-share', null, true, true ),
			array(),
			$version
		);
	}

	/**
	 * Register scripts.
	 *
	 * `/assets/js/cxf--social-share.min.js`.
	 *
	 * @return void
	 */
	public function register_scripts() {
		$widget_js_file = CXF_PATH . 'widgets/elementor/assets/js/cxf--social-share.min.js';
		$version        = file_exists( $widget_js_file ) ? filemtime( $widget_js_file ) : CXF_VERSION;
		wp_register_script(
			'cxf--social-share',
			$this->get_js_assets_url( 'cxf--social-share', null, true, true ),
			array( 'elementor-frontend' ),
			$version,
			true
		);
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[] The module's associated widgets.
	 * @param string $name The network name.
	 */
	public static function get_networks( $name = null ) {

		$networks = cxf_config( 'social.networks' ) ?? array();

		return $networks[ $name ] ?? $networks;
	}

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[] The module's associated widgets.
	 * @param mixed $networks_names Network Name.
	 */
	public static function get_options( $networks_names = array() ) {

		$networks = static::get_networks();

		if ( empty( $networks_names ) ) {
			$networks_names = array_keys( $networks );
		}

		return array_reduce(
			$networks_names,
			function ( $options, $name ) use ( $networks ) {
				$options[ $name ] = $networks[ $name ]['title'] ?? '';
				return $options;
			},
			array()
		);
	}
}
