<?php
/**
 * Slider Widget file
 *
 * @category   Slider
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Elementor;

use CodexShaper\Framework\Controls\Elementor\SliderGroupControl;
use CodexShaper\Framework\Foundation\Traits\Slider\SliderHelper;
use Elementor\Controls_Manager;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Slider widget class for element bucket
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
abstract class SliderWidget extends QueryWidget {

	use SliderHelper;

	/**
	 * Register Elementor widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_slider',
			array(
				'label' => esc_html__( 'Slider', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_group_control(
			SliderGroupControl::get_type(),
			array(
				'name'    => $this->slider_control_prefix,
				'exclude' => array(),
			)
		);

		$this->end_controls_section();
	}
}
