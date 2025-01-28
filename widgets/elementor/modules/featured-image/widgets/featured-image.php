<?php
/**
 * Featured_Image Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\FeaturedImage\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Featured_Image widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Featured_Image extends Widget {
	use Fields;
	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--featured-image';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Featured Image', 'codexshaper-framework' );
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
		return 'eicon-featured-image';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Featured Image', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--featured-image' );
	}

	/**
	 * Get script dependencies.
	 *
	 * Retrieve the list of script dependencies the widget requires.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget script dependencies.
	 */
	public function get_script_depends(): array {
		return array( 'cxf--lazy-load' );
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
			'fallback_image',
			array(
				'label'   => esc_html__( 'Fallback Image', 'codexshaper-framework' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'featured_image',
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

		// Write style controls here.

		$this->add_control(
			'featured_image_wrapper_heading',
			array(
				'label'     => esc_html__( 'Image Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'featured_image_wrapper_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-featured-image-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'featured_image_wrapper_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-featured-image-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'featured_image_heading',
			array(
				'label'     => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_image_controls(
			'featured_image',
			options: array(
				'selector' => '{{WRAPPER}} .cxf-featured-image-wrapper .featured-image',
			)
		);

		$this->start_controls_tabs(
			'featured_image_style_tabs'
		);

		$this->start_controls_tab(
			'featured_image_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'opacity_normal',
			array(
				'label'     => esc_html__( 'Opacity', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 1,
				),
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf-featured-image-wrapper .featured-image' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			array(
				'name'     => 'custom_css_filters',
				'selector' => '{{WRAPPER}} .cxf-featured-image-wrapper .featured-image',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'featured_image_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'opacity_hover',
			array(
				'label'     => esc_html__( 'Opacity', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 1,
				),
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}  .cxf-featured-image-wrapper .featured-image:hover' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_control(
			'transition_hover',
			array(
				'label'     => esc_html__( 'Transition Duration(s)', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf-featured-image-wrapper .featured-image' => 'transition: {{SIZE}}s;',
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
		$this->switch_template_post();

		$settings            = $this->get_settings_for_display();
		$image_size          = $settings['featured_image_size'] ?? 'full';
		$fallback_image      = $settings['fallback_image'] ?? null;
		$fallback_image_id   = $fallback_image['id'] ?? null;
		$is_lazy_load        = 'yes' === $settings['lazy_load'];
		$fallback_size_image = $this->get_size_image(
			image_id: $fallback_image_id,
			size: $image_size,
			is_custom_lazy: $is_lazy_load,
			attributes: array(
				'alt'          => 'Image',
				'class'        => 'featured-image',
				'fallback_url' => 0 < $fallback_image_id ? '' : $fallback_image['url'],
			)
		);

		$post_id = get_the_id();
		$data    = array(
			'settings'            => $settings,
			'fallback_size_image' => $fallback_size_image,
			'post_id'             => $post_id,
			'is_lazy_load'        => $is_lazy_load,
			'image_size'          => $image_size,
		);
		cxf_view( 'featured-image.content', $data );
		$this->restore_current_post();
	}
}
