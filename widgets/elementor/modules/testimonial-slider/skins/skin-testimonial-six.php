<?php
/**
 * Elementor Widget Skin: Testimonial Six
 *
 * @package  CodexShaperFramework
 * @since   1.0.0
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 */
namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins;

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor widget skin base class.
 *
 * @since 1.0.0
 * @category   Class
 * @package    CodexShaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 */
class Skin_Testimonial_Six extends Skin_Testimonial_Base
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
		return 'skin-testimonial-six';
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
		return __('Testimonial Six', 'codexshaper-framework');
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
		add_action('elementor/element/cxf--eb-widget-testimonial-slider/settings_section/before_section_end', [$this, 'inject_layout_controls']);
		add_action('elementor/element/cxf--eb-widget-testimonial-slider/styling_section/after_section_end', [$this, 'register_style_sections']);
	}

	/**
	 * Inject layout controls.
	 *
	 * Used to add new controls to the widget.
	 *
	 * @access public
	 */
	public function inject_layout_controls()
	{

		$this->parent->start_injection([
			'at' => 'after',
			'of' => 'items',
		]);

		$this->add_control(
			'background_image',
			array(
				'label'     => __('Background Image', 'codexshaper-framework'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'image' => array(
						'url' => Utils::get_placeholder_image_src(),
					),
				),
			)
		);

		$this->parent->end_injection();
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
			'styling_section_06',
			array(
				'label'     => __('General Style', 'codexshaper-framework'),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'normal_tab_06',
		);

		$this->start_controls_tab(
			'normal_06_tab',
			array(
				'label' => __('Normal', 'codexshaper-framework'),
			)
		);

		$this->add_responsive_control(
			'section_06_margin',
			array(
				'label'      => esc_html__('Section Margin', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'section_06_padding',
			array(
				'label'      => esc_html__('Section Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'icon_06_padding',
			array(
				'label'      => esc_html__('Icon Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_responsive_control(
			'star_icon_06_gap',
			array(
				'label'      => __('Icon Gap', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon' => 'margin-right: {{SIZE}}{{UNIT}};'
				),
			)
		);

		$this->add_responsive_control(
			'star_icon_06_size',
			array(
				'label'      => __('Star Icon size', 'codexshaper-framework'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'star_icon_06_color',
			array(
				'label'     => __('Star Icon Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-icon i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_06_padding',
			array(
				'label'      => esc_html__('Title Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_06_typography',
				'label'    => __('Testimonial Title Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-name',
			)
		);

		$this->add_control(
			'testimonial_title_06_color',
			array(
				'label'     => __('Testimonial Title Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tt_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('st hr', 'codexshaper-framework'),
			)
		);

		$this->add_responsive_control(
			'description_06_padding',
			array(
				'label'      => esc_html__('Description Padding', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'em', 'rem', 'custom'),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-item-4 .cdx-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'responsive' => true,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_06_typography',
				'label'    => __('Description Typography', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-content',
			)
		);

		$this->add_control(
			'description_06_color',
			array(
				'label'     => __('Description Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'c6_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('c hr', 'codexshaper-framework'),
			)
		);

		$this->add_control(
			'pagination_bg_color',
			array(
				'label'     => __('Pagination Background Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn' => 'background-color: {{VALUE}} !important',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'normal_6_hover_tab',
			array(
				'label' => __('Hover', 'codexshaper-framework'),
			)
		);

		$this->add_control(
			'testimonial_title_6_hover_color',
			array(
				'label'     => __('Testimonial Title Hover Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-name:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'tth6_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('tth hr', 'codexshaper-framework'),
			)
		);

		$this->add_control(
			'description__06_hover_color',
			array(
				'label'     => __('Description Hover Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-content:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'ch6_hr',
			array(
				'type'  => Controls_Manager::DIVIDER,
				'label' => __('ch6 hr', 'codexshaper-framework'),
			)
		);

		$this->add_control(
			'pagination_06_hover_bg_color',
			array(
				'label'     => __('Pagination Background Hover Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-navigation-style-6 .cdx-navigation-btn:hover' => 'background-color: {{VALUE}} !important',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'image_background',
			array(
				'label'     => __('Image Background', 'codexshaper-framework'),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'image_bg_tab',
		);

		$this->start_controls_tab(
			'image_bg_normal_tab',
			array(
				'label' => __('Normal', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'image_bg_color',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-thumbslide-4',
			)
		);

		$this->add_control(
			'thumb_border_radius',
			array(
				'label'      => __('Border Radius', 'codexshaper-framework'),
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
					'{{WRAPPER}} .cdx-testimonial-thumbslide-4' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow',
				'label'    => __('Box Shadow', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-thumbslide-4',
			)
		);

		$this->add_control(
			'border_width',
			array(
				'label'      => __('Border Width', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-thumbslide-4' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'border_color',
			array(
				'label'     => __('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-thumbslide-4' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'border_style',
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
					'{{WRAPPER}} .cdx-testimonial-thumbslide-4' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_bg_hover_tab',
			array(
				'label' => __('Hover', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'image_hover_bg_color',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-thumbslide-4:hover',
			)
		);

		$this->add_control(
			'thumb_hover_border_radius',
			array(
				'label'      => __('Border Radius Hover', 'codexshaper-framework'),
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
					'{{WRAPPER}} .cdx-testimonial-thumbslide-4:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_shadow_hover',
				'label'    => __('Box Shadow Hover', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-thumbslide-4:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_background_06',
			array(
				'label'     => __('Testimonial Background', 'codexshaper-framework'),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'testimonial_bg_tab_6',
		);

		$this->start_controls_tab(
			'testimonial_bg_normal_tab_6',
			array(
				'label' => __('Normal', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_bg_color_6',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-4',

			)
		);

		$this->add_control(
			'testimonial_border_radius_6',
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
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'testimonial_shadow_6',
				'label'    => __('Hero Shadow', 'codexshaper-framework'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-4',
			)
		);

		$this->add_control(
			'testimonial_border_width_6',
			array(
				'label'      => __('Border Width', 'codexshaper-framework'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', 'rem'),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_color_6',
			array(
				'label'     => __('Border Color', 'codexshaper-framework'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'testimonial_border_style_6',
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
					'{{WRAPPER}} .cdx-testimonial-area-4' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_bg_hover_tab_6',
			array(
				'label' => __('Hover', 'codexshaper-framework'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'testimonial_hover_bg_color_6',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .cdx-testimonial-area-4:hover',
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
		$this->get_control_id('background_image');
		$settings          = $this->parent->get_settings_for_display();
		$parent = $this->parent;
		$data = [
			'class' => 'cdx-testimonial-thumb-4',
		];
		$data_thumb = [
			'class' => 'cdx-testimonial-galler-4',
		];

		$this->parent->add_slider_attributes($this->parent, $data);
		$this->parent->add_thumb_slider_attributes($this->parent, $data_thumb);
		$previous_btn_icon = ! empty($settings['previous_btn_icon']) ? Icons_Manager::try_get_icon_html(
			$settings['previous_btn_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		$next_btn_icon = ! empty($settings['next_btn_icon']) ? Icons_Manager::try_get_icon_html(
			$settings['next_btn_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		// Get star icon.
		$star_icon    = ! empty($settings['star_icon']) ? Icons_Manager::try_get_icon_html(
			$settings['star_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		$bg_img_url        = ! empty($settings['skin_testimonial_six_background_image']['url']) ? $settings['skin_testimonial_six_background_image']['url'] : Utils::get_placeholder_image_src();
		$is_thumb_slider = $settings['cxf_thumb_slider'] ?? '';

		$is_lazy_load = 'yes' === $settings['lazy_load'];
		if (! empty($settings['items'])) {
			foreach ($settings['items'] as $key => $item) {
				$image_size = $item['author_image_size'] ?? 'full';
				$author_image = $item['testimonial_author_image'] ?? null;
				$author_image_id = $author_image['id'] ?? null;
				$author_size_image[] = $this->get_size_image(
					image_id: $author_image_id,
					size: $image_size,
					is_custom_lazy: $is_lazy_load,
					attributes: [
						'alt' => 'Image',
						'class' => 'cdx-thumb',
						'fallback_url' => 0 < $author_image_id ? '' : $author_image['url'],
					]
				);
			}
		}
		$data = array(
			'parent' => $parent,
			'settings' => $settings,
			'author_size_image' => $author_size_image,
			'star_icon' => $star_icon,
			'bg_img_url' => $bg_img_url,
			'is_thumb_slider' => $is_thumb_slider,
			'is_lazy_load' => $is_lazy_load,
			'previous_btn_icon' => $previous_btn_icon,
			'next_btn_icon' => $next_btn_icon,
		);
		cxf_view('testimonial-slider.skins.testimonial-slider-six', $data);
	}
}
