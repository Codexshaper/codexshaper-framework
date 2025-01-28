<?php
/**
 * Video_Popup_Button Widget file
 *
 * @category   Widget
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\VideoPopupButton\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Video_Popup_Button widget class
 *
 * @category   Class
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
 * @since      1.0.0
 */
class Video_Popup_Button extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--eb-widget-video-popup-button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Video Popup Button', 'codexshaper-framework' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-play';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Video Popup Button', 'Video Popup', 'Popup Button', 'CodexShaper', 'Element Bucket' );
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'cxf--widget' );
	}

	/**
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends(): array {
		return array( 'cxf--eb-widget-video-popup-button', 'cxf-eb-magnefic' );
	}

	/**
	 * Get script dependencies.
	 *
	 * Retrieve the list of script dependencies the element requires.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Element scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'cxf-eb-magnefic', 'cxf--eb-widget-video-popup-button' );
	}

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
			'settings_section',
			array(
				'label' => __( 'General Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'play_btn_icon',
			array(
				'label'   => esc_html__( 'Button Icon', 'codexshaper-framework' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-play',
					'library' => 'fa-solid',
				),
			)
		);
		$this->add_control(
			'video-url',
			array(
				'label'       => __( 'Video url', 'codexshaper-framework' ),
				'type'        => Controls_Manager::URL,
				'options'     => array( 'url' ),
				'default'     => array(
					'url' => '#',
				),
				'label_block' => true,
			)
		);
		$this->add_control(
			'animation_control',
			array(
				'label'        => __( 'Button Animation', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'codexshaper-framework' ),
				'label_off'    => __( 'No', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->end_controls_section();

		// Style tab start.
		$this->start_controls_section(
			'styling_section',
			array(
				'label' => __( 'Styling', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'play_icon_width',
			array(
				'label'      => esc_html__( 'Icon Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 32,
				),
				'selectors'  => array(
					'{{WRAPPER}} .video-popup-btn svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);
		$this->add_responsive_control(
			'btn_icon_color',
			array(
				'label'     => __( 'Button Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .video-popup-btn svg path' => 'fill: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'btn_background_color',
			array(
				'label'     => __( 'Button Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .video-popup-btn' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'btn_width',
			array(
				'label'      => esc_html__( 'Button Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 55,
				),
				'selectors'  => array(
					'{{WRAPPER}} .video-popup-btn' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'btn_height',
			array(
				'label'      => esc_html__( 'Button Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 55,
				),
				'selectors'  => array(
					'{{WRAPPER}} .video-popup-btn' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => esc_html__( 'Button Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .video-popup-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'btn_icon_hover_color',
			array(
				'label'     => __( 'Button Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .video-popup-btn:hover svg path' => 'fill: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_responsive_control(
			'btn_background_hover-color',
			array(
				'label'     => __( 'Button Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .video-popup-btn:hover' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->end_controls_tabs();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render Elementor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['play_btn_icon'] ) ) {
			$play_btn_icon = Icons_Manager::try_get_icon_html(
				$settings['play_btn_icon'],
				array(
					'aria-hidden' => 'true',
					'fill'        => ! empty( $settings['btn_icon_color'] ) ? $settings['btn_icon_color'] : 'currentColor',
					'width'       => ! empty( $settings['play_icon_width']['size'] ) ? $settings['play_icon_width']['size'] . $settings['play_icon_width']['unit'] : '16',
				)
			);
		}
		$data = array(
			'settings'      => $settings,
			'play_btn_icon' => $play_btn_icon,
		);
		cxf_view( 'video-popup-button.content', $data );
	}
}
