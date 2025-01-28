<?php
/**
 * Offcanvas Widget Offcanvas_Skin_One file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Offcanvas\Skins;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Skin Offcanvas_One class.
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since
 * @since 1.0.0
 */
class Skin_Offcanvas_One extends Skin_Offcanvas_Base {

	/**
	 * Get skin ID.
	 *
	 * Retrieve the skin ID.
	 *
	 * @since 1.0.0
	 * @access public
	 * @abstract
	 */
	public function get_id() {
		return 'skin-offcanvas-one';
	}

	/**
	 * Get skin title.
	 *
	 * Retrieve the skin title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @abstract
	 */
	public function get_title() {
		return __( 'Offcanvas One', 'codexshaper-framework' );
	}

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
		parent::_register_controls_actions();

		add_action( 'elementor/element/cxf--portfolio/section_layout/before_section_end', array( $this, 'inject_layout_controls' ) );
	}

	/**
	 * Inject layout controls.
	 *
	 * Used to add different layout options to the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function inject_layout_controls() {
		$this->parent->start_injection(
			array(
				'at' => 'before',
				'of' => 'button_type',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default'     => array(
					'value'   => 'fas fa-long-arrow-alt-right',
					'library' => 'fa-solid',
				),
				'label_block' => false,
			)
		);

		$this->parent->end_injection();
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 * @param Widget_Base $widget The current widget instance.
	 */
	public function register_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render() {

		echo esc_html( 'Offcanvas One' );
	}
}
