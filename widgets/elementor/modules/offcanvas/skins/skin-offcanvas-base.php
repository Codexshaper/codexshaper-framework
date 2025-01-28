<?php
/**
 * Offcanvas Widget Offcanvas_Skin_Base file
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Offcanvas\Skins;

use Elementor\Skin_Base;
use Elementor\Widget_Base;

/**
 * Skin Offcanvas_Skin_Base class.
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since
 * @since 1.0.0
 */
abstract class Skin_Offcanvas_Base extends Skin_Base {

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
	 * @return void
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
	 * @param Widget_Base $widget The widget object.
	 * @return void
	 * @access protected
	 */
	public function register_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}
}
