<?php
/**
 * Testimonial_Slider Widget file
 *
 * @category   Widget
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Widgets;

use CodexShaper\Framework\Foundation\Elementor\SliderWidget;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Five;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Six;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Seven;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Four;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Three;
use CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins\Skin_Testimonial_Two;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Testimonial_Slider widget class
 *
 * @category   Class
 * @package    Dioexpress_Element_Bucket
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://elementbucket.com
 * @since      1.0.0
 */
class Testimonial_Slider extends SliderWidget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--eb-widget-testimonial-slider';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Testimonial Slider', 'codexshaper-framework' );
	}

	/**
	 * Register widget skins.
	 *
	 * This method is activated while initializing the widget base class. It is
	 * used to assign skins to widgets with `add_skin()` method.
	 *
	 * Usage:
	 *
	 *    protected function register_skins() {
	 *        $this->add_skin( new Skin_Classic( $this ) );
	 *    }
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_skins() {
		$this->add_skin( new Skin_Testimonial_Two( $this ) );
		$this->add_skin( new Skin_Testimonial_Three( $this ) );
		$this->add_skin( new Skin_Testimonial_Four( $this ) );
		$this->add_skin( new Skin_Testimonial_Five( $this ) );
		$this->add_skin( new Skin_Testimonial_Six( $this ) );
		$this->add_skin( new Skin_Testimonial_Seven( $this ) );

		/**
		 * Widget skin init.
		 *
		 * Fires when Elementor widget is being initialized.
		 *
		 * The dynamic portion of the hook name, `$widget_name`, refers to the widget name.
		 *
		 * @since 1.0.0
		 *
		 * @param Widget_Base $this The current widget.
		 */
		do_action( "cxf/widget/{$this->get_name()}/skins_init", $this );
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
		return 'eicon-post-slider';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Testimonial Slider', 'Testimonial', 'CodexShaper', 'Element Bucket' );
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
		return array( 'cxf--eb-widget-testimonial-slider' );
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
		return array( 'cxf--slider', 'cxf--eb-widget-testimonial-slider' );
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

		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_title',
			array(
				'label'       => __( 'Title', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( "it's amazing services", 'codexshaper-framework' ),
				'description' => __( 'Not Applicable for Style 03 04 05', 'codexshaper-framework' ),

			)
		);

		$repeater->add_control(
			'testimonial_description',
			array(
				'label'   => __( 'Description', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( '“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.”', 'codexshaper-framework' ),
			)
		);

		$repeater->add_control(
			'testimonial_author_image',
			array(
				'label'   => __( 'Author Image', 'codexshaper-framework' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'image' => array(
						'url' => Utils::get_placeholder_image_src(),
					),
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'author_image',
				'default' => 'full',
			)
		);

		$repeater->add_control(
			'testimonial_name',
			array(
				'label'   => __( 'Name', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Dominic L. Ement', 'codexshaper-framework' ),
			)
		);

		$repeater->add_control(
			'testimonial_designation',
			array(
				'label'   => __( 'Designation', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'CTO of DioExpress', 'codexshaper-framework' ),
			)
		);

		$repeater->add_control(
			'rating_count_testimonial',
			array(
				'label'       => __( 'Rating Count', 'codexshaper-framework' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '5',
				'options'     => array(
					'1' => __( '1 Star', 'codexshaper-framework' ),
					'2' => __( '2 Star', 'codexshaper-framework' ),
					'3' => __( '3 Star', 'codexshaper-framework' ),
					'4' => __( '4 Star', 'codexshaper-framework' ),
					'5' => __( '5 Star', 'codexshaper-framework' ),
				),
				'description' => __( 'Not Applicable for Style 05', 'codexshaper-framework' ),

			)
		);

		$this->add_control(
			'items',
			array(
				'label'   => __( 'Testimonial Item', 'codexshaper-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => array(
					array(
						'testimonial_author_image' => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
				),
			)
		);

		$this->add_control(
			'star_icon',
			array(
				'label'     => esc_html__( 'Rating Star Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_control(
			'button_control',
			array(
				'label'        => __( 'Button Control', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'codexshaper-framework' ),
				'label_off'    => __( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'_skin!' => array( 'skin-testimonial-two', 'skin-testimonial-three' ),
				),
			)
		);

		$this->add_control(
			'previous_btn_icon',
			array(
				'label'     => esc_html__( 'Previous Button Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-two', 'skin-testimonial-three', 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_control(
			'next_btn_icon',
			array(
				'label'     => esc_html__( 'Next Button Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				),
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-two', 'skin-testimonial-three', 'skin-testimonial-five' ),
				),
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
			'show_pagination',
			array(
				'label'        => esc_html__( 'Show Pagination', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'_skin!' => array( 'skin-testimonial-four', 'skin-testimonial-five', 'skin-testimonial-six', 'skin-testimonial-seven' ),
				),
			)
		);

		$this->end_controls_section();
		parent::register_controls();

		// Style tab start.
		$this->start_controls_section(
			'styling_section',
			array(
				'label'     => __( 'General Styling', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-five', 'skin-testimonial-six', 'skin-testimonial-seven' ),
				),
			)
		);

		$this->add_responsive_control(
			'section_padding',
			array(
				'label'      => esc_html__( 'Section Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'section_margin',
			array(
				'label'      => esc_html__( 'Section Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'icon_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
				'condition'  => array(
					'_skin!' => array( 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_responsive_control(
			'star_icon_gap',
			array(
				'label'      => __( 'Star Icon Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon' => 'margin-right: {{SIZE}}{{UNIT}} ;',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon' => 'margin-right: {{SIZE}}{{UNIT}} ;',

				),
				'condition'  => array(
					'_skin!' => array( 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_responsive_control(
			'star_icon_size',
			array(
				'label'      => __( 'Star Icon size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',

				),
				'condition'  => array(
					'_skin!' => array( 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_control(
			'star_icon_color',
			array(
				'label'     => __( 'Star Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon svg svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon svg svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-rating i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon svg i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon svg i' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-five' ),
				),
			)
		);

		$this->add_control(
			'testimonial_title_color',
			array(
				'label'     => __( 'Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-title' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'testimonial_title_typography',
				'label'    => __( 'Title Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card .cdx-title',
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => esc_html__( 'Title Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'testimonial_description_color',
			array(
				'label'     => __( 'Description Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-description' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'testimonial_description_typography',
				'label'    => __( 'Description Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card .cdx-description',
			)
		);

		$this->add_responsive_control(
			'description_padding',
			array(
				'label'      => esc_html__( 'Description Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'author_name_color',
			array(
				'label'     => __( 'Author Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-name' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_name_typography',
				'label'    => __( 'Author Name Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-name',
			)
		);

		$this->add_responsive_control(
			'name_padding',
			array(
				'label'      => esc_html__( 'Name Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'author_designation_color',
			array(
				'label'     => __( 'Author Designation Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-designation' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_designation_typography',
				'label'    => __( 'Author Designation Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-designation',
			)
		);

		$this->add_responsive_control(
			'designation_padding',
			array(
				'label'      => esc_html__( 'Designation Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card .cdx-author .cdx-details .cdx-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'image_size',
			array(
				'label'      => __( 'Image size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-item-card .cdx-author img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-2 .cdx-testimonial-item-card .cdx-author img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-3 .cdx-testimonial-item-card .cdx-author img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-6 .cdx-testimonial-item-card .cdx-author img' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',

				),
				'condition'  => array(
					'_skin!' => array( 'skin-testimonial-five', 'skin-testimonial-six', 'skin-testimonial-seven' ),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_btn_section',
			array(
				'label'     => __( 'Navigation Button', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-two', 'skin-testimonial-three', 'skin-testimonial-five' ),
				),
			)
		);

		// Position Control
		$this->add_responsive_control(
			'position_type',
			array(
				'label'     => esc_html__( 'Position Type', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'static'   => esc_html__( 'Static', 'codexshaper-framework' ),
					'relative' => esc_html__( 'Relative', 'codexshaper-framework' ),
					'absolute' => esc_html__( 'Absolute', 'codexshaper-framework' ),
					'fixed'    => esc_html__( 'Fixed', 'codexshaper-framework' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-slider-navigation' => 'position : {{VALUE}};',
					'{{WRAPPER}} .cdx-testimonial-area-7 .cdx-navigation-style-9' => 'position: {{VALUE}};',
					'{{WRAPPER}} .cdx-testimonial-area-4 .cdx-navigation-style-6' => 'position: {{VALUE}};',
					'{{WRAPPER}} .cdx-slide-four.cdx-navigation-style-9' => 'position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'z-insex_of_navigation',
			array(
				'label'     => esc_html__( 'Z-_Index', 'codexshaper-framework' ),
				'type'      => Controls_Manager::NUMBER,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-slider-navigation' => 'z-index : {{VALUE}};',
					'{{WRAPPER}} .cdx-testimonial-area-7 .cdx-navigation-style-9' => 'z-index: {{VALUE}};',
					'{{WRAPPER}} .cdx-testimonial-area-4 .cdx-navigation-style-6' => 'z-index: {{VALUE}};',
					'{{WRAPPER}} .cdx-slide-four.cdx-navigation-style-9' => 'z-index: {{VALUE}};',
				),
			)
		);

		// Vertical Position Control
		$this->add_responsive_control(
			'vertical_position',
			array(
				'label'     => esc_html__( 'Vertical Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'   => 'top',
				'toggle'    => true,
				'resposive' => true,

			)
		);

		// Vertical Offset Control
		$this->add_responsive_control(
			'vertical_offset',
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
				'default'    => array(
					'unit' => '%',
					'size' => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-slider-navigation' => '{{vertical_position.VALUE}} : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-area-7 .cdx-navigation-style-9' => '{{vertical_position.VALUE}}: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-area-4 .cdx-navigation-style-6' => '{{vertical_position.VALUE}} : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-slide-four.cdx-navigation-style-9' => '{{vertical_position.VALUE}} : {{SIZE}}{{UNIT}};',
				),
			)
		);

		// Horizontal Position Control
		$this->add_responsive_control(
			'horizontal_position',
			array(
				'label'     => esc_html__( 'Horizontal Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => true,
				'resposive' => true,
			)
		);

		// Horizontal Offset Control
		$this->add_responsive_control(
			'horizontal_offset',
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
				'default'    => array(
					'unit' => '%',
					'size' => 48.2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-testimonial-slider-navigation' => '{{horizontal_position.VALUE}} : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-area-7 .cdx-navigation-style-9' => '{{horizontal_position.VALUE}} : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-testimonial-area-4 .cdx-navigation-style-6' => '{{horizontal_position.VALUE}} : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-slide-four.cdx-navigation-style-9' => '{{horizontal_position.VALUE}} : {{SIZE}}{{UNIT}};',

				),

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
			'nav_btn_size',
			array(
				'label'      => __( 'Button size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-navigation-btn' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'nav_btn_radius',
			array(
				'label'      => __( 'Button Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-navigation-btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'arrow_btn_color',
			array(
				'label'     => __( 'Arrow Button Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btn_border',
				'label'     => __( 'Border', 'codexshaper-framework' ),
				'selector'  => '{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn, {{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation, {{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn',
				'separator' => 'after',
			)
		);

		$this->add_control(
			'nav_icon_color',
			array(
				'label'     => __( 'Navigation Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn i' => 'color: {{VALUE}}',

				),
			)
		);

		$this->add_control(
			'nav_icon_size',
			array(
				'label'      => __( 'Navigation Icon size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
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

		$this->add_control(
			'arrow_btn_hover_color',
			array(
				'label'     => __( 'Arrow Button Hover Background Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn:hover' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'nav_icon_color_hover',
			array(
				'label'     => __( 'Navigation Icon Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn:hover svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation:hover svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn:hover svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-slider-1 .cdx-primary-navigation-btn .cdx-slider-nav-btn:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-9 .cdx-btn-navigation:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn:hover i' => 'color: {{VALUE}}',

				),
			)
		);

		$this->end_controls_tabs();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_background',
			array(
				'label'     => __( 'Testimonial Background', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'_skin!' => array( 'skin-testimonial-five', 'skin-testimonial-six', 'skin-testimonial-seven' ),
				),
			)
		);

		$this->start_controls_tabs(
			'testimonial_bg_tab',
		);

		$this->start_controls_tab(
			'testimonial_bg_normal_tab',
			array(
				'label' => __( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card',

			)
		);

		$this->add_control(
			'testimonial_border_radius',
			array(
				'label'      => __( 'Testimonial Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'testimonial_shadow',
				'label'    => __( 'Hero Shadow', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card',
			)
		);

		$this->add_control(
			'testimonial_border_width',
			array(
				'label'      => __( 'Border Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_color',
			array(
				'label'     => __( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_style',
			array(
				'label'     => __( 'Border Style', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => __( 'None', 'codexshaper-framework' ),
					'solid'  => __( 'Solid', 'codexshaper-framework' ),
					'dashed' => __( 'Dashed', 'codexshaper-framework' ),
					'dotted' => __( 'Dotted', 'codexshaper-framework' ),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_bg_hover_tab',
			array(
				'label' => __( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_hover_bg_color',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card:hover',
			)
		);

		$this->add_control(
			'testimonial_border_hover_radius',
			array(
				'label'      => __( 'Testimonial Border Radius Hover', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-card:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'testimonial_hover_shadow',
				'label'    => __( 'Testimonial Hover Shadow', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-card:hover',
			)
		);

		$this->add_control(
			'testimonial_border_hover_color',
			array(
				'label'     => __( 'Border Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-card:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// pagination style
		$this->register_pagination_style_controls();
	}

	/**
	 * Register pagination style controls.
	 *
	 * @access protected
	 * @return void
	 */
	protected function register_pagination_style_controls() {

		$this->start_controls_section(
			'pagination_section',
			array(
				'label'     => __( 'Pagination', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_pagination' => 'yes',
					'_skin!'          => array( 'skin-testimonial-four', 'skin-testimonial-five', 'skin-testimonial-six', 'skin-testimonial-seven' ),
				),
			)
		);

		// Position Control
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
				'label' => esc_html__( 'Z-Index', 'codexshaper-framework' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 5,
				'max'   => 100,
				'step'  => 5,
			)
		);

		// Vertical Position Control
		$this->add_responsive_control(
			'pagination_vertical_position',
			array(
				'label'   => esc_html__( 'Vertical Alignment', 'codexshaper-framework' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-top',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default' => 'top',
				'toggle'  => true,

			)
		);

		// Vertical Offset Control
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
					'{{WRAPPER}} .cdx-pagination-bullet' => '{{pagination_vertical_position.VALUE}} : {{SIZE}}{{UNIT}} !important;',

				),
			)
		);

		// Horizontal Position Control
		$this->add_control(
			'pagination_horizontal_position',
			array(
				'label'   => esc_html__( 'Horizontal Alignment', 'codexshaper-framework' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default' => 'left',
				'toggle'  => true,
			)
		);

		// Horizontal Offset Control
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
					'{{WRAPPER}} .cdx-pagination-bullet' => '{{pagination_horizontal_position.VALUE}} : {{SIZE}}{{UNIT}} !important;',

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

		$this->add_control(
			'pagination_btn_hr_line_header',
			array(
				'label'     => esc_html__( 'Horizontal Line', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'_skin'                            => array( 'skin-testimonial-three' ),
					'bullet_pagination_position_type!' => array( 'absolute' ),
				),
			)
		);

		$this->add_responsive_control(
			'pagination_hr_line_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
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
					'{{WRAPPER}} .cdx-slider-pagination-wrap:after' => 'height: {{SIZE}}{{UNIT}} !important;',
				),

				'condition'  => array(
					'_skin'                            => array( 'skin-testimonial-three' ),
					'bullet_pagination_position_type!' => array( 'absolute' ),
				),

			)
		);

		$this->add_control(
			'testimonial_hr_line_color',
			array(
				'label'     => __( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-slider-pagination-wrap:after' => 'background-color: {{VALUE}};',
				),

				'condition' => array(
					'_skin'                            => array( 'skin-testimonial-three' ),
					'bullet_pagination_position_type!' => array( 'absolute' ),
				),
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
					'{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),

			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_btn_border',
				'selector'  => '{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet, {{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet',
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
					'{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background',
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet, {{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet',

			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'pagination_active_tab',
			array(
				'label' => esc_html__( 'Active', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'pagination_btn_outer_size',
			array(
				'label'      => esc_html__( 'Outer Size', 'codexshaper-framework' ),
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
					'{{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet-active:after' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				),

			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'btn_background_active',
				'types'    => array( 'classic', 'gradient', 'video' ),
				'selector' => '{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet-active, {{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet-active',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'pagination_btn_border_active',
				'selector'  => '{{WRAPPER}} .cdx-pagination-bullet .swiper-pagination-bullet-active, {{WRAPPER}} .cdx-pagination-style-3 .swiper-pagination-bullet-active:after',
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
		$data = array(
			'class' => 'cdx-testimonial-slider-1',
		);

		$this->add_slider_attributes( $this, $data );
		$this->add_thumb_slider_attributes( $this );

		$settings          = $this->get_settings_for_display();
		$previous_btn_icon = ! empty( $settings['previous_btn_icon'] ) ? Icons_Manager::try_get_icon_html(
			$settings['previous_btn_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		$next_btn_icon = ! empty( $settings['next_btn_icon'] ) ? Icons_Manager::try_get_icon_html(
			$settings['next_btn_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		// Get star icon.
		$star_icon = ! empty( $settings['star_icon'] ) ? Icons_Manager::try_get_icon_html(
			$settings['star_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		$is_thumb_slider    = $settings['cxf_thumb_slider'] ?? '';
		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		$is_navigation = $this->get_settings_for_display( $this->slider_control_prefix . '_navigation' );
		$is_pagination = $this->get_settings_for_display( $this->slider_control_prefix . '_pagination' );
		$is_lazy_load  = 'yes' === $settings['lazy_load'];

		if ( ! empty( $settings['items'] ) ) {
			foreach ( $settings['items'] as $item ) {
				$image_size          = $item['author_image_size'] ?? 'full';
				$author_image        = $item['testimonial_author_image'] ?? null;
				$author_image_id     = $author_image['id'] ?? null;
				$author_size_image[] = $this->get_size_image(
					image_id: $author_image_id,
					size: $image_size,
					is_custom_lazy: $is_lazy_load,
					attributes: array(
						'alt'          => 'Image',
						'class'        => '',
						'fallback_url' => 0 < $author_image_id ? '' : $author_image['url'],
					)
				);
			}
		}
		$data = array(
			'settings'          => $settings,
			'author_size_image' => $author_size_image,
			'is_thumb_slider'   => $is_thumb_slider,
			'is_navigation'     => $is_navigation,
			'is_pagination'     => $is_pagination,
			'is_lazy_load'      => $is_lazy_load,
			'previous_btn_icon' => $previous_btn_icon,
			'next_btn_icon'     => $next_btn_icon,
			'star_icon'         => $star_icon,
			'instance'          => $this,
		);
		cxf_view( 'testimonial-slider.content', $data );
	}
}
