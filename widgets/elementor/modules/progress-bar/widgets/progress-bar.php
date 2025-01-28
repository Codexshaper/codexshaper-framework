<?php
/**
 * Progress Bar Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\ProgressBar\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Progress Bar widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Progress_Bar extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--progress-bar';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Progress Bar', 'codexshaper-framework' );
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
		return 'eicon-skill-bar';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Progress Bar', 'CodexShaper', 'CodexShaper_Framework' );
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
		return array( 'eb-widget-progress-bar' );
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
			'progress_bar_type',
			array(
				'label'   => esc_html__( 'Type', 'codexshaper-framework' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => array(
					'progress-bar-cxf-animated'         => esc_html__( 'Default', 'codexshaper-framework' ),
					'progress-bar-gradient'             => esc_html__( 'Gradient', 'codexshaper-framework' ),
					'progress-bar-cxf-rainbow-animated' => esc_html__( 'Rainbow', 'codexshaper-framework' ),
				),

			)
		);
		$this->add_control(
			'progress_title',
			array(
				'label'       => esc_html__( 'Title', 'codexshaper-framework' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Web Design', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Type your title here', 'codexshaper-framework' ),
			)
		);
		$this->add_control(
			'progress_percentage',
			array(
				'label'   => esc_html__( 'Percentage', 'codexshaper-framework' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 70,
			)
		);
		$this->end_controls_section();

		// Style tab start.
		$this->start_controls_section(
			'styling_section',
			array(
				'label' => __( 'Styling Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress-title' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .progress-title',
			)
		);
		$this->add_control(
			'number_color',
			array(
				'label'     => __( 'Number Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress-percentage' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_typography',
				'label'    => __( 'Number Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .progress-percentage',
			)
		);

		$this->add_control(
			'progress_bar_height',
			array(
				'label'      => esc_html__( 'Progress Bar Height', 'codexshaper-framework' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
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
				),
				'selectors'  => array(
					'{{WRAPPER}} .progress-container' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'bar_padding',
			array(
				'label'      => esc_html__( 'Progress Bar Padding', 'codexshaper-framework' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .progress-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'default_bar_color',
			array(
				'label'     => __( 'Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .progress-bar-cxf-animated' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
				'condition' => array(
					'progress_bar_type' => 'progress-bar-cxf-animated',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'      => 'background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .progress-bar-gradient',
				'condition' => array(
					'progress_bar_type' => 'progress-bar-gradient',
				),
			)
		);
		$this->add_control(
			'rainbow_gradient',
			array(
				'label'     => __( 'Rainbow Gradient', 'codexshaper-framework' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'default'   => 'linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet, red)',
				'selectors' => array(
					'{{WRAPPER}} .progress-bar-cxf-rainbow-animated' => 'background: {{VALUE}}; background-size: 700% 100%;',
				),
				'condition' => array(
					'progress_bar_type' => 'progress-bar-cxf-rainbow-animated',
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
		$class    = '';
		$class   .= $settings['progress_bar_type'];
		$data     = array(
			'settings' => $settings,
			'class'    => $class,
		);
		cxf_view( 'progress-bar.content', $data );
	}
}
