<?php
/**
 * Nav_Menu Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\NavMenu\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Menu\NavMenuWalker;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Nav_Menu widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Nav_Menu extends Widget {


	/**
	 * Nav_Menu Index.
	 *
	 * @var int
	 * @access protected
	 */
	protected $nav_menu_index = 1;

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--nav-menu';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Nav Menu', 'codexshaper-framework' );
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
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Nav Menu', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--nav-menu' );
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
		return array( 'cxf--nav-menu' );
	}

	/**
	 * Get Nav Menu.
	 *
	 * @return int Nav Menu.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Get available menus.
	 *
	 * @return array
	 */
	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = array();

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
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
		// Register Layout Controls.
		$this->register_layout_controls();

		// Style controls.
		$this->register_style_controls();

		// Mobile menu item.
		$this->register_mobile_menu_style();
	}

	/**
	 * Register Layout Controls.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	public function register_layout_controls() {
		$this->start_controls_section(
			'_section_cxf--nav-menu',
			array(
				'label' => __( 'Main Menu Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'menu_name',
			array(
				'label'   => esc_html__( 'Menu Name', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Menu', 'codexshaper-framework' ),
			)
		);

		$menus         = $this->get_available_menus();
		$alert_title   = '';
		$alert_message = sprintf(
						/* translators: 1: Link opening tag, 2: Link closing tag. */
			esc_html__( 'Go to the %1$sMenus screen%2$s to manage your menus.', 'codexshaper-framework' ),
			sprintf( '<a href="%s" target="_blank">', admin_url( 'nav-menus.php' ) ),
			'</a>'
		);

		if ( empty( $menus ) ) {
			$alert_title   = 'There is no menu found in your site.';
			$alert_message = sprintf(
					/* translators: 1: Link opening tag, 2: Link closing tag. */
				esc_html__( 'Go to the %1$sMenus screen%2$s to create a new menu.', 'codexshaper-framework' ),
				sprintf( '<a href="%s" target="_blank">', admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
				'</a>'
			);
		}

		$this->add_control(
			'menu_alert',
			array(
				'type'       => Controls_Manager::ALERT,
				'alert_type' => 'info',
				'heading'    => $alert_title,
				'content'    => $alert_message,
			)
		);

		$this->add_control(
			'menu',
			array(
				'label'        => esc_html__( 'Menu', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => $menus,
				'default'      => array_key_first( $menus ),
				'save_default' => true,
				'separator'    => 'after',
			)
		);

		$this->add_control(
			'menu_layout',
			array(
				'label'   => esc_html__( 'Layout', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'horizontal' => esc_html__( 'Horizontal', 'codexshaper-framework' ),
					'vertical'   => esc_html__( 'Vertical', 'codexshaper-framework' ),
				),
				'default' => 'horizontal',
			)
		);

		$icon_prefix = Icons_Manager::is_migration_allowed() ? 'fas ' : 'fa ';

		$this->add_control(
			'submenu_indicator',
			array(
				'label'       => esc_html__( 'Submenu Indicator', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'separator'   => 'before',
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => $icon_prefix . 'fa-caret-down',
					'library' => 'fa-solid',
				),
			)
		);

		$start = is_rtl() ? 'end' : 'start';
		$end   = is_rtl() ? 'start' : 'end';

		$this->add_responsive_control(
			'menu_align_items',
			array(
				'label'              => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Start', 'codexshaper-framework' ),
						'icon'  => "eicon-align-$start-h",
					),
					'center'        => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-center-h',
					),
					'flex-end'      => array(
						'title' => esc_html__( 'End', 'codexshaper-framework' ),
						'icon'  => "eicon-align-$end-h",
					),
					'space-between' => array(
						'title' => esc_html__( 'Stretch', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-stretch-h',
					),
				),
				'selectors'          => array(
					'{{WRAPPER}} .cxf-menu-nav' => 'justify-content: {{VALUE}};',
				),
				// For BC.
				'classes_dictionary' => array(
					'left'  => is_rtl() ? 'end' : 'start',
					'right' => is_rtl() ? 'start' : 'end',
				),
				'prefix_class'       => 'cxf-nav-menu-align-',
			)
		);

		$this->add_control(
			'menu_pointer',
			array(
				'label'          => esc_html__( 'Menu Pointer', 'codexshaper-framework' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'underline',
				'options'        => array(
					'none'      => esc_html__( 'None', 'codexshaper-framework' ),
					'underline' => esc_html__( 'Underline', 'codexshaper-framework' ),
					'overline'  => esc_html__( 'Overline', 'codexshaper-framework' ),
				),
				'style_transfer' => true,
			)
		);

		$this->add_control(
			'mobile_menu_heading',
			array(
				'label'     => esc_html__( 'Mobile Menu Settings', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'show_mobile_menu',
			array(
				'label'        => esc_html__( 'Does show mobile menu?', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Enable if you want to add Mobile Menu.', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'menu_hamburger_icon',
			array(
				'label'       => esc_html__( 'Hamburger Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => $icon_prefix . 'fa-bars',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);

		$this->add_control(
			'menu_close_icon',
			array(
				'label'       => esc_html__( 'Mobile Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => $icon_prefix . 'fa-times',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'show_mobile_menu' => 'yes',
				),
			)
		);

		$breakpoints          = Plugin::instance()->breakpoints->get_active_breakpoints();
		$breakpoint_options   = array(
			'none' => esc_html__( 'None', 'codexshaper-framework' ),
			'all'  => esc_html__( 'All', 'codexshaper-framework' ),
		);
		$excluded_breakpoints = array(
			'widescreen',
		);

		foreach ( $breakpoints as $breakpoint => $breakpoint_instance ) {
			// Do not include widscreen in the options since this feature is for mobile devices.
			if ( in_array( $breakpoint, $excluded_breakpoints, true ) ) {
				continue;
			}

			$breakpoint_options[ $breakpoint ] = sprintf(
				/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$s %3$dpx)', 'codexshaper-framework' ),
				$breakpoint_instance->get_label(),
				'>',
				$breakpoint_instance->get_value()
			);
		}

		$this->add_control(
			'menu_breakpoint',
			array(
				'label'        => esc_html__( 'Breakpoint', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => $breakpoint_options,
				'multiple'     => false,
				'prefix_class' => 'cxf-nav-menu--dropdown-',
				'condition'    => array(
					'show_mobile_menu' => 'yes',
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
			'_section_cxf--nav-menu_style',
			array(
				'label' => __( 'Main Menu Settings', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'menu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'menu_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_item_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'menu_item_border',
				'selector' => '{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'menu_item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'menu_item_style_tabs'
		);

		$this->start_controls_tab(
			'menu_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'menu_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'.cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

		// hover.
		$this->start_controls_tab(
			'menu_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'menu_item_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link:hover' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-nav .cxf-menu .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'menu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-nav .cxf-menu > .menu-item > .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'menu_item_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

			// active.
			$this->start_controls_tab(
				'desktop_menu_item_style_active_tab',
				array(
					'label' => esc_html__( 'Active', 'codexshaper-framework' ),
				)
			);

			$this->add_control(
				'menu_item_active_color',
				array(
					'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu > .menu-item.current-menu-item > .cxf-menu-link' => 'color: {{VALUE}};fill: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'menu_item_active_background',
					'types'    => array( 'classic', 'gradient' ),

					'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu >  .menu-item.current-menu-item > .cxf-menu-link',
				)
			);

			$this->add_control(
				'menu_item_active_border_color',
				array(
					'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu >  .menu-item.current-menu-item > .cxf-menu-link' => 'border-color: {{VALUE}};',
					),
					'condition' => array(
						'menu_item_border_border!' => '',
					),
				)
			);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_submenu_item_style',
			array(
				'label' => esc_html__( 'Submenu Item', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'submenu_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'submenu_border',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu',
			)
		);

		$this->add_responsive_control(
			'submenu_padding',
			array(
				'label'      => esc_html__( 'Wrapper Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'submenu_border_radius',
			array(
				'label'      => esc_html__( 'Wrapper Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'submenu_heading',
			array(
				'label'     => esc_html__( 'Submenu Items', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'submenu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'submenu_item_padding',
			array(
				'label'      => esc_html__( 'Item Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'submenu_item_border',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'submenu_item_border_radius',
			array(
				'label'      => esc_html__( 'Item Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu .menu-item-has-children .sub-menu .menu-item .menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'submenu_item_style_tabs'
		);

		$this->start_controls_tab(
			'submenu_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'submenu_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					.menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
				.menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

		// hover.
		$this->start_controls_tab(
			'submenu_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'submenu_item_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:hover,
					 {{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:hover:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'submenu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:hover, 
				{{WRAPPER}} cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'submenu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:hover, 
					{{WRAPPER}} cxf-menu-wrapper:not(.mobile-menu) .cxf-menu-nav .cxf-menu 
					 .menu-item-has-children:not(.cxf-mega-menu):hover > .sub-menu .menu-item .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'submenu_item_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_submenu_indicator_style',
			array(
				'label' => esc_html__( 'Submenu Indicator', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->start_controls_tabs(
			'indicator_style_tabs'
		);

		$this->start_controls_tab(
			'indicator_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'submenu_indicator_size',
			array(
				'label'      => esc_html__( 'Font Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu)  .cxf-menu .cxf-submenu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'submenu_indicator_COLOR',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu)  .cxf-menu .cxf-submenu-icon svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'submenu_indicator_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu)   .cxf-menu .cxf-submenu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'indicator_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'submenu_indicator_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper:not(.mobile-menu)  .cxf-menu .menu-item:hover .cxf-submenu-icon svg path' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tabs();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_hover_pointer',
			array(
				'label'     => esc_html__( 'Pointer', 'codexshaper-framework' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'menu_pointer!' => 'None',
				),
			)
		);

		$this->add_control(
			'hover_pointer_width',
			array(
				'label'      => esc_html__( 'Pointer Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu .cxf-menu-link:after' => 'width: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'hover_pointer_height',
			array(
				'label'      => esc_html__( 'Pointer Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu .cxf-menu-link:after' => 'height: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_control(
			'hover_pointer_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-nav .cxf-menu .cxf-menu-link:after' => 'background-color: {{VALUE}} !important',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register mobile menu style
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function register_mobile_menu_style() {
		$this->start_controls_section(
			'section_mobile_menu_style',
			array(
				'label' => esc_html__( 'Mobile Menu', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'mobile_hamburger_heading',
			array(
				'label'     => esc_html__( 'Hamburger', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'hamburger_style_tabs'
		);

		$this->start_controls_tab(
			'hamburger_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'mobile_hamburger_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-menu-hamburger',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_hamburger_border',
				'selector' => '{{WRAPPER}} .cxf-menu-hamburger',
			)
		);

		$this->add_responsive_control(
			'mobile_hamburger_size',
			array(
				'label'      => esc_html__( 'Font Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-hamburger svg' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_hamburger_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-hamburger svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'mobile_hamburger_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'mobile_hamburger_background_hover',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-menu-hamburger:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_hamburger_border_hover',
				'selector' => '{{WRAPPER}} .cxf-menu-hamburger:hover',
			)
		);

		$this->add_responsive_control(
			'mobile_hamburger_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-hamburger:hover svg path' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'mobile_menu_card_padding',
			array(
				'label'      => esc_html__( 'Card Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'mobile_menu_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu-container' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'mobile_menu_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu-container',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_menu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_menu_item_border',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'mobile_menu_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'mobile_idicator_align_items',
			array(
				'label'     => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Start', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-start-h',
					),
					'center'        => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-center-h',
					),
					'flex-end'      => array(
						'title' => esc_html__( 'End', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-end-h',
					),
					'space-between' => array(
						'title' => esc_html__( 'Stretch', 'codexshaper-framework' ),
						'icon'  => 'eicon-align-stretch-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu li a' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'mobile_sub_menu_indicator_heading',
			array(
				'label'     => esc_html__( 'Indicator', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'mobile_indicator_style_tabs'
		);

		$this->start_controls_tab(
			'mobile_indicator_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'mobile_submenu_indicator_size',
			array(
				'label'      => esc_html__( 'Font Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu .cxf-submenu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mobile_submenu_indicator_COLOR',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu .cxf-submenu-icon svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'mobile_submenu_indicator_margin',
			array(
				'label'      => esc_html__( 'Margin', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu  .cxf-menu .cxf-submenu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'mobile_indicator_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->add_responsive_control(
			'mobile_submenu_indicator_color_hover',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu  .cxf-menu .menu-item:hover .cxf-submenu-icon svg path' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->start_controls_tabs(
			'mobile_menu_item_style_tabs'
		);

		$this->start_controls_tab(
			'mobile_menu_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'mobile_menu_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_menu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'mobile_menu_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'mobile_menu_item_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_menu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'mobile_menu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .cxf-menu > .menu-item > .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_menu_item_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'mobile_sub_menu_heading',
			array(
				'label'     => esc_html__( 'Mobile Sub Menu', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'mobile_sub_menu_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item-has-children .sub-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mobile_sub_menu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'mobile_sub_menu_item_border',
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'mobile_sub_menu_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'mobile_sub_menu_item_style_tabs'
		);

		$this->start_controls_tab(
			'mobile_sub_menu_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'mobile_sub_menu_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'mobile_sub_menu_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'mobile_sub_menu_item_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'mobile_sub_menu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'mobile_sub_menu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-menu-wrapper.mobile-menu .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'mobile_sub_menu_item_border_border!' => '',
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
		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings   = $this->get_active_settings();
		$menu_index = $this->get_nav_menu_index();
		$id         = $this->get_id();
		$menu_html  = '';

		if ( $settings['menu'] ) {
			$args = array(
				'menu'            => $settings['menu'],
				'menu_class'      => "cxf-menu cxf-menu-{$settings['menu_layout']}",
				'menu_id'         => "menu-{$menu_index}-{$id}",
				'fallback_cb'     => 'wp_page_menu',
				'container'       => 'nav',
				'container_class' => 'cxf-menu-nav cxf-menu-container',
				'submenu_icon'    => Icons_Manager::try_get_icon_html( $settings['submenu_indicator'], array( 'aria-hidden' => 'true' ) ),
				'echo'            => false,
			);

			if ( class_exists( '\CodexShaper\Framework\Menu\NavMenuWalker' ) ) {
				$args['walker'] = new NavMenuWalker();
			}

			add_filter( 'nav_menu_link_attributes', array( $this, 'add_class_to_nav_menu_link' ) );

			$menu_html = wp_nav_menu( $args );
		}

		remove_filter( 'nav_menu_link_attributes', 'add_class_to_nav_menu_link' );

		if ( $settings['menu_name'] ) {
			$this->add_render_attribute( 'wrapper', 'aria-label', $settings['menu_name'] );
		}

		$wrapper_classes = array(
			'cxf-menu-wrapper',
		);

		if ( $settings['menu_pointer'] ) {
			$wrapper_classes[] = "cxf-pointer-{$settings['menu_pointer']}";
		}

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );
		$breakpoints = Plugin::instance()->breakpoints->get_active_breakpoints();
		$breakpoint  = 'tablet';
		if ( isset( $breakpoints[ $settings['menu_breakpoint'] ] ) ) {
			$breakpoint = $breakpoints[ $settings['menu_breakpoint'] ]->get_value();
		}
		$show_mobile_menu = 'yes' === $settings['show_mobile_menu'] && ! empty( $settings['menu_breakpoint'] ) && 'all' !== $settings['menu_breakpoint'];

		$data = array(
			'settings'            => $settings,
			'wrapper'             => $this->get_render_attribute_string( 'wrapper' ),
			'show_mobile_menu'    => $show_mobile_menu,
			'breakpoint'          => $breakpoint,
			'id'                  => $this->get_id(),
			'menu_hamburger_icon' => Icons_Manager::try_get_icon_html( $settings['menu_hamburger_icon'], array( 'aria-hidden' => 'true' ) ),
			'menu_html'           => $menu_html,

		);
		cxf_view( 'nav-menu.content', $data );
		?>
		<?php if ( $show_mobile_menu ) : ?>
		<script>
			function enableCxfMobileMenu() {
				var cxfHamburgetBtn = document.querySelector(".cxf-menu-hamburger");
				if (cxfHamburgetBtn) {
					var windowWidth = window.innerWidth;
					var breakpoint = cxfHamburgetBtn.hasAttribute("data-breakpoint")
					? cxfHamburgetBtn.getAttribute("data-breakpoint")
					: "";
					var widgetId = cxfHamburgetBtn.hasAttribute("data-id")
					? cxfHamburgetBtn.getAttribute("data-id")
					: "";
					var menu = document.querySelector(
					`[data-id="${widgetId}"] .cxf-menu-wrapper`
					);

					if (breakpoint && windowWidth < breakpoint) {
					menu.classList.add("mobile-menu");
					} else {
					menu.classList.remove("mobile-menu");
					}

				}
			}

			enableCxfMobileMenu();

			window.addEventListener("resize", (event) => enableCxfMobileMenu());

		</script>
		<?php endif; ?>
		<?php
	}

	/**
	 * Nav menu link attributes
	 *
	 * @param array $atts Link Attribute.
	 *
	 * @return array
	 */
	public function add_class_to_nav_menu_link( $atts ) {
		$atts['class'] = $atts['class'] ?? '';

		if ( ! empty( $atts['class'] ) ) {
			$atts['class'] .= ' ';
		}

		$atts['class'] .= 'cxf-menu-link';

		return $atts;
	}
}


