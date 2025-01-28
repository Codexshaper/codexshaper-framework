<?php
/**
 * Post_Navigation Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\PostNavigation\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
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
 * Post_Navigation widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Post_Navigation extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--post-navigation';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Post Navigation', 'codexshaper-framework' );
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
		return 'eicon-post-navigation';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Post Navigation', 'Navigation', 'pagination', 'post', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--post-navigation' );
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
		$this->register_content_style_controls();
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
			'nav_style',
			array(
				'label'   => esc_html__( 'Navigation Style', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'classic' => esc_html__( 'Classic', 'codexshaper-framework' ),
				),

				'default' => 'classic',
			)
		);

		$this->add_control(
			'show_post_title',
			array(
				'label'        => esc_html__( 'Post Title', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
		);

		$this->add_control(
			'title_length',
			array(
				'label'     => esc_html__( 'Title Length', 'codexshaper-framework' ),
				'type'      => Controls_Manager::NUMBER,
				'condition' => array(
					'show_post_title' => 'yes',
				),
			)
		);

		$this->add_control(
			'header_tag',
			array(
				'label'     => esc_html__( 'Heading Tag', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
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
				'default'   => 'h4',
				'condition' => array(
					'show_post_title' => 'yes',
				),
			),
		);

		$this->add_control(
			'post_title_position',
			array(
				'label'     => esc_html__( 'Post title position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'top'    => 'Top',
					'bottom' => 'Bottom',
				),
				'default'   => 'bottom',
				'condition' => array(
					'show_post_title' => 'yes',
				),
			),
		);
		// Previous.
		$this->add_control(
			'show_prev',
			array(
				'label'        => esc_html__( 'Show Prev', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'No', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'prev_heading',
			array(
				'label'     => esc_html__( 'Previous', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array( 'show_prev' => array( 'yes' ) ),
			)
		);

		$this->add_control(
			'prev_label',
			array(
				'label'       => esc_html__( 'Label', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Previous Post', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Type prev title', 'codexshaper-framework' ),
				'condition'   => array( 'show_prev' => array( 'yes' ) ),
			)
		);

		$this->add_control(
			'prev_icon',
			array(
				'label'       => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array( 'show_prev' => array( 'yes' ) ),
			)
		);

		// Next.
		$this->add_control(
			'show_next',
			array(
				'label'        => esc_html__( 'Show Next', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'No', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'next_heading',
			array(
				'label'     => esc_html__( 'Next', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array( 'show_next' => array( 'yes' ) ),
			)
		);

		$this->add_control(
			'next_label',
			array(
				'label'       => esc_html__( 'Label', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Next Post', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Type next title', 'codexshaper-framework' ),
				'condition'   => array( 'show_next' => array( 'yes' ) ),
			)
		);

		$this->add_control(
			'next_icon',
			array(
				'label'       => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array( 'show_next' => array( 'yes' ) ),
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

		$this->add_responsive_control(
			'layout_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'layout_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'layout_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--post-navigation',
			)
		);

		$this->add_control(
			'previous_post_heading',
			array(
				'label'     => esc_html__( 'Previous Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'previous_wrapper_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation .cxf--prev-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'previous_wrapper_border',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .cxf--prev-link',
			)
		);

		$this->add_control(
			'next_post_heading',
			array(
				'label'     => esc_html__( 'Next Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'next_wrapper_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation .cxf--next-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'next_wrapper_border',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .cxf--next-link',
			)
		);

		// Write style controls here.

		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget content style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	public function register_content_style_controls() {
		$this->start_controls_section(
			'content_style',
			array(
				'label' => __( 'Content', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'next_prev_post_btn_heading',
			array(
				'label'     => esc_html__( 'Button', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'next_prev_post_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation .next-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'next_prev_post_btn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation .next-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'next_prev_post_btn_border',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .next-prev',
			)
		);
		// tabs.
		$this->start_controls_tabs(
			'next_prev_post_btn_style_tabs'
		);

		$this->start_controls_tab(
			'next_prev_post_btn_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'next_prev_post_btn_text_typography',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .next-prev',
			)
		);

		$this->add_control(
			'next_prev_post_btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--post-navigation .next-prev' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'next_prev_post_btn_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--post-navigation .next-prev',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'next_prev_post_btn_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'next_prev_post_btn_text_typography_hover',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .next-prev:hover',
			)
		);

		$this->add_control(
			'next_prev_post_btn_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--post-navigation .next-prev:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'next_prev_post_btn_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--post-navigation .next-prev:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'prev_next_title_heading',
			array(
				'label'     => esc_html__( 'Title', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'prev_next_title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--post-navigation .cxf--post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'prev_next_title_style_tabs'
		);

		$this->start_controls_tab(
			'prev_next_title_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'prev_next_title_typography',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .cxf--post-title',
			)
		);

		$this->add_control(
			'prev_next_title_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--post-navigation .cxf--post-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'prev_next_title_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'prev_next_title_text_typography_hover',
				'selector' => '{{WRAPPER}} .cxf--post-navigation .cxf--post-title:hover',
			)
		);

		$this->add_control(
			'prev_next_title_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--post-navigation .cxf--post-title:hover' => 'color: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();

		$next_post = get_next_post();
		$prev_post = get_previous_post();

		$has_next = 'yes' === $settings['show_next'] && $next_post && property_exists( $next_post, 'ID' );
		$has_prev = 'yes' === $settings['show_prev'] && $prev_post && property_exists( $prev_post, 'ID' );

		if ( ! $has_next && ! $has_prev ) {
			return;
		}

		$nav_style = '';
		if ( 'classic' !== $settings['nav_style'] ) {
			$nav_style = $settings['nav_style'];
		}

		$this->add_render_attribute( 'post-navigation-wrapper', 'class', array( 'cxf--post-navigation', $nav_style ) );
		$this->add_render_attribute( 'post-prev-link-wrapper', 'class', array( 'cxf--prev-link' ) );
		$this->add_render_attribute( 'post-next-link-wrapper', 'class', array( 'cxf--next-link' ) );
		$this->add_render_attribute( 'post-title', 'class', array( 'cxf--post-title' ) );
		$data = array(
			'post_navigation_wrapper' => $this->get_render_attribute_string( 'post-navigation-wrapper' ),
			'post_prev_link_wrapper'  => $this->get_render_attribute_string( 'post-prev-link-wrapper' ),
			'post_next_link_wrapper'  => $this->get_render_attribute_string( 'post-next-link-wrapper' ),
			'prev_permalink'          => '#',
			'next_permalink'          => '#',
			'post_prev_title'         => '',
			'post_next_title'         => '',
			'post_prev_label'         => $this->print_label( $settings['prev_label'] ),
			'post_next_label'         => $this->print_label( $settings['next_label'] ),
			'prev_icon'               => $this->render_icon( $settings['prev_icon'] ),
			'next_icon'               => $this->render_icon( $settings['next_icon'] ),
			'has_next'                => $has_next,
			'has_prev'                => $has_prev,
			'title_position'          => $settings['post_title_position'],
		);

		if ( $prev_post ) {
			$data['prev_permalink'] = get_the_permalink( $prev_post->ID );
			if ( 'yes' === $settings['show_post_title'] ) {
				$data['post_prev_title'] = $this->render_title( $prev_post, $settings );
			}
		}

		if ( $next_post ) {
			$data['next_permalink'] = get_the_permalink( $next_post->ID );
			if ( 'yes' === $settings['show_post_title'] ) {
				$data['post_next_title'] = $this->render_title( $next_post, $settings );
			}
		}

		cxf_view( 'post-navigation.content', $data );
	}

	/**
	 * Render title.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return string The rendered title HTML.
	 * @param mixed $post Post.
	 * @param array $settings Post Navigation settings.
	 */
	protected function render_title( $post, $settings ) {
		if ( 'yes' === $settings['show_post_title'] ) {
			$max_length = (int) $settings['title_length'];
			$title      = get_the_title( $post->ID );
			return sprintf(
				'<%1$s %2$s>%3$s</%1$s>',
				Utils::validate_html_tag( $settings['header_tag'] ),
				$this->get_render_attribute_string( 'post-title' ),
				wp_trim_words( $title, $max_length, '...' )
			);
		}
	}

	/**
	 * Print label.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return string The rendered label.
	 * @param string $label Label.
	 */
	protected function print_label( $label ) {
		return $label ? wp_kses_post( $label ) : '';
	}

	/**
	 * Render icon.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param mixed $icon The icon data.
	 * @return string The rendered icon HTML.
	 */
	protected function render_icon( $icon ) {
		return Icons_Manager::try_get_icon_html( $icon, array( 'aria-hidden' => 'true' ) );
	}
}
