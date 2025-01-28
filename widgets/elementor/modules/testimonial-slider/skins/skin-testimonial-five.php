<?php
/**
 * Skin_testimonial_Five Widget file
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Skin_testimonial_Five Class.
 * @category   Class
 * @package    CodexShaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Skin_Testimonial_Five extends Skin_Testimonial_Base
{

	/**
	 * Get skin ID.
	 *
	 * Retrieve the skin ID.
	 *
	 * @since 1.0.0
	 * @access public
	 * @abstract
	 */
	public function get_id()
	{
		return 'skin-testimonial-five';
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
	public function get_title()
	{
		return __('Testimonial Five', 'codexshaper-framework');
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
	protected function _register_controls_actions()
	{
		add_action('elementor/element/cxf--eb-widget-testimonial-slider/styling_section/after_section_end', [$this, 'register_style_sections']);
	}

	/**
	 * Register style controls.
	 *
	 * Used to add new controls to the widget.
	 *
	 * @access public
	 * @param Widget_Base $widget The widget object that is being injected.
	 * @return void
	 */
	public function register_style_sections(Widget_Base $widget)
	{
		$this->parent = $widget;

		$this->start_controls_section(
			'styling_section_05',
			array(
				'label'     => __('General Style', 'codexshaper-framework'),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'section_margin_5',
			array(
				'label'      => esc_html__('Section Margin', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'section_padding_5',
			array(
				'label'      => esc_html__('Section Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'image_size_05',
			array(
				'label'      => __('Image size', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slide-9 .cdx-client-wrap' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',

				),
			)
		);

		$this->add_responsive_control(
			'image_radius_05',
			array(
				'label'      => __('Image Border Radius', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slide-9 .cdx-client-wrap' => 'border-radius: {{SIZE}}{{UNIT}};',

				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typography',
				'label'    => __('Description Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-content',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __('Description Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_padding_5',
			array(
				'label'      => esc_html__('Description Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_control(
			'description_show_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('description show hr', 'codexshaper-framework'),
			)
		);

		$this->add_responsive_control(
			'name_padding_5',
			array(
				'label'      => esc_html__('Name Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slide-9 .cdx-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => __('Name Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-name',
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __('Name Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'name_show_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('name show hr', 'codexshaper-framework'),
			)
		);

		$this->add_responsive_control(
			'designation_padding_5',
			array(
				'label'      => esc_html__('Designation Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-slide-9 .cdx-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => __('Designation Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-designation',
			)
		);

		$this->add_control(
			'designation_color',
			array(
				'label'     => __('Designation Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-designation' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'designation_show_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('designation show hr', 'codexshaper-framework'),
			)
		);

		$this->start_controls_tabs(
			'navigation_style_tabs'
		);

		$this->start_controls_tab(
			'navigation_normal_tab',
			[
				'label' => esc_html__('Normal', 'codexshaper-framework'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'next_prev_typography',
				'label'    => __('Next and Previous Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-prev-btn, {{WRAPPER}} .cdx-navigation-wrap-9 .cdx-next-btn',

			)
		);

		$this->add_control(
			'next_prev_color',
			array(
				'label'     => __(' Next and Previous Text Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-prev-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-next-btn' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'navigation_border_width',
			array(
				'label'      => __('Border Width', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-btn-navigation:nth-child(1)' => 'border-right: {{SIZE}}{{UNIT}} solid;',
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-btn-navigation:nth-child(2)' => 'border-left: {{SIZE}}{{UNIT}} solid;',
				),
			)
		);

		$this->add_control(
			'nav_border_color',
			array(
				'label'     => __(' Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-btn-navigation:nth-child(1)' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-btn-navigation:nth-child(2)' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_hover_tab',
			[
				'label' => esc_html__('Hover', 'codexshaper-framework'),
			]
		);

		$this->add_control(
			'next_prev_hover_color',
			array(
				'label'     => __(' Next and Previous Text Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-prev-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cdx-navigation-wrap-9 .cdx-next-btn:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_background_style_05',
			array(
				'label'     => __('Testimonial Background', 'codexshaper-framework'),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'testimonial_bg_tab_05',
		);

		$this->start_controls_tab(
			'testimonial_bg_normal_tab_05',
			array(
				'label' => __('Normal', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_bg_color_05',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-9',

			)
		);

		$this->add_control(
			'testimonial_border_radius_05',
			array(
				'label'      => __('Testimonial Border Radius', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
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
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'testimonial_shadow_05',
				'label'    => __('Hero Shadow', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-9',
			)
		);

		$this->add_control(
			'testimonial_border_width_05',
			array(
				'label'      => __('Border Width', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_color_05',
			array(
				'label'     => __('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_style_05',
			array(
				'label'     => __('Border Style', 'codexshaper-framework'),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => __('None', 'codexshaper-framework'),
					'solid'  => __('Solid', 'codexshaper-framework'),
					'dashed' => __('Dashed', 'codexshaper-framework'),
					'dotted' => __('Dotted', 'codexshaper-framework'),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-area-9' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_bg_hover_tab_05',
			array(
				'label' => __('Hover', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_hover_bg_color_05',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-9:hover',
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
	public function render()
	{

		$parent = $this->parent;
		$settings          = $parent->get_settings_for_display();
		$data = [
			'class' => 'cdx-testimonial-slider-9',
		];

		$parent->add_slider_attributes($parent, $data);

		$is_lazy_load = 'yes' === $settings['lazy_load'];
		if (! empty($settings['items'])) {
			foreach ($settings['items'] as $item) {
				$image_size = $item['author_image_size'] ?? 'full';
				$author_image = $item['testimonial_author_image'] ?? null;
				$author_image_id = $author_image['id'] ?? null;
				$author_size_image[] = $this->get_size_image(
					image_id: $author_image_id,
					size: $image_size,
					is_custom_lazy: $is_lazy_load,
					attributes: [
						'alt' => 'Client Image',
						'class' => 'cdx-client-img',
						'fallback_url' => 0 < $author_image_id ? '' : $author_image['url'],
					]
				);
			}
		}
		$data = array(
			'parent' => $this->parent,
			'settings' => $settings,
			'author_size_image' => $author_size_image ?? [],
			'is_lazy_load' => $is_lazy_load,
		);
		cxf_view('testimonial-slider.skins.testimonial-slider-five', $data);
	}
}
