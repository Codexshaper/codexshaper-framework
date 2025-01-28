<?php
/**
 * Title Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Title\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Title widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Title extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--title';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Title', 'codexshaper-framework' );
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
		return '
eicon-t-letter';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Title', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--title' );
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
			'title',
			array(
				'label'       => esc_html__( 'Title', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXTAREA,
				'ai'          => array(
					'type' => 'text',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'Enter your title', 'codexshaper-framework' ),
				'default'     => esc_html__( 'Add Your Heading [Text] Here', 'codexshaper-framework' ),
				'description' => 'For Highlight, keep text in [ ]. Ex. [ Text ]',
			)
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
				'default' => 'h2',
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
				'label' => __( 'Layout', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .cxf--title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			array(
				'name'     => 'text_stroke',
				'selector' => '{{WRAPPER}} .cxf--title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .cxf--title',
			)
		);

		$this->add_control(
			'blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => esc_html__( 'Normal', 'codexshaper-framework' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--title' => 'mix-blend-mode: {{VALUE}}',
				),
				'separator' => 'none',
			)
		);

		// Highlight title.
		$this->add_control(
			'highlight',
			array(
				'label'     => esc_html__( 'Highlight', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'highilight_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--title .cxf--highlight' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'highlight_color',
			array(
				'label'      => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => '#F7C600',
				'selectors'  => array(
					'{{WRAPPER}} .cxf--title .cxf--highlight' => 'color: {{VALUE}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf--title .cxf--highlight',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'highlight_typography',
				'selector' => '{{WRAPPER}} .cxf--title .cxf--highlight',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			array(
				'name'     => 'highlight_stroke',
				'selector' => '{{WRAPPER}} .cxf--title .cxf--highlight',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'highlight_shadow',
				'selector' => '{{WRAPPER}} .cxf--title .cxf--highlight',
			)
		);

		$this->add_control(
			'highlight_blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => esc_html__( 'Normal', 'codexshaper-framework' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--title .cxf--highlight' => 'mix-blend-mode: {{VALUE}}',
				),
				'separator' => 'none',
			)
		);

		// Alignment.
		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

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
		$title    = $settings['title'] ?? '';

		if ( '' === $title ) {
			return;
		}

		preg_match_all( '/\[([^\]]*)\]/', $title, $matches );

		foreach ( $matches[0] as $key => $value ) {
			$title = str_replace( $value, '<span class="cxf--highlight">' . $matches[1][ $key ] . '</span>', $title, );
		}

		$this->add_render_attribute( 'title', 'class', 'cxf--title' );

		$title_html = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			Utils::validate_html_tag( $settings['header_tag'] ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);

		echo wp_kses_post( $title_html );
	}
}
