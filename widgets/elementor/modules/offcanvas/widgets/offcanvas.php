<?php
/**
 * Offcanvas Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\Offcanvas\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use CodexShaper\Framework\Foundation\Traits\Control\Fields as ControlFields;
use CodexShaper\Framework\Menu\NavMenuWalker;
use CodexShaper\Framework\Widgets\Elementor\Modules\Offcanvas\Skins\Skin_Offcanvas_One;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Offcanvas widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Offcanvas extends Widget {



	use ControlFields;

	/**
	 * Nav menu index
	 *
	 * @var int
	 */
	protected $nav_menu_index = 1;

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--offcanvas';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Offcanvas', 'codexshaper-framework' );
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
		return 'eicon-off-canvas';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Offcanvas', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--offcanvas' );
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
		return array( 'cxf--offcanvas' );
	}

	/**
	 * Get nav menu index
	 *
	 * Retrieve current nav menu index
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return int
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
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
		$this->add_skin( new Skin_Offcanvas_One( $this ) );

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
			'button_type',
			array(
				'label'   => esc_html__( 'Button Type', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => array(
					'icon' => esc_attr__( 'Icon', 'codexshaper-framework' ),
					'text' => esc_html__( 'Text', 'codexshaper-framework' ),
				),
			),
		);

		$this->add_control(
			'menu_button_icon',
			array(
				'label'       => esc_html__( 'Button Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => 'fas fa-bars',
					'library' => 'fa-solid',
				),
				'condition'   => array(
					'button_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'menu_button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'codexshaper-framework' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array(
					'button_type' => 'text',
				),
			)
		);

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
				'label'   => esc_html__( 'Menu', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->cxf_menus(),
			),
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

		$this->add_responsive_control(
			'menu_indicator_position',
			array(
				'label'     => esc_html__( 'Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row-reverse' => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-left',
					),
					'row'         => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap .cxf-menu .cxf-menu-link' => 'flex-direction: {{VALUE}};',
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
					'{{WRAPPER}} .cxf--offcanvas-content-wrap .cxf-menu .cxf-menu-link' => 'justify-content: {{VALUE}};',
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
			'header_logo',
			array(
				'label'   => esc_html__( 'Logo', 'codexshaper-framework' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'header_logo_image',
				'default' => 'full',
			)
		);

		$this->add_control(
			'header_logo_link',
			array(
				'label'       => esc_html__( 'Logo Link', 'codexshaper-framework' ),
				'type'        => Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'close_btn_headinng',
			array(
				'label'     => esc_html__( 'Close Button', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'close_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'close_icon_btn',
			array(
				'label'       => esc_html__( 'Close Icon', 'codexshaper-framework' ),
				'type'        => Controls_Manager::ICONS,
				'separator'   => 'before',
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => array(
					'value'   => $icon_prefix . 'fa-window-close',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'content_headinng',
			array(
				'label'     => esc_html__( 'Content', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_img',
			array(
				'label'   => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'content_image',
				'default' => 'full',
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'cta_info_text',
			array(
				'label'   => esc_html__( 'Contact Info', 'codexshaper-framework' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);
		$repeater->add_control(
			'cta_icon',
			array(
				'label'            => esc_html__( 'Info Icon', 'codexshaper-framework' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => array(
					'inline' => array(
						'none' => array(
							'label' => 'Default',
							'icon'  => 'eicon-chevron-left',
						),
						'icon' => array(
							'icon' => 'eicon-star',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'cta_link',
			array(
				'label'       => esc_html__( 'Link', 'codexshaper-framework' ),
				'type'        => Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'cta_items',
			array(
				'label'  => __( 'Contact Info Items', 'codexshaper-framework' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			)
		);

		$repeater_social = new Repeater();
		$repeater_social->add_control(
			'social_icon',
			array(
				'label'            => esc_html__( 'Social Icon', 'codexshaper-framework' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => array(
					'inline' => array(
						'none' => array(
							'label' => 'Default',
							'icon'  => 'eicon-chevron-left',
						),
						'icon' => array(
							'icon' => 'eicon-star',
						),
					),
				),
			)
		);

		$repeater_social->add_control(
			'social_link',
			array(
				'label'       => esc_html__( 'Link', 'codexshaper-framework' ),
				'type'        => Controls_Manager::URL,
				'options'     => array( 'url', 'is_external', 'nofollow' ),
				'default'     => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'label_block' => true,
			)
		);

		$this->add_control(
			'social_items',
			array(
				'label'  => __( 'Social Items', 'codexshaper-framework' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater_social->get_controls(),
			)
		);

		$this->add_control(
			'show_img',
			array(
				'label'        => esc_html__( 'Show Image', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'show_contact_info_section',
			array(
				'label'        => esc_html__( 'Show Info Section', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
	 * CXF Menus
	 *
	 * @return array
	 */
	protected function cxf_menus() {

		$return_menus = array();
		$menus        = wp_get_nav_menus();
		if ( is_array( $menus ) ) {
			foreach ( $menus as $menu ) {
				$return_menus[ $menu->term_id ] = esc_html( $menu->name );
			}
		}
		return $return_menus;
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
		$this->register_menu_style_controls();
		$this->register_header_style_controls();
		$this->register_content_style_controls();
		$this->register_social_info_style_controls();
	}

	/**
	 * Register Elementor widget menu style controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function register_menu_style_controls() {
		$this->start_controls_section(
			'menu_section_style',
			array(
				'label' => __( 'Menu', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'menu_card_padding',
			array(
				'label'      => esc_html__( 'Card Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-menu-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_width',
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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-menu-container' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'menu_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-menu-container',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'menu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'menu_item_border',
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link',
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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sub_menu_indicator_heading',
			array(
				'label'     => esc_html__( 'Indicator', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-submenu-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-submenu-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'submenu_indicator_COLOR',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-submenu-icon svg' => 'fill: {{VALUE}};',
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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-submenu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf-menu-link:hover .cxf-submenu-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

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
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'menu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'menu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item > .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'menu_item_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'sub_menu_heading',
			array(
				'label'     => esc_html__( 'Mobile Sub Menu', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'sub_menu_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item-has-children .sub-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_menu_item_typography',
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sub_menu_item_border',
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->add_responsive_control(
			'sub_menu_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'sub_menu_item_style_tabs'
		);

		$this->start_controls_tab(
			'sub_menu_item_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'sub_menu_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_item_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sub_menu_item_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'sub_menu_item_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'sub_menu_item_hover_background',
				'types'    => array( 'classic', 'gradient' ),
				'exclude'  => array( 'image' ),
				'selector' => '{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus',
			)
		);

		$this->add_control(
			'sub_menu_item_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:hover, {{WRAPPER}} .cxf-offcanvas-wrapper .menu-item.menu-item-has-children .sub-menu .cxf-menu-link:focus' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'sub_menu_item_border_border!' => '',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Offcanvas Content Style Controls.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_header_style_controls() {

		$this->start_controls_section(
			'header_section_style',
			array(
				'label' => __( 'Header', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'offcanvas_header_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf--offcanvas-header',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'offcanvas_header_border',
				'selector' => '{{WRAPPER}} .cxf--offcanvas-header',
			)
		);

		$this->add_responsive_control(
			'offcanvas_header_border_radius',
			array(
				'label'      => esc_html__( 'Radius', 'codexshaper-framework' ),
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
					'{{WRAPPER}} .cxf--offcanvas-header' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'offfcanvas_header_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--offcanvas-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'open_button_heading',
			array(
				'label'     => esc_html__( 'Open Button', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'open_btn_style_tabs'
		);

		$this->start_controls_tab(
			'open_btn_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'open_btn_text_typography',
				'selector' => '{{WRAPPER}} .cdx-btn-open',
			)
		);

		$this->add_control(
			'open_btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-btn-open' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'open_btn_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'default'    => array(
					'size' => 32,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-btn-open i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-btn-open svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'open_btn_icon_COLOR',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-btn-open svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cdx-btn-open i'   => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'open_btn_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'open_btn_text_typography_hover',
				'selector' => '{{WRAPPER}} .cdx-btn-open:hover',
			)
		);

		$this->add_control(
			'open_btn_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cdx-btn-open:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'open_btn_icon_size_hover',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cdx-btn-open:hover i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cdx-btn-open:hover svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'open_btn_icon_COLOR_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cdx-btn-open:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cdx-btn-open:hover i'   => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'close_button_heading',
			array(
				'label'     => esc_html__( 'Close Button', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'close_btn_style_tabs'
		);

		$this->start_controls_tab(
			'close_btn_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'close_button_text_typography',
				'selector' => '{{WRAPPER}} .cxf--close-btn .cxf--btn-text',
			)
		);

		$this->add_control(
			'close_button_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--close-btn .cxf--btn-text' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_btn_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--close-btn .cxf--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--close-btn .cxf--icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'close_btn_icon_COLOR',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--close-btn .cxf--icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--close-btn .cxf--icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'close_btn_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'close_button_text_typography_hover',
				'selector' => '{{WRAPPER}} .cxf--close-btn:hover .cxf--btn-text',
			)
		);

		$this->add_control(
			'close_button_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--close-btn:hover .cxf--btn-text' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'close_btn_icon_size_hover',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--close-btn:hover .cxf--icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--close-btn:hover .cxf--icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'close_btn_icon_COLOR_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--close-btn:hover .cxf--icon svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--close-btn:hover .cxf--icon i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'header_logo_heading',
			array(
				'label'     => esc_html__( 'Logo', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'header_logo_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--logo-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'header_logo_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--logo-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_image_heading',
			array(
				'label'     => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_image_controls(
			'header_image',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--logo-wrapper .cxf--logo-image',
				'exclude'  => array(
					'header_image_transition',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Offcanvas Content Style Controls.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_content_style_controls() {

		$this->start_controls_section(
			'content_section_style',
			array(
				'label' => __( 'Content', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'content_wrapper_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_width',
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
					'{{WRAPPER}} .cxf--contact-info-content' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_wrapper_direction_items',
			array(
				'label'     => esc_html__( 'Direction', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Row', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-right',
					),
					'column' => array(
						'title' => esc_html__( 'Column', 'codexshaper-framework' ),
						'icon'  => 'eicon-arrow-down',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap' => 'flex-direction:{{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_wrapper_align_items',
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

					'space-around'  => array(
						'title' => esc_html__( 'Around', 'codexshaper-framework' ),
						'icon'  => 'eicon-justify-space-around-h',
					),

					'space-between' => array(
						'title' => esc_html__( 'Between', 'codexshaper-framework' ),
						'icon'  => 'eicon-justify-space-between-h',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_items_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_wrapper_reverse_items',
			array(
				'label'     => esc_html__( 'Position', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'reverse' => array(
						'title' => esc_html__( 'Reverse', 'codexshaper-framework' ),
						'icon'  => 'eicon-exchange',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--offcanvas-content-wrap' => 'flex-direction:{{content_wrapper_direction_items.VALUE || "row"}}-{{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'offcanvas_content_background',
				'types'     => array( 'classic', 'gradient' ),
				'separator' => 'after',
				'selector'  => '{{WRAPPER}} .cxf-offcanvas-wrapper',
			)
		);

		$this->add_control(
			'main_img_wrapper_heading',
			array(
				'label'     => esc_html__( 'Image Wrapper', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_wrapper_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'default'    => array(
					'size' => 500,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--main-img-wrap' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_wrapper_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--main-img-wrap' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_image_heading',
			array(
				'label'     => esc_html__( 'Image', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->common_image_controls(
			'content_image',
			options: array(
				'selector' => '{{WRAPPER}} .cxf--main-img',
				'exclude'  => array(
					'content_image_transition',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Offcanvas Social Info Style Controls.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_social_info_style_controls() {
		$this->start_controls_section(
			'social_info_section_style',
			array(
				'label' => __( 'Social Info', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'cta_info_heading',
			array(
				'label'     => esc_html__( 'Contact Info', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'cta_info_style_tabs'
		);

		$this->start_controls_tab(
			'cta_info_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'cta_info_padding',
			array(
				'label'      => esc_html__( 'Padding', 'codexshaper-framework' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--cta-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cta_info_gap_size',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--cta-wrap' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cta_info_icon_gap_size',
			array(
				'label'      => esc_html__( 'Icon Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--cta-link svg' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--cta-link i'   => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// icon controls.
		$this->add_responsive_control(
			'cta_info_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--cta-link i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--cta-link svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cta_info_icon__COLOR',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--cta-link svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--cta-link i'   => 'color: {{VALUE}};',
				),
			)
		);

		// Text controls.

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cta_info_text_typography',
				'selector' => '{{WRAPPER}} .cxf--cta-link',
			)
		);

		$this->add_control(
			'cta_info_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--cta-link' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'cta_info_border',
				'selector' => '{{WRAPPER}} .cxf--cta-link',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cta_info_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		// icon controls.
		$this->add_responsive_control(
			'cta_info_icon_size_hover',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--cta-link:hover i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--cta-link:hover svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'cta_info_icon_COLOR_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--cta-link:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--cta-link:hover i'   => 'color: {{VALUE}};',

				),
			)
		);

		$this->add_control(
			'cta_info_text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--cta-link:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'social_icon_heading',
			array(
				'label'     => esc_html__( 'Social Link', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs(
			'social_link_style_tabs'
		);

		$this->start_controls_tab(
			'social_link_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_responsive_control(
			'social_icon_gap_size',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-items' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		// icon controls.
		$this->add_responsive_control(
			'social_link_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-item i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--social-item svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'social_link_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--social-item svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--social-item i'   => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_item_divider_heading',
			array(
				'label'     => esc_html__( 'Divider', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'social_link_divider_width',
			array(
				'label'      => esc_html__( 'Width', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'em', 'px', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf--social-item:not(:last-child)::after' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_link_divider_height',
			array(
				'label'      => esc_html__( 'Height', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'em', 'px', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf--social-item:not(:last-child)::after' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_link_divider_gap',
			array(
				'label'      => esc_html__( 'Gap', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( '%', 'em', 'px', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-offcanvas-wrapper .cxf--social-item:not(:last-child)::after' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_link_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'codexshaper-framework' ),
			)
		);

		// icon controls.
		$this->add_responsive_control(
			'social_link_icon_size_hover',
			array(
				'label'      => esc_html__( 'Icon Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--social-item:hover  i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--social-item:hover svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'social_link_icon_COLOR_hover',
			array(
				'label'     => esc_html__( 'Icon Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--social-item:hover svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .cxf--social-item:hover i' => 'color: {{VALUE}};',
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

		$wrapper_classes = array(
			'cxf-offcanvas-wrapper',
		);

		$this->add_render_attribute( 'wrapper', 'class', $wrapper_classes );

		$data['settings']  = $settings;
		$menu_icon         = Icons_Manager::try_get_icon_html(
			$settings['menu_button_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '32',
			)
		);
		$data['menu_icon'] = $menu_icon;
		cxf_view( 'offcanvas.button', $data );
		$this->render_offcanvas( $settings );
		?>

		<?php
	}

	/**
	 * Render Offcanvas Content
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param array $settings Widget Settings.
	 *
	 * @return void
	 */
	protected function render_offcanvas( $settings ) {

		ob_start();
		$this->render_header( $settings );
		$header_content = ob_get_clean();
		ob_start();
		$this->render_contact_content( $settings );
		$contact_content = ob_get_clean();
		ob_start();
		$this->render_menu( $settings );
		$menu_content = ob_get_clean();
		$data         = array(
			'settings'               => $settings,
			'wrapper'                => $this->get_render_attribute_string( 'wrapper' ),
			'render_header'          => $header_content,
			'render_contact_content' => $contact_content,
			'render_menu'            => $menu_content,
		);
		cxf_view( 'offcanvas.content', $data );
	}

	/**
	 * Render Header Content
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param array $settings Widget Settings.
	 * @return void
	 */
	protected function render_header( $settings ) {
		$logo_image_size         = $settings['header_logo_image_size'] ?? 'full';
		$logo_image              = $settings['header_logo'] ?? null;
		$logo_image_id           = $logo_image['id'] ?? null;
		$is_lazy_load            = 'yes' === $settings['lazy_load'];
		$logo_size_image         = $this->get_size_image(
			image_id: $logo_image_id,
			size: $logo_image_size,
			is_custom_lazy: $is_lazy_load,
			attributes: array(
				'alt'          => 'Image',
				'class'        => 'cxf--logo-image',
				'fallback_url' => 0 < $logo_image_id ? '' : $logo_image['url'],
			)
		);
		$data['settings']        = $settings;
		$data['logo_size_image'] = $logo_size_image;
		$data['close_btn_icon']  = Icons_Manager::try_get_icon_html( $settings['close_icon_btn'] );
		cxf_view( 'offcanvas.header', $data );
	}

	/**
	 * Render Contact Content
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param array $settings Widget Settings.
	 * @return void
	 */
	protected function render_contact_content( $settings ) {
		if ( 'yes' == $settings['show_contact_info_section'] ) :
			$content_image_size = $settings['content_image_size'] ?? 'full';
			$content_image      = $settings['content_img'] ?? null;
			$content_image_id   = $content_image['id'] ?? null;
			$is_lazy_load       = 'yes' === $settings['lazy_load'];
			$content_size_image = $this->get_size_image(
				image_id: $content_image_id,
				size: $content_image_size,
				is_custom_lazy: $is_lazy_load,
				attributes: array(
					'alt'          => 'Image',
					'class'        => 'cxf--main-img',
					'fallback_url' => 0 < $content_image_id ? '' : $content_image['url'],
				)
			);
			foreach ( $settings['cta_items'] as $cta_item ) :
				$cta_items_icons[] = Icons_Manager::try_get_icon_html( $cta_item['cta_icon'] );
			endforeach;
			foreach ( $settings['social_items'] as $social_item ) :
				$social_items_icons[] = Icons_Manager::try_get_icon_html( $social_item['social_icon'] );
			endforeach;
			$data['settings']           = $settings;
			$data['content_size_image'] = $content_size_image;
			$data['cta_items_icons']    = $cta_items_icons;
			$data['social_items_icons'] = $social_items_icons;
			cxf_view( 'offcanvas.contact-content', $data );
		endif;
	}

	/**
	 * Render Menu Content
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param array $settings Widget Settings.
	 *
	 * @return void
	 */
	protected function render_menu( $settings ) {
		$menu_index = $this->get_nav_menu_index();
		$id         = $this->get_id();
		$menu_html  = '';

		if ( $settings['menu'] ) {
			$args = array(
				'menu'            => $settings['menu'],
				'menu_class'      => 'cxf-menu ',
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
		// PHPCS - escaped by WordPress with "wp_nav_menu".
		echo "<div class='cxf--menu-content'>" . $menu_html /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */ . '</div>';
	}

	/**
	 * Add class to nav menu link
	 *
	 * @param array $atts Class Attr.
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
