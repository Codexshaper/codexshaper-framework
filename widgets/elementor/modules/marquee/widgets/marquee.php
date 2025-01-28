<?php
/**
 * Marquee Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Marquee\Widgets;

use CodexShaper\Framework\Foundation\Elementor\SliderWidget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Marquee widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Marquee extends SliderWidget {


	use Fields;

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--marquee';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Marquee', 'codexshaper-framework' );
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
		return 'eicon-slides';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Marquee', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--marquee' );
	}

	/**
	 * Get js dependencies.
	 *
	 * Retrieve the list of js dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget js dependencies.
	 */
	public function get_script_depends(): array {
		return array( 'cxf--slider', 'cxf--marquee' );
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
		// Register layout controls.
		$this->register_layout_controls();
		// Register style controls.
		$this->registe_style_controls();
		// Register pagination style controls.
		$this->register_pagination_style_controls();
		// Register slider controls.
		parent::register_controls();
	}

	/**
	 * Register Elementor widget layout controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_layout_controls() {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Layout', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'marquee_text',
			array(
				'label'       => esc_html__( 'Text', 'codexshaper-framework' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'marquee_link',
			array(
				'label'         => __( 'Link', 'codexshaper-framework' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://example.com', 'codexshaper-framework' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);
		$repeater->add_control(
			'marquee_image',
			array(
				'label' => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'marquee_items',
			array(
				'label'         => esc_html__( 'Maruqee Items', 'codexshaper-framework' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'prevent_empty' => false,
				'default'       => array(
					array(
						'marquee_text' => esc_html__( 'CodexShaper', 'codexshaper-framework' ),
					),
					array(
						'marquee_text' => esc_html__( 'CodexShaper Framework', 'codexshaper-framework' ),
					),
					array(
						'marquee_text' => esc_html__( 'Academine', 'codexshaper-framework' ),
					),
					array(
						'marquee_text' => esc_html__( 'HiveTheme', 'codexshaper-framework' ),
					),
					array(
						'marquee_text' => esc_html__( 'Ahsan Theme', 'codexshaper-framework' ),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'marquee_image',
				'default' => 'full',
			)
		);

		$this->add_control(
			'lazy_load',
			array(
				'label' => esc_html__( 'Custom Lazy Load ', 'codexshaper-framework' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_control(
			'allow_pagination',
			array(
				'label'     => esc_html__( 'Allow Pagination', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_attr__( 'SHOW', 'codexshaper-framework' ),
				'label_off' => esc_attr__( 'Hide', 'codexshaper-framework' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function registe_style_controls() {
		// Style tab start.
		$this->start_controls_section(
			'styling_section',
			array(
				'label' => __( 'Styling Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->common_space_controls(
			'marquee_text_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-wrapper',
			)
		);

		$this->add_control(
			'image_wrapper_heading',
			array(
				'label'     => esc_html__( 'Image Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_wrapper_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-image-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_wrapper_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_heading',
			array(
				'label'     => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_position',
			array(
				'label'     => esc_html__( 'Image Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'            => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-left',
					),
					'row-reverse'    => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column'         => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-up',
					),
					'column-reverse' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--marquee-slider .cxf--marquee-wrapper' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'marquee_image_style_tabs'
		);

		$this->start_controls_tab(
			'marquee_image_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->common_image_controls(
			'marquee_image',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-image',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'marquee_image_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->common_image_controls(
			'marquee_image_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-image:hover',
				'exclude'  => array(
					'marquee_image_hover_image_width',
					'marquee_image_hover_image_height',
					'marquee_image_hover_image_max_width',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'item_text_heading',
			array(
				'label'     => esc_html__( 'Text', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'marquee_text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'marquee_text_style_tabs'
		);

		$this->start_controls_tab(
			'marquee_text_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->common_text_controls(
			'marquee_text',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-text',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'marquee_text_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--marquee-text',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'marquee_text_border',
				'selector' => '{{WRAPPER}} .cxf--marquee-text',
			)
		);

		$this->add_responsive_control(
			'marquee_text_border_radius',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'marquee_text_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->common_text_controls(
			'marquee_text_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-text:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'marquee_text_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--marquee-text:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'title_show_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'title show hr', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'item_heading',
			array(
				'label'     => esc_html__( 'Item', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'inner_item_gap',
			array(
				'label'      => __( 'Gap Between Inner items', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .cxf--marquee-slider .cxf--marquee-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				),

			)
		);
		$this->add_control(
			'item_gap',
			array(
				'label'      => __( 'Gap Between items', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-slider .swiper-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'marquee_item_style_tabs'
		);

		$this->start_controls_tab(
			'marquee_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'marquee_item_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--marquee-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'marquee_item_border',
				'selector' => '{{WRAPPER}} .cxf--marquee-wrapper',
			)
		);

		$this->add_responsive_control(
			'marquee_item_border_radius',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--marquee-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'marquee_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'marquee_item_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--marquee-wrapper:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'marquee_area_heading',
			array(
				'label'     => esc_html__( 'Marquee Area', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_space_controls(
			'marquee_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--marquee-slider',
			)
		);

		$this->start_controls_tabs(
			'rollslider_bg_color_tab',
		);
		$this->start_controls_tab(
			'rollslider_bg_normal_tab',
			array(
				'label' => __( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rollslider_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf--marquee-slider',

			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'rollslider_bg_hover_tab',
			array(
				'label' => __( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'rollslider_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf--marquee-slider:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget pagination style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_pagination_style_controls() {

		$this->start_controls_section(
			'pagination_section',
			array(
				'label'     => __( 'Pagination', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'allow_pagination' => 'yes',
				),
			)
		);

		// Position Control.
		$this->add_control(
			'bullet_pagination_position_type',
			array(
				'label'     => esc_html__( 'Position Type', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''         => esc_html__( 'Default', 'codexshaper-framework' ),
					'relative' => esc_html__( 'Relative', 'codexshaper-framework' ),
					'absolute' => esc_html__( 'Absolute', 'codexshaper-framework' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination' => 'position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pagination_z_index',
			array(
				'label'     => esc_html__( 'Z-Index', 'codexshaper-framework' ),
				'type'      => Controls_Manager::NUMBER,
				'selectors' => array(
					'{{WRAPPER}} .swiper-pagination' => 'Z-Index: {{SIZE}};',
				),
			)
		);

		// Vertical Position Control.
		$this->add_responsive_control(
			'pagination_vertical_position',
			array(
				'label'      => esc_html__( 'Vertical Alignment', 'codexshaper-framework' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'    => 'top',
				'toggle'     => true,
				'responsive' => true,

			)
		);

		// Vertical Offset Control.
		$this->add_responsive_control(
			'pagination_vertical_offset',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination' => '{{pagination_vertical_position.VALUE}} : {{SIZE}}{{UNIT}} !important;',

				),
			)
		);

		// Horizontal Position Control.
		$this->add_responsive_control(
			'pagination_horizontal_position',
			array(
				'label'      => esc_html__( 'Horizontal Alignment', 'codexshaper-framework' ),
				'type'       => Controls_Manager::CHOOSE,
				'options'    => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'    => 'left',
				'toggle'     => true,
				'responsive' => true,
			)
		);

		// Horizontal Offset Control.
		$this->add_responsive_control(
			'pagination_horizontal_offset',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => -500,
						'max' => 500,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination' => '{{pagination_horizontal_position.VALUE}} : {{SIZE}}{{UNIT}} !important;',

				),

			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'bullet_pagination_background',
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .swiper-pagination',

			)
		);

		$this->add_responsive_control(
			'bullet_pagination_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'bullet_pagination_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->start_controls_tabs(
			'pagination_tabs'
		);

		$this->start_controls_tab(
			'pagination_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'pagination_btn_opacity',
			array(
				'label'      => esc_html__( 'Opacity', 'codexshaper-framework' ),
				'type'       => Controls_Manager::NUMBER,
				'size_units' => array( 'px', '%', 'em', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'opacity: {{SIZE}}',
				),

			)
		);

		$this->add_responsive_control(
			'pagination_btn_size',
			array(
				'label'      => esc_html__( 'Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => -500,
						'max' => 500,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),

			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_btn_border',
				'selector'  => '{{WRAPPER}} .swiper-pagination-bullet',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'pagination_btn_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background',
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',

			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'pagination_active_tab',
			array(
				'label' => esc_html__( 'Active', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background_active',
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_btn_border_active',
				'selector'  => '{{WRAPPER}} .swiper-pagination-bullet-active',
				'separator' => 'before',
			)
		);

		$this->end_controls_tab();
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
		$data     = array(
			'class' => 'cxf--marquee-slider',
		);
		$this->add_slider_attributes( $this, $data );
		$items = $settings['marquee_items'] ?? array();
		foreach ( $items as $item ) {
			$image_size                   = $settings['marquee_image_size'] ?? 'full';
					$marquee_image        = $item['marquee_image'] ?? null;
					$marquee_image_id     = $marquee_image['id'] ?? null;
					$is_lazy_load         = 'yes' === $settings['lazy_load'];
					$marquee_size_image[] = $this->get_size_image(
						image_id: $marquee_image_id,
						size: $image_size,
						is_custom_lazy: $is_lazy_load,
						attributes: array(
							'alt'         => 'Image',
							'class'       => 'cxf--marquee-image',
							'marquee_url' => 0 < $marquee_image_id ? '' : $marquee_image['url'],
						)
					);

		}
		$data = array(
			'sliderWrapperAttributes' => $this->get_render_attribute_string( 'slider-wrapper' ),
			'marquee_size_image'      => $marquee_size_image,
			'items'                   => $items,
			'settings'                => $settings,
		);

		cxf_view( 'marquee.content', $data );
	}
}
