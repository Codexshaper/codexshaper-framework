<?php
/**
 * Taxonomy Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Taxonomy\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields as ControlFields;
use CodexShaper\Framework\Models\Taxonomies\Taxonomy as TaxonomyModel;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Taxonomy widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Taxonomy extends Widget {


	use ControlFields;

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--taxonomy';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Taxonomy', 'codexshaper-framework' );
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
		return 'eicon-taxonomy-filter';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Taxonomy', 'Tag', 'Category', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--taxonomy' );
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
		$this->register_style_controls();
		// Register style controls.
		$this->register_list_style_controls();
		// Register style controls.
		$this->register_term_item_style_controls();
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

		$this->add_control(
			'taxonomy_title',
			array(
				'label'   => esc_html__( 'Taxonomy Title', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Categories',
			),
		);

		$this->add_control(
			'header_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
				'default' => 'h4',
			)
		);

		$this->get_taxonomy_fields();

		$this->add_control(
			'show_post_counter',
			array(
				'label'        => esc_html__( 'Post Counter', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'post_counter_prefix',
			array(
				'label'     => esc_html__( 'Prefix', 'codexshaper-framework' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '(', 'codexshaper-framework' ),
				'condition' => array(
					'show_post_counter' => 'yes',
				),
			)
		);

		$this->add_control(
			'post_counter_postfix',
			array(
				'label'     => esc_html__( 'Postfix', 'codexshaper-framework' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( ')', 'codexshaper-framework' ),
				'condition' => array(
					'show_post_counter' => 'yes',
				),
			)
		);

		$this->add_control(
			'taxonomy_icon',
			array(
				'label'       => esc_html__( 'Taxonomy Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->add_control(
			'total_term_show',
			array(
				'label'   => esc_html__( 'Item Show', 'codexshaper-framework' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget list style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_list_style_controls() {
		$this->start_controls_section(
			'term_list_style_section_style',
			array(
				'label' => __( 'List Style', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'term_list_style_heading',
			array(
				'label'     => esc_html__( 'List Style', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'list_style_color',
			array(
				'label'     => __( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}  .cdx-widget-category .cdx-categories-wrap .cdx-category-list::marker' => 'color: {{VALUE}}',
				),
			)
		);

		// Position Control.
		$this->add_responsive_control(
			'list_style_type',
			array(
				'label'     => esc_html__( 'Type', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''                     => esc_html__( 'Default', 'codexshaper-framework' ),
					'none'                 => esc_html__( 'None', 'codexshaper-framework' ),
					'disc'                 => esc_html__( 'Disc', 'codexshaper-framework' ),
					'circle'               => esc_html__( 'Cirle', 'codexshaper-framework' ),
					'square'               => esc_html__( 'Squre', 'codexshaper-framework' ),
					'decimal'              => esc_html__( 'Decimal', 'codexshaper-framework' ),
					'decimal-leading-zero' => esc_html__( 'Decimal-leading-zero', 'codexshaper-framework' ),
					'lower-roman'          => esc_html__( 'Lower roman', 'codexshaper-framework' ),
					'upper-roman'          => esc_html__( 'Upper roman', 'codexshaper-framework' ),
					'lower-alpha'          => esc_html__( 'Lower alpha', 'codexshaper-framework' ),
					'upper-alpha'          => esc_html__( 'Upper alpha', 'codexshaper-framework' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list' => 'list-style-type : {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'list_style_position',
			array(
				'label'     => esc_html__( 'Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''        => esc_html__( 'Default', 'codexshaper-framework' ),
					'outside' => esc_html__( 'Outside', 'codexshaper-framework' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list' => 'list-style-position : {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'list_style_typography',
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list::marker',
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
	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Layout Style', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'terms_border',
				'selector' => '.cdx-widget',
			)
		);

		$this->add_responsive_control(
			'terms_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'terms_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'terms_area_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cdx-widget',
			)
		);

		$this->add_control(
			'terms_heading',
			array(
				'label'     => esc_html__( 'Heading ', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'terms_heading_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget .cdx-widget-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'terms_heading_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget .cdx-widget-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'terms_heading_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cdx-widget .cdx-widget-title',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'terms_heading_typography',
				'selector' => '{{WRAPPER}} .cdx-widget .cdx-widget-title',
			)
		);

		$this->add_control(
			'terms_heading_text_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget .cdx-widget-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'total_post_heading',
			array(
				'label'     => esc_html__( 'Total Post', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'post_counter_style_tabs'
		);

		$this->start_controls_tab(
			'post_counter_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'post_counter_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cxf--post-counter' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'post_counter_typography',
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cxf--post-counter',
			)
		);

		$this->add_control(
			'post_counter_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cxf--post-counter' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_counter_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'post_counter_typography_hover',
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover .cxf--post-counter',
			)
		);

		$this->add_control(
			'post_counter_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover .cxf--post-counter' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'term_icon_heading',
			array(
				'label'     => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'term_icon_style_tabs'
		);

		$this->start_controls_tab(
			'term_icon_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'term_icon_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link i' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'term_icon_size',
			array(
				'label'      => esc_html__( 'Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'term_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'term_icon_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'term_icon_size_hover',
			array(
				'label'      => esc_html__( 'Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'term_icon_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget term item style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_term_item_style_controls() {

		$this->start_controls_section(
			'term_items_section_style',
			array(
				'label' => __( 'Term Items', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'term_items_position',
			array(
				'label'     => esc_html__( 'Items Position ', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Horizontal', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column' => array(
						'title' => esc_html__( 'Vertical', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			' term_items_wrap',
			array(
				'label'     => esc_html__( 'Items Wrap', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'wrap' => array(
						'title' => esc_html__( 'Wrap', 'codexshaper-framework' ),
						'icon'  => 'eicon-wrap',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap' => 'flex-wrap: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'term_list_wrapper_heading',
			array(
				'label'     => esc_html__( 'Item Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_layout_controls(
			'term_list_wrapper',
			options: array(
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list',
			)
		);

		$this->add_control(
			'term_title_heading',
			array(
				'label'     => esc_html__( 'Title', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_layout_controls(
			'term_list',
			options: array(
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link',
			)
		);

		$this->start_controls_tabs(
			'term_title_style_tabs'
		);

		$this->start_controls_tab(
			'term_title_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'term_title_typography',
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cxf--title',
			)
		);

		$this->add_control(
			'term_title_text_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cxf--title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'term_title_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'term_title_typography_hover',
				'selector' => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover .cxf--title',
			)
		);

		$this->add_control(
			'term_title_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover .cxf--title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'term_link_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover',
			)
		);

		$this->add_control(
			'term_link_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-widget-category .cdx-categories-wrap .cdx-category-list .cdx-category-link:hover' => 'border-color: {{VALUE}};',
				),
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
		$settings     = $this->get_settings_for_display();
		$title        = $settings['taxonomy_title'] ?? '';
		$post_counter = $settings['show_post_counter'];
		// Query.
		$query_type = $settings['query_type'] ?? 'custom';
		$taxonomies = $settings['taxonomies'] ?? array( 'category' );
		$post_type  = $settings['post_type'] ?? 'post';
		$post_types = array( $post_type );
		$terms      = array();

		if ( 'custom' === $query_type ) {
			$terms = TaxonomyModel::get_terms( $post_types, $taxonomies );
		}

		if ( 'current_query' === $query_type ) {
			$terms = TaxonomyModel::get_current_terms( $taxonomies );
		}

		$this->add_render_attribute( 'title', 'class', 'cdx-widget-title' );

		$title_html    = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			Utils::validate_html_tag( $settings['header_tag'] ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);
		$total_terms   = isset( $settings['total_term_show'] ) && ! empty( $settings['total_term_show'] ) ? $settings['total_term_show'] : count( $terms );
		$limited_terms = isset( $settings['total_term_show'] ) ? array_slice( $terms, 0, $total_terms )
			: $terms;

			$data = array(
				'settings'      => $settings,
				'title'         => $title,
				'title_html'    => $title_html,
				'total_terms'   => $total_terms,
				'limited_terms' => $limited_terms,
				'post_counter'  => $post_counter,
				'taxonomy_icon' => Icons_Manager::try_get_icon_html( $settings['taxonomy_icon'], array( 'aria-hidden' => 'true' ) ),
			);
			cxf_view( 'taxonomy.content', $data );
	}
}
