<?php
/**
 * Button Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Button\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // Exit if access directly.
}

/**
 * Button widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Button extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--button';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Button', 'codexshaper-framework' );
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
		return 'eicon-button';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Button', 'CodexShaper', 'CodexShaper_Framework' );
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
		return array( 'cxf--button' );
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
		// General Settings.
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Button', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'cxf_button_type',
			array(
				'label'   => __( 'Type', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'a'      => __( 'link', 'codexshaper-framework' ),
					'button' => __( 'button', 'codexshaper-framework' ),
				),
				'default' => 'a',
			)
		);
		$this->add_control(
			'cxf_button_style',
			array(
				'label'   => __( 'Style', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'default'   => esc_html__( 'Default', 'codexshaper-framework' ),
					'underline' => esc_html__( 'Style Underline', 'codexshaper-framework' ),
					'square'    => esc_html__( 'Style Square', 'codexshaper-framework' ),
					'circle'    => esc_html__( 'Style Circle', 'codexshaper-framework' ),
					'oval'      => esc_html__( 'Style Oval', 'codexshaper-framework' ),
					'ellipse'   => esc_html__( 'Style Ellipse', 'codexshaper-framework' ),
					'mask'      => esc_html__( 'Style Mask', 'codexshaper-framework' ),

				),
				'default' => 'default',
			)
		);
		$this->add_control(
			'cxf_button_effect',
			array(
				'label'     => esc_html__( 'Effect', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''                => esc_html__( 'None', 'codexshaper-framework' ),
					'effect-divide'   => esc_html__( 'Divided Effect', 'codexshaper-framework' ),
					'effect-cross'    => esc_html__( 'Cross Effect', 'codexshaper-framework' ),
					'effect-cropping' => esc_html__( 'Cropping Effect', 'codexshaper-framework' ),
					'sliding-top'     => esc_html__( 'Sliding Top Effect', 'codexshaper-framework' ),
					'sliding-bottom'  => esc_html__( 'Sliding Bottom Effect', 'codexshaper-framework' ),
					'sliding-left'    => esc_html__( 'Sliding Left Effect', 'codexshaper-framework' ),
					'sliding-right'   => esc_html__( 'Sliding Right Effect', 'codexshaper-framework' ),
					'slide-in'        => esc_html__( 'Slide In Effect', 'codexshaper-framework' ),
					'parallal-border' => esc_html__( 'Border Effect', 'codexshaper-framework' ),
					'border-cross'    => esc_html__( 'Border Cross Effect', 'codexshaper-framework' ),
					'fade-left'       => esc_html__( 'Fade Left Effect', 'codexshaper-framework' ),
					'fade-right'      => esc_html__( 'Fade right Effect', 'codexshaper-framework' ),

				),
				'default'   => '',
				'condition' => array(
					'cxf_button_style' => array( 'default', 'square' ),
				),
			)
		);
		$this->add_control(
			'cxf_button_text',
			array(
				'label'       => __( 'Button Text', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Click here', 'codexshaper-framework' ),
				'placeholder' => __( 'Click here', 'codexshaper-framework' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'cxf_button_aria_label',
			array(
				'label'       => __( 'Button Aria Label', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Aria Label Text', 'codexshaper-framework' ),
				'placeholder' => __( 'Aria Label Text', 'codexshaper-framework' ),
				'description' => __( '"Aria Labels" make buttons accessible by describing their purpose to screen readers for better inclusivity', 'codexshaper-framework' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'cxf_button_link',
			array(
				'label'       => __( 'Link', 'codexshaper-framework' ),
				'type'        => Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
				'condition'   => array( 'cxf_button_type' => 'a' ),
			)
		);

		$this->add_responsive_control(
			'cxf_button_align',
			array(
				'label'        => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'      => '',
				'prefix_class' => 'elementor%s-align-',
			)
		);

		$this->add_control(
			'icon_heading',
			array(
				'type'      => Controls_Manager::HEADING,
				'label'     => esc_html__( 'Icon', 'codexshaper-framework' ),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'cxf_button_icon',
			array(
				'label'            => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
			)
		);

		$this->add_control(
			'cxf_button_icon_align',
			array(
				'label'   => esc_html__( 'Icon Position', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Before', 'codexshaper-framework' ),
					'right' => esc_html__( 'After', 'codexshaper-framework' ),
				),
			)
		);

		$this->add_responsive_control(
			'cxf_button_icon_direction',
			array(
				'label'     => esc_html__( 'Direction', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Row - horizontal', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column' => array(
						'title' => esc_html__( 'Column - vertical', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cxf_button_icon_indend',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Button Size Styling.
		$this->start_controls_section(
			'cxf_button_sizing_styling_section',
			array(
				'label' => __( 'Styling', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btn_border',
				'selector'  => '{{WRAPPER}} .cxf--btn > *, {{WRAPPER}} .cxf--btn > *.btn-parallal-border:before, {{WRAPPER}} .cxf--btn > *.btn-parallal-border:after, {{WRAPPER}} .cxf--btn > *.btn-border-cross:before, {{WRAPPER}} .cxf--btn > *.btn-border-cross:after',
				'separator' => 'before',
				'condition' => array( 'cxf_button_style!' => array( 'underline', 'ellipse' ) ),
			)
		);

		$this->add_responsive_control(
			'btn_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn > *:not(.cxf--btn-ellipse, .cxf--btn-circle, .cxf--btn-oval)'               => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cxf--btn > *.btn-parallal-border:before, {{WRAPPER}} .cxf--btn > *.btn-parallal-border:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cxf--btn > *.btn-border-cross:before, {{WRAPPER}} .cxf--btn > *.btn-border-cross:after'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'cxf_button_style!' => array( 'underline', 'circle', 'ellipse', 'oval' ),
				),
			)
		);

		$this->add_responsive_control(
			'btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'vw', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn > *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-mask:after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'cxf_button_shadow',
				'selector'  => '{{WRAPPER}} .cxf--btn > *.btn-hover-none',
				'condition' => array(
					'btn_hover_list' => 'hover-none',
				),
			)
		);

		$this->add_responsive_control(
			'cxf_button_size',
			array(
				'label'      => esc_html__( 'Button Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 20,
						'max'  => 500,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn > *' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'cxf_button_style' => array( 'circle', 'square' ),
				),
			)
		);

		$this->add_control(
			'icon_style_heading',
			array(
				'label'     => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// tabs.
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
			'btn_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 32,
					'unit' => 'px',

				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn > * i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--btn > * svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'btn_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > * i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .cxf--btn > * svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'btn_icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn .cxf--btn_icon ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'btn_icon_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn .cxf--btn_icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_radius',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn .cxf--btn_icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_icon_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'btn_icon_size_hover',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn:hover > * i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--btn:hover > * svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'btn_icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn:hover > * i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .cxf--btn:hover > * svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'btn_icon_bg_color_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn:hover .cxf--btn_icon'   => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_radius_hover',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--btn:hover .cxf--btn_icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'btn_text_heading',
			array(
				'label'     => esc_html__( 'Text', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .cxf--btn > *',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-underline:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-mask:after' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btn_background',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .cxf--btn > *:not(.cxf--btn-mask, .cxf--btn-ellipse), {{WRAPPER}} .cxf--btn > *.cxf--btn-mask:after, {{WRAPPER}} .cxf--btn > *.cxf--btn-ellipse:before',
				'condition' => array( 'cxf_button_style!' => 'underline' ),
			)
		);

		$this->add_control(
			'ellipse_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-ellipse' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'cxf_button_style' => 'ellipse' ),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *:hover, {{WRAPPER}} .cxf--btn > *:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-underline:hover:after'                  => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'btn_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'exclude'   => array( 'image' ),
				'selector'  => '{{WRAPPER}} .cxf--btn > *:not(.cxf--btn-mask, .btn-item, .btn-parallal-border, .btn-border-cross, .cxf--btn-ellipse):after,{{WRAPPER}} .cxf--btn > *:not(.cxf--btn-mask, .btn-item, .btn-parallal-border, .btn-border-cross, .cxf--btn-ellipse):before, {{WRAPPER}} .cxf--btn > *.cxf--btn-mask, {{WRAPPER}} .cxf--btn span, {{WRAPPER}} .cxf--btn .btn-border-cross:hover, {{WRAPPER}} .cxf--btn .btn-parallal-border:hover, {{WRAPPER}} .cxf--btn > *.cxf--btn-ellipse:hover:before,{{WRAPPER}} .cxf--btn > *.btn-hover-none:hover',
				'condition' => array( 'cxf_button_style!' => 'underline' ),
			)
		);

		$this->add_control(
			'ellipse_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *.cxf--btn-ellipse:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array( 'cxf_button_style' => 'ellipse' ),
			)
		);

		$this->add_control(
			'btn_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--btn > *:hover, {{WRAPPER}} .cxf--btn > *:focus, {{WRAPPER}} .cxf--btn > *:hover.btn-parallal-border:before, {{WRAPPER}} .cxf--btn > *:hover.btn-parallal-border:after, {{WRAPPER}} .cxf--btn > *:hover.btn-border-cross:before, {{WRAPPER}} .cxf--btn > *:hover.btn-border-cross:after, {{WRAPPER}} .cxf--btn > *.btn-hover-none:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'btn_border_border!' => '',
					'cxf_button_style!'  => array( 'underline', 'ellipse' ),
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
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
		$link_url = isset( $settings['cxf_button_link'] ) && ! empty( $settings['cxf_button_link'] ) ? $settings['cxf_button_link']['url'] : '#';

		$this->add_render_attribute( 'button_wrapper', 'class', 'cxf--btn' );
		$this->add_render_attribute(
			'link',
			array(
				'class'      => "cxf--btn-{$settings['cxf_button_style']}",
				'aria-label' => "{$settings['cxf_button_aria_label']}",

			)
		);

		if ( 'a' === $settings['cxf_button_type'] ) {
			$this->add_render_attribute( 'link', 'href', $link_url );
		}

		if ( 'right' === $settings['cxf_button_icon_align'] ) {
			$this->add_render_attribute( 'button_wrapper', 'class', 'icon-position-after' );
		}

		if ( '' !== $settings['cxf_button_effect'] ) {
			$this->add_render_attribute( 'link', 'class', "cxf--btn-{$settings['cxf_button_effect']}" );
		}

		if ( 'mask' === $settings['cxf_button_style'] ) {
			$this->add_render_attribute( 'link', 'data-text', $settings['cxf_button_text'] );
		}

		$button_opening_tag = sprintf(
			'<%1$s %2$s>',
			Utils::validate_html_tag( $settings['cxf_button_type'] ),
			$this->get_render_attribute_string( 'link' ),
		);

		$button_closing_tag = sprintf( '</%1$s>', Utils::validate_html_tag( $settings['cxf_button_type'] ) );
		ob_start();
		$this->maybe_render_icon( $settings );
		$icon_html = ob_get_clean();
		$data      = array(
			'settings'           => $settings,
			'button_opening_tag' => $button_opening_tag,
			'button_closing_tag' => $button_closing_tag,
			'icon_Html'          => $icon_html,
			'button_wrapper'     => $this->get_render_attribute_string( 'button_wrapper' ),
		);

		cxf_view( 'button.content', $data );
	}

	/**
	 * Render icon.
	 *
	 * Render button widget icon.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param array $settings widget settings.
	 *
	 * @return void
	 */
	protected function maybe_render_icon( $settings ) {
		$migrated         = isset( $settings['__fa4_migrated']['cxf_button_icon'] );
		$is_new           = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$data['settings'] = $settings;

		if ( $is_new || $migrated ) :
			Icons_Manager::render_icon( $settings['cxf_button_icon'], array( 'aria-hidden' => 'false' ) );
		else :
			cxf_view_render( 'button.icon', $data );
		endif;
	}
}
