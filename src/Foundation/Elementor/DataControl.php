<?php
/**
 * Data Control file
 *
 * @category   Base
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Elementor;

use Elementor\Base_Data_Control;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Data Control class for element bucket
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
abstract class DataControl extends Base_Data_Control {

	/**
	 * Get default control settings.
	 *
	 * Retrieve the default settings of the control. Used to return the default
	 * settings while initializing the control.
	 *
	 * @since 1.5.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return array();
	}

	/**
	 * Get default value
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_default_value() {}

	/**
	 * Content template
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function content_template() {}

	/**
	 * Enqueue control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles used by the control.
	 *
	 * @since 1.5.0
	 * @access public
	 */
	public function enqueue() {}

	/**
	 * Widget activation
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function is_active() {
		return true;
	}
}
