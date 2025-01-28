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

namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use CodexShaper\Framework\Foundation\Elementor\Module as BaseModule;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Five;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Four;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Seven;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Six;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Three;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Two;

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
		return 'cxf--eb-module-testimonial-slider';
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
			'Testimonial_Slider',
		);
	}

	/**
	 * Register styles.
	 *
	 * `/assets/css/dioexpress-eb-cxf--eb-widget-testimonial-slider.min.css`.
	 *
	 * @return void
	 */
	public function register_styles() {
		$widget_css_file =CXF_PATH. 'widgets/elementor/assets/css/cxf--eb-widget-testimonial-slider.min.css';
		$version = file_exists( $widget_css_file ) ? filemtime( $widget_css_file ) : CXF_VERSION;
		wp_register_style(
			'cxf--eb-widget-testimonial-slider',
			$this->get_css_assets_url( 'cxf--eb-widget-testimonial-slider', null, true, true ),
			array( 'cxf-eb-swiper' ),
			$version
		);
	}

	/**
	 * Register scripts.
	 *
	 * `/assets/js/cxf--eb-widget-testimonial-slider.min.js`.
	 *
	 * @return void
	 */
	public function register_scripts() {
		$widget_js_file =CXF_PATH. 'widgets/elementor/assets/js/cxf--eb-widget-testimonial-slider.min.js';
		$version = file_exists( $widget_js_file ) ? filemtime( $widget_js_file ) : CXF_VERSION;
		wp_register_script(
			'cxf--eb-widget-testimonial-slider',
			$this->get_js_assets_url( 'cxf--eb-widget-testimonial-slider', null, true, true ),
			array( 'cxf-eb-swiper' ),
			$version,
			array( 'in_footer' => true )
		); 
	}

	/**
	 * Register skins.
	 *
	 * @return array
	 */
	public function register_skins() {
		add_filter( "cxf/widget/skins_init", function( $skins ) {
			$skins['cxf--eb-module-testimonial-slider'] = [
				Skin_Testimonial_Two::class,
				Skin_Testimonial_Three::class,
				Skin_Testimonial_Four::class,
				Skin_Testimonial_Five::class,
				Skin_Testimonial_Six::class,
				Skin_Testimonial_Seven::class,
			];
			return $skins;
		});
    }
}
