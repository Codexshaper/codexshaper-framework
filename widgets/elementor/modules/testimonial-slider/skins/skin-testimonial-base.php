<?php
/**
 * Skin_Service_Slider_Base Skin file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins;

use CodexShaper\Framework\Foundation\Traits\Image\Helper as ImageHelper;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Widgets\Testimonial_Slider;
use Elementor\Skin_Base;

/**
 * Skin_Service_Slider_Base Skin Class
 *
 * @category   Class
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
abstract class Skin_Testimonial_Base extends Skin_Base {

	use ImageHelper;

	/**
	 * Register skin controls actions.
	 *
	 * Run on init and used to register new skins to be injected to the widget.
	 * This method is used to register new actions that specify the location of
	 * the skin in the widget.
	 *
	 * Example usage:
	 * `add_action( 'elementor/element/{widget_id}/{section_id}/before_section_end', [ $this, 'register_controls' ] );`
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls_actions() {
		add_action( 'elementor/element/cxf--post/section_layout/after_section_end', array( $this, 'register_controls' ) );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	public function register_controls( Testimonial_Slider $widget ) {
		$this->parent = $widget;
	}
}
