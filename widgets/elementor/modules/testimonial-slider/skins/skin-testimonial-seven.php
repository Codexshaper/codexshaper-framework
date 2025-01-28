<?php
/**
 * Testimonial_Seven Widget file
 *
 * @category   Widget
 * @package    CodexShaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins;

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Skin_Testimonial_Seven class.
 *
 * @category   Class
 * @package    CodexShaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Skin_Testimonial_Seven extends Skin_Testimonial_Base {

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
		return 'skin-testimonial-seven';
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
		return __( 'Testimonial Seven', 'codexshaper-framework' );
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
		add_action( 'elementor/element/cxf--eb-widget-testimonial-slider/settings_section/before_section_end', array( $this, 'inject_layout_controls' ) );
		add_action( 'elementor/element/cxf--eb-widget-testimonial-slider/styling_section/after_section_end', array( $this, 'register_style_sections' ) );
	}

	/**
	 * Register skin controls.
	 *
	 * Register new controls to be injected to the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function inject_layout_controls() {

		$this->parent->start_injection(
			array(
				'at' => 'after',
				'of' => 'star_icon',
			)
		);

		$this->add_control(
			'mask_image',
			array(
				'label'   => __( 'Mask Image', 'codexshaper-framework' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'image' => array(
						'url' => Utils::get_placeholder_image_src(),
					),
				),
			)
		);

		$this->parent->end_injection();
	}

	/**
	 * Register skin controls.
	 *
	 * Register new controls to be injected to the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param Widget_Base $widget Widget Object.
	 */
	public function register_style_sections( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'styling_section_7',
			array(
				'label' => __( 'General Styling', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'normal_tab_7',
		);

		$this->start_controls_tab(
			'normal_text_tab_7',
			array(
				'label' => __( 'Normal', 'codexshaper-framework' ),
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
					'{{WRAPPER}} .cdx-testimonial-item-7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'icon_07_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'star_icon_07_gap',
			array(
				'label'      => __( 'Star Icon Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon' => 'margin-right: {{SIZE}}{{UNIT}};',

				),
			)
		);

		$this->add_responsive_control(
			'star_icon_07_size',
			array(
				'label'      => __( 'Star Icon size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',

				),
			)
		);

		$this->add_control(
			'star_icon_07_color',
			array(
				'label'     => __( 'Star Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-icon i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_7_typography',
				'label'    => __( 'Testimonial Title Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-7 .cdx-title',
			)
		);

		$this->add_control(
			'testimonial_title_color_7',
			array(
				'label'     => __( 'Testimonial Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding_07',
			array(
				'label'      => esc_html__( 'Title Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'title_7_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'title_7 hr', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_7_typography',
				'label'    => __( 'Description Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-7 .cdx-content',
			)
		);

		$this->add_control(
			'description_7_color',
			array(
				'label'     => __( 'Description Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_padding_07',
			array(
				'label'      => esc_html__( 'Description Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'content_7_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'content 7 hr', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'name_padding_07',
			array(
				'label'      => esc_html__( 'Name Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_name_7_typography',
				'label'    => __( 'Author Name Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-7 .cdx-name',
			)
		);

		$this->add_control(
			'author_name_7_color',
			array(
				'label'     => __( 'Author Name Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'name_hr_line_7',
			array(
				'label'      => __( 'Hr Line', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 80,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-name::before' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'client_info_padding',
			array(
				'label'      => esc_html__( 'Author Info Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 cdx-client-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'author_7_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'author 7 hr', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'designation_padding_07',
			array(
				'label'      => esc_html__( 'Designation Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_7_typography',
				'label'    => __( 'Designation Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-item-7 .cdx-designation',
			)
		);

		$this->add_control(
			'designation_7_color',
			array(
				'label'     => __( 'Designation Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-designation' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_border_heading',
			array(
				'type'  => Controls_Manager::HEADING,
				'label' => esc_html__( 'Content Border', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'label'     => __( 'Content Border', 'codexshaper-framework' ),
				'selector'  => '{{WRAPPER}} .cdx-testimonial-thumbslider-7',
				'separator' => 'after',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'normal_text_hover_tab_7',
			array(
				'label' => __( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'testimonial_title_hover_color',
			array(
				'label'     => __( 'Testimonial Title Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-title:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title 7 hover_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'title 7 hover hr', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'description_7_hover_color',
			array(
				'label'     => __( 'Description Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-content:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_7_hover_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'content_7_hover hr', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'author_name_7_color_hover',
			array(
				'label'     => __( 'Author Name Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-name:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'author_7_hover_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __( 'author 7 hover hr', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'designation_7_hover_color',
			array(
				'label'     => __( 'Designation Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-7 .cdx-designation:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_background_7',
			array(
				'label' => __( 'Testimonial Background', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'testimonial_bg_tab_7',
		);

		$this->start_controls_tab(
			'testimonial_bg_normal_tab_7',
			array(
				'label' => __( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'testimonial_07_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_bg_color_7',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-7',

			)
		);

		$this->add_control(
			'testimonial_border_radius_7',
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
					'{{WRAPPER}} .cdx-testimonial-area-7' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'testimonial_shadow_7',
				'label'    => __( 'Hero Shadow', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-7',
			)
		);

		$this->add_control(
			'testimonial_border_width_7',
			array(
				'label'      => __( 'Border Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-7' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_color_7',
			array(
				'label'     => __( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-area-7' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_style_7',
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
					'{{WRAPPER}} .cdx-testimonial-area-7' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'testimonial_bg_hover_tab_7',
			array(
				'label' => __( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_hover_bg_color_7',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-7:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
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

		$settings   = $this->parent->get_settings_for_display();
		$parent     = $this->parent;
		$data       = array(
			'class' => 'cdx-testimonial-thumbslider-7',
		);
		$data_thumb = array(
			'class' => 'cdx-testimonial-slider-7',
		);

		$this->parent->add_slider_attributes( $this->parent, $data );
		$this->parent->add_thumb_slider_attributes( $this->parent, $data_thumb );

		$this->get_control_id( 'mask_image' );
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
		$star_icon    = ! empty( $settings['star_icon'] ) ? Icons_Manager::try_get_icon_html(
			$settings['star_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';
		$mask_img_url = ! empty( $settings['skin_testimonial_seven_mask_image']['url'] ) ? $settings['skin_testimonial_seven_mask_image']['url'] : Utils::get_placeholder_image_src();

		$is_lazy_load = 'yes' === $settings['lazy_load'];
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
						'class'        => 'cdx-thumb',
						'fallback_url' => 0 < $author_image_id ? '' : $author_image['url'],
						'style'        => 'mask-image: url(' . esc_url( $mask_img_url ) . ')',
					)
				);
			}
		}
		$data = array(
			'parent'            => $parent,
			'settings'          => $settings,
			'author_size_image' => $author_size_image ?? array(),
			'previous_btn_icon' => $previous_btn_icon,
			'next_btn_icon'     => $next_btn_icon,
			'star_icon'         => $star_icon,
		);
		cxf_view( 'testimonial-slider.skins.testimonial-slider-seven', $data );
	}
}
