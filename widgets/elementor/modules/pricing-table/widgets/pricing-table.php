<?php
/**
 * Pricing Table Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\PricingTable\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Pricing Table widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Pricing_Table extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--pricing-table';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Pricing Table', 'codexshaper-framework' );
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
		return 'eicon-price-table';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Pricing Table', 'CodexShaper', 'CodexShaper_Framework' );
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
		return array( 'eb-widget-pricing-table' );
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
			'general_settings',
			array(
				'label' => __( 'General Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'active_duration',
			array(
				'label'   => esc_html__( 'Active Duration', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => array(
					'yearly'  => esc_html__( 'Yearly', 'codexshaper-framework' ),
					'monthly' => esc_html__( 'Monthly', 'codexshaper-framework' ),
				),
			)
		);
		$this->add_control(
			'plan_type',
			array(
				'label'       => __( 'Plan Type', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Regular Plan', 'codexshaper-framework' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'curency_sign',
			array(
				'label'       => __( 'Curency Sign', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '$', 'codexshaper-framework' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'price',
			array(
				'label'       => esc_html__( 'Price', 'codexshaper-framework' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => esc_html__( '09.96', 'codexshaper-framework' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'duration',
			array(
				'label'       => esc_html__( 'Duration', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Monthly', 'codexshaper-framework' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'btn_icon',
			array(
				'label'   => esc_html__( 'Button Icon', 'codexshaper-framework' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(),

			),
		);
		$this->add_control(
			'btn_icon_width',
			array(
				'label'      => esc_html__( 'Button Icon Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
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
					'size' => 50,
				),
				'selectors'  => array(
					'{{WRAPPER}} .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'btn_title',
			array(
				'label'   => __( 'Button Title', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Choose this Package', 'codexshaper-framework' ),

			)
		);
		$this->add_control(
			'btn_link',
			array(
				'label'   => __( 'Button Link', 'codexshaper-framework' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => '#',
				),

			)
		);
		$repeater_two = new Repeater();
		$repeater_two->add_control(
			'price_section_name',
			array(
				'label'       => __( 'Price Section Name', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'placeholder' => __( 'Enter price section name ', 'codexshaper-framework' ),
				'description' => ( 'Enter exactly same price section name where you want to add feature' ),
			)
		);
		$repeater_two->add_control(
			'feature_icon',
			array(
				'label'   => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(),

			),
		);
		$repeater_two->add_control(
			'feature_icon_width',
			array(
				'label'      => esc_html__( 'Icon Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .feature-icon' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$repeater_two->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( '12 Hours Access', 'codexshaper-framework' ),
			)
		);
		$this->add_control(
			'features',
			array(
				'label'  => __( 'Features', 'codexshaper-framework' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater_two->get_controls(),
			)
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'styling_pricing_card',
			array(
				'label' => __( 'Pricing Card Styling', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'pricing_card_margin',
			array(
				'label'      => esc_html__( 'Pricing Card Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricin_card_padding',
			array(
				'label'      => esc_html__( 'Pricing Card Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .single-pricing',
			)
		);
		$this->add_control(
			'cxf_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .single-pricing' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'content_gap',
			array(
				'label'      => esc_html__( 'Content Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
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
					'unit' => 'rem',
					'size' => 3,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricing_duration_active_color',
			array(
				'label'     => __( 'Active Duration Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .single-pricing .pricing-plan-duration .active' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pricing_heading_color',
			array(
				'label'     => __( 'Pricing Heading Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .single-pricing .pricing-plan-duration' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_heading_typography',
				'label'    => __( 'Pricing Heading Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .single-pricing .pricing-plan-duration',
			)
		);
		$this->add_control(
			'pricing_heading_margin',
			array(
				'label'      => esc_html__( 'Pricing Heading Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing .pricing-plan-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricing_title_color',
			array(
				'label'     => __( 'Pricing Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .single-pricing .pricing-plan' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_title_typography',
				'label'    => __( 'Pricing Title Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .single-pricing .pricing-plan',
			)
		);
		$this->add_control(
			'pricing_title_margin',
			array(
				'label'      => esc_html__( 'Pricing Title Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing .pricing-plan' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_feature',
			array(
				'label' => __( 'Pricing Feature', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'pricing_feature_margin',
			array(
				'label'      => esc_html__( 'Pricing Feature Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing .pricing-plan-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricing_features_color',
			array(
				'label'     => __( 'Pricing Features Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .single-pricing .pricing-plan-item' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_features_typography',
				'label'    => __( 'Pricing Features Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .single-pricing .pricing-plan-item',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pricing',
			array(
				'label' => __( 'Pricing', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'pricing_margin',
			array(
				'label'      => esc_html__( 'Pricing Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .single-pricing .plan-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricing_price_color',
			array(
				'label'     => __( 'Pricing Price Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .single-pricing .plan-price' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_price_typography',
				'label'    => __( 'Pricing Price Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .single-pricing .plan-price',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_btn',
			array(
				'label' => __( 'Button', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'btn_margin',
			array(
				'label'      => esc_html__( 'Button Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'default'    => array(
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .rory-btn-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'pricing_btn_color',
			array(
				'label'     => __( 'Pricing Button Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .rory-btn-primary' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pricing_btn_hover_color',
			array(
				'label'     => __( 'Pricing Button Hover Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .rory-btn-primary:hover' => 'background-color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pricing_btn_title_color',
			array(
				'label'     => __( 'Pricing Button Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .rory-btn-primary' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_control(
			'pricing_btn_hover_title_color',
			array(
				'label'     => __( 'Pricing Button Hover Title Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => array(
					'{{WRAPPER}} .rory-btn-primary:hover' => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pricing_btn_title_typography',
				'label'    => __( 'Pricing Button Title Typography', 'codexshaper-framework' ),
				'selector' => '{{WRAPPER}} .rory-btn-primary',
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
		$settings       = $this->get_settings_for_display();
		$price_features = '';
		if ( ! empty( $settings['btn_icon'] ) ) {
			$btn_icon = Icons_Manager::try_get_icon_html(
				$settings['btn_icon'],
				array(
					'aria-hidden' => 'true',
					'fill'        => 'currentColor',
					'width'       => '16',
				)
			);
		}

		foreach ( $settings['features'] as $feature ) {
			if ( ! empty( $feature['feature_icon'] ) ) {
				$feature_icon = Icons_Manager::try_get_icon_html(
					$feature['feature_icon'],
					array(
						'aria-hidden' => 'true',
						'fill'        => 'currentColor',
						'width'       => '16',
					)
				);
			}
			$price_features .= "<i class='feature-icon'>" . $feature_icon . '</i>';
		}

		$data = array(
			'settings'       => $settings,
			'btn_icon'       => $btn_icon,
			'price_features' => $price_features,
			'class_monthly'  => 'monthly' === $settings['active_duration'] ? 'active' : 'text-mute',
			'class_yearly'   => 'yearly' === $settings['active_duration'] ? 'active' : 'text-mute',
		);
		cxf_view( 'pricing-table.content', $data );
	}
}
