<?php
/**
 * Module Service Provider File
 *
 * @category   ServiceProvider
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://codexshaper.com
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Providers\Elementor;

use CodexShaper\Framework\Controls\Elementor\SliderGroupControl;
use CodexShaper\Framework\Foundation\ServiceProvider;
use Elementor\Group_Control_Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *  Module Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://codexshaper.com
 * @since      1.0.0
 */
class ControlServiceProvider extends ServiceProvider {

	/**
	 * Get the module's associated widgets.
	 *
	 * @return string[]
	 */
	public function get_controls() {
		return array(
			SliderGroupControl::class,
		);
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot() {
		// Booted code
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'elementor/controls/register', array( $this, 'register_controls' ) );
	}

	/**
	 * Regsiter controls for current module.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param Controls_Manager|Gr $controls_manager The control manager.
	 *
	 * @return mixed
	 */
	public function register_controls( $controls_manager ) {

		foreach ( $this->get_controls() as $control ) {
			$instance = new $control();

			if ( $instance instanceof Group_Control_Base ) {
				$controls_manager->add_group_control( $control::get_type(), $instance );
				continue;
			}
			$controls_manager->register( $instance );
		}
	}
}
