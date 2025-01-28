<?php
/**
 * Social_Share Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\SocialShare\Widgets;

use CodexShaper\Framework\Widgets\Elementor\Modules\SocialShare\Module;
use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Social_Share widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Social_Share extends Widget {
	use Fields;

	/**
	 * Social_Share
	 *
	 * @access private
	 * @var    array
	 */
	private static $network_icons = array(
		'email'     => 'fa fa-envelope',
		'pocket'    => 'fa fa-get-pocket',
		'vkontakte' => 'fa fa-vk',
	);

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--social-share';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Social Share', 'codexshaper-framework' );
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
		return 'eicon-share';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Social Share', 'sharing', 'social', 'icon', 'button', 'like', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--social-share' );
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
		return array( 'cxf--goodshare' );
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
		// Register icon style controls.
		$this->register_style_controls_social_item_icon();
		// Register social title style controls.
		$this->register_style_controls_social_item_title();
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
				'label'   => esc_html__( 'Heading Title', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Share: ',
			),
		);

		$this->add_control(
			'header_tag',
			array(
				'label'   => esc_html__( 'Heading Tag', 'codexshaper-framework' ),
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

		$options = Module::get_options();

		$repeater = new Repeater();

		$repeater->add_control(
			'network',
			array(
				'label'   => esc_html__( 'Social Network', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $options,
				'default' => 'facebook',
			)
		);

		$repeater->add_control(
			'text',
			array(
				'label' => esc_html__( 'Custom Label', 'codexshaper-framework' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'share_icon',
			array(
				'label' => esc_html__( 'Share Icon', 'codexshaper-framework' ),
				'type'  => Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'share_buttons',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'network' => 'facebook' ),
					array( 'network' => 'linkedin' ),
					array( 'network' => 'twitter' ),
				),
				'title_field' => '{{{ network }}}',
			)
		);

		$this->add_control(
			'view',
			array(
				'label'        => esc_html__( 'View', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SELECT,
				'label_block'  => false,
				'options'      => array(
					'icon-text' => 'Icon & Text',
					'icon'      => 'Icon',
					'text'      => 'Text',
				),
				'default'      => 'icon-text',
				'separator'    => 'before',
				'prefix_class' => 'cxf--share-btns-view-',
				'render_type'  => 'template',
			)
		);

		$this->add_control(
			'show_label',
			array(
				'label'     => esc_html__( 'Show label', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'view' => 'icon-text',
				),
			)
		);

		$alert_content = sprintf(
			/* translators: Link opening tag */
			esc_html__( 'Note: Social share count only works with those platform: vkontakte, facebook, odnoklassniki, moimir, linkedin, tumblr, pinterest, buffer.', 'codexshaper-framework' )
		);

		$this->add_control(
			'counter_alert',
			array(
				'type'       => Controls_Manager::ALERT,
				'alert_type' => 'warning',
				'heading'    => 'Social count alert',
				'content'    => $alert_content,
			)
		);

		$this->add_control(
			'show_counter',
			array(
				'label'     => esc_html__( 'Show count', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'view!' => 'icon',
				),
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

		$this->common_space_controls(
			'social_items_space',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'social_items_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--social-share-wrapper',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'social_items_border',
				'selector' => '{{WRAPPER}} .cxf--social-share-wrapper',
			)
		);

		$this->add_responsive_control(
			'social_items_border_radius',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'share_items_position',
			array(
				'label'     => esc_html__( 'Items Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-left',
					),
					'column' => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-up',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--social-share-content-wrapper' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'share_icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'            => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-left',
					),
					'row-reverse'    => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column'         => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-up',
					),
					'column-reverse' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--social-share-item' => 'flex-direction: {{VALUE}};',
				),

				'condition' => array(
					'view' => 'icon-text',
				),
			)
		);

		$this->add_responsive_control(
			'social_items_gap',
			array(
				'label'      => esc_html__( 'Items Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-content-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_inner_item_gap',
			array(
				'label'      => esc_html__( 'Inner Item Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-item' => 'gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'view' => 'icon-text',
				),
			)
		);

		$this->add_control(
			'share_title_heading',
			array(
				'label'     => esc_html__( 'Heading Title', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'title!' => '',
				),
			),
		);

		$this->add_responsive_control(
			'share_title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'title!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'share_title_position',
			array(
				'label'     => esc_html__( 'Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'            => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-left',
					),
					'row-reverse'    => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column'         => array(
						'title' => esc_html__( 'Top', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-up',
					),
					'column-reverse' => array(
						'title' => esc_html__( 'Bottom', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--social-share-wrapper' => 'flex-direction: {{VALUE}};',
				),
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'social_heading_title_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'title!' => '',
				),
			)
		);

		$this->start_controls_tabs(
			'share_title_style_tabs'
		);

		$this->start_controls_tab(
			'share_title_style_normal_tab',
			array(
				'label'     => esc_html__( 'Normal', 'codexshaper-framework' ),
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->common_text_controls(
			'share_title_text',
			options: array(
				'selector'   => '{{WRAPPER}} .cxf--social-share-title',
				'conditions' => array(
					'title!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'share_title_style_hover_tab',
			array(
				'label'     => esc_html__( 'Hover', 'codexshaper-framework' ),
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->common_text_controls(
			'share_title_text_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-title',
				'exclude'  => array(
					'Group_Control_Text_Stroke',
					'Group_Control_Text_Shadow',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget title style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_controls_social_item_title() {

		$this->start_controls_section(
			'social_title_section_style',
			array(
				'label'     => __( 'Social Title', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'view' => array( 'icon-text', 'text' ),
				),
			)
		);

		$this->add_responsive_control(
			'social_title_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'social_title_border',
				'selector' => '{{WRAPPER}} .cxf--social-share-item-title',
			)
		);

		$this->add_responsive_control(
			'social_title_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-item-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				),
			)
		);

		// tabs.
		$this->start_controls_tabs(
			'social_title_style_tabs'
		);

		$this->start_controls_tab(
			'social_title_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->common_text_controls(
			'social_item_title',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-item-title',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'social_title_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--social-share-item-title',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_title_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->common_text_controls(
			'social_item_title_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-item-title:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'social_title_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--social-share-item-title:hover',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Register Elementor widget icon style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_style_controls_social_item_icon() {

		$this->start_controls_section(
			'social_icon_section_style',
			array(
				'label'     => __( 'Social Icon', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'view' => array( 'icon-text', 'icon' ),
				),
			)
		);

		$this->add_control(
			'social_icon_bg_size',
			array(
				'label'      => esc_html__( 'Background Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-item-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'social_icon_border',
				'selector' => '{{WRAPPER}} .cxf--social-share-item-icon',
			)
		);

		$this->add_responsive_control(
			'social_icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-share-item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'social_icon_style_tabs'
		);

		$this->start_controls_tab(
			'social_icon_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'social_icon_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--social-share-item-icon',
			)
		);

		$this->common_icon_controls(
			'social_icon',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-item-icon',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icon_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'social_icon_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--social-share-item-icon:hover',
			)
		);

		$this->common_icon_controls(
			'social_icon_hover',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--social-share-item-icon:hover',
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

		$buttons = $settings['share_buttons'] ?? array();

		if ( empty( $buttons ) ) {
			return;
		}

		$this->add_render_attribute( 'social_share_wrapper', 'class', array( 'cxf--social-share-wrapper' ) );
		$this->add_render_attribute( 'social_share_content_wrapper', 'class', array( 'cxf--social-share-content-wrapper' ) );
		$this->add_render_attribute( 'title', 'class', array( 'cxf--social-share-title' ) );

		$title      = $settings['title'] ?? '';
		$title_html = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			Utils::validate_html_tag( $settings['header_tag'] ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);

		// Prepare data and attributes.
		$this->add_render_attribute( 'social_share_wrapper', 'class', 'cxf--social-share-wrapper' );
		$this->add_render_attribute( 'social_share_content_wrapper', 'class', 'cxf--social-share-content-wrapper' );

		$social_share_items = array();

		foreach ( $buttons as $button ) {
			$network_name      = $button['network'];
			$network           = Module::get_networks( $network_name );
			$title             = $network['title'];
			$has_network_count = $network['has_counter'] ?? false;
			$has_counter       = 'icon' !== $settings['view']
				&& 'yes' === $settings['show_counter']
				&& true === $has_network_count;
			$is_show_label     = 'yes' === $settings['show_label'] || 'text' === $settings['view'];
			$has_icon          = 'icon' === $settings['view'] || 'icon-text' === $settings['view'];
			$share_icon        = $button['share_icon'] ?? null;
			$share_icons[]     = $this->get_render_icon( $network_name, $share_icon );

			$this->add_render_attribute( 'social_share_item_wrapper', 'class', 'cxf--social-share-item-wrapper' );
			$this->add_render_attribute( "social_share_item_{$network_name}", 'class', array( 'cxf--social-share-item', "cxf--social-share-{$network_name}" ) );
			$this->add_render_attribute( "social_share_item_{$network_name}", 'data-social', $network_name );

			// Add item data to the array.
			$social_share_items[] = array(
				'wrapper_attr'  => $this->get_render_attribute_string( 'social_share_item_wrapper' ),
				'item_attr'     => $this->get_render_attribute_string( "social_share_item_{$network_name}" ),
				'has_icon'      => $has_icon,
				'show_text'     => $show_text ?? false,
				'is_show_label' => $is_show_label,
				'text'          => $button['text'] ?? '',
				'title'         => $title,
				'has_counter'   => $has_counter,
				'network_name'  => $network_name,
			);
		}
		$data = array(
			'social_share_items'   => $social_share_items,
			'wrapper_attr'         => $this->get_render_attribute_string( 'social_share_wrapper' ),
			'content_wrapper_attr' => $this->get_render_attribute_string( 'social_share_content_wrapper' ),
			'title_html'           => $title_html,
			'share_icons'          => $share_icons,
		);
		cxf_view( 'social-share.content', $data );
	}

	/**
	 * Render share icon.
	 *
	 * @param string $network_name network name.
	 * @param array  $share_icon share icon.
	 *
	 * @return void
	 */
	protected function render_share_icon( $network_name, $share_icon = null ) {
		$icon = $this->get_render_icon( $network_name, $share_icon );
		Utils::print_unescaped_internal_string( $icon );
	}

	/**
	 * Get share icon.
	 *
	 * @param string $network_name Network name.
	 * @param array  $share_icon Share icon.
	 *
	 * @return string Icon HTML.
	 */
	protected function get_render_icon( $network_name, $share_icon ) {
		if ( $share_icon && ! empty( $share_icon['value'] ) ) {
			return Icons_Manager::try_get_icon_html(
				$share_icon,
				array(
					'aria-hidden' => 'true',
					'class'       => 'share-ico',
				)
			);
		}

		$icon_data = $this->get_share_icon_data( $network_name );

		if ( Plugin::instance()->experiments->is_feature_active( 'e_font_icon_svg' ) ) {
			return Icons_Manager::render_font_icon( $icon_data );
		}

		return sprintf( '<i class="%s" aria-hidden="true"></i>', $icon_data['value'] );
	}

	/**
	 * Get share icon data.
	 *
	 * @param string $network_name  Network name.
	 *
	 * @return array Icon data.
	 */
	protected function get_share_icon_data( $network_name ) {

		$prefix  = 'fa ';
		$library = '';

		if ( Icons_Manager::is_migration_allowed() ) {
			$prefix  = 'fab ';
			$library = 'fa-brands';
		}

		$icon_class = static::$network_icons[ $network_name ] ?? "{$prefix} fa-{$network_name}";

		return array(
			'value'   => $icon_class,
			'library' => $library,
		);
	}
}
