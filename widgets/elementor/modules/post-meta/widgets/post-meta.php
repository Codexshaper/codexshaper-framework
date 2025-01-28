<?php
/**
 * Post_Meta Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\PostMeta\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Post_Meta widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Post_Meta extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--post-meta';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Post Meta', 'codexshaper-framework' );
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
		return 'eicon-meta-data';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Post Meta', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--post-meta' );
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
			'layout_format',
			array(
				'label'     => esc_html__( 'Layout', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Horizontal', 'codexshaper-framework' ),
						'icon'  => 'eicon-ellipsis-h',
					),
					'column' => array(
						'title' => esc_html__( 'Vertical', 'codexshaper-framework' ),
						'icon'  => 'eicon-editor-list-ul',
					),
				),
				'default'   => 'row',
				'selectors' => array(
					'{{WRAPPER}} .cxf-meta-list' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-meta-list' => 'justify-content: {{VALUE}}; align-items: center;',
				),
				'condition' => array(
					'layout_format' => 'row',
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'author'   => esc_html__( 'Author', 'codexshaper-framework' ),
					'date'     => esc_html__( 'Date', 'codexshaper-framework' ),
					'time'     => esc_html__( 'Time', 'codexshaper-framework' ),
					'comments' => esc_html__( 'Comments', 'codexshaper-framework' ),
					'terms'    => esc_html__( 'Terms', 'codexshaper-framework' ),
					'custom'   => esc_html__( 'Custom', 'codexshaper-framework' ),
				),
			)
		);

		$repeater->add_control(
			'date_format',
			array(
				'label'     => esc_html__( 'Date Format', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => _x( 'March 6, 2018 (F j, Y)', 'Date Format', 'codexshaper-framework' ),
					'1'       => '2018-03-06 (Y-m-d)',
					'2'       => '03/06/2018 (m/d/Y)',
					'3'       => '06/03/2018 (d/m/Y)',
					'custom'  => esc_html__( 'Custom', 'codexshaper-framework' ),
				),
				'condition' => array(
					'type' => 'date',
				),
			)
		);

		$repeater->add_control(
			'time_format',
			array(
				'label'     => esc_html__( 'Time Format', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => '3:31 pm (g:i a)',
					'1'       => '3:31 PM (g:i A)',
					'2'       => '15:31 (H:i)',
					'custom'  => esc_html__( 'Custom', 'codexshaper-framework' ),
				),
				'condition' => array(
					'type' => 'time',
				),
			)
		);

		$repeater->add_control(
			'taxonomy',
			array(
				'label'       => esc_html__( 'Taxonomy', 'codexshaper-framework' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => array(),
				'options'     => $this->get_meta_taxonomies(),
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_responsive_control(
			'max_terms',
			array(
				'label'       => esc_html__( 'Max Terms', 'codexshaper-framework' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Set -1 to show all terms. Default 1', 'codexshaper-framework' ),
				'min'         => -1,
				'max'         => 10,
				'step'        => 1,
				'default'     => 1,
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'show_avatar',
			array(
				'label'     => esc_html__( 'Avatar', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'type' => 'author',
				),
			)
		);

		$repeater->add_responsive_control(
			'avatar_size',
			array(
				'label'      => esc_html__( 'Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--meta-icon img.cxf--avatar' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_avatar' => 'yes',
				),
			)
		);

		$repeater->add_responsive_control(
			'avatar_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--meta-icon img.cxf--avatar' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_avatar' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'custom_title',
			array(
				'label'       => esc_html__( 'Custom', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array(
					'active' => true,
				),
				'label_block' => true,
				'condition'   => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'     => esc_html__( 'Link', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array(
					'type!' => 'time',
				),
			)
		);

		$repeater->add_control(
			'custom_url',
			array(
				'label'     => esc_html__( 'Custom URL', 'codexshaper-framework' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'show_icon',
			array(
				'label'     => esc_html__( 'Icon', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'    => esc_html__( 'None', 'codexshaper-framework' ),
					'default' => esc_html__( 'Default', 'codexshaper-framework' ),
					'custom'  => esc_html__( 'Custom', 'codexshaper-framework' ),
				),
				'default'   => 'default',
				'condition' => array(
					'show_avatar!' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'selected_icon',
			array(
				'label'            => esc_html__( 'Choose Icon', 'codexshaper-framework' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition'        => array(
					'show_icon'    => 'custom',
					'show_avatar!' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'separator_display_on',
			array(
				'label'   => esc_html__( 'Separator Display On', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'css'  => esc_html__( 'CSS', 'codexshaper-framework' ),
					'html' => esc_html__( 'HTML', 'codexshaper-framework' ),
				),
				'default' => esc_html__( 'html', 'codexshaper-framework' ),
			)
		);

		$repeater->add_control(
			'separator_location',
			array(
				'label'   => esc_html__( 'Separator Location', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'before' => esc_html__( 'Before', 'codexshaper-framework' ),
					'after'  => esc_html__( 'After', 'codexshaper-framework' ),
				),
				'default' => esc_html__( 'after', 'codexshaper-framework' ),
			)
		);

		$repeater->add_control(
			'separator_css_before',
			array(
				'label'       => esc_html__( 'Separator Before', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '|', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Enter your separator', 'codexshaper-framework' ),
				'condition'   => array(
					'separator_display_on' => 'css',
					'separator_location'   => 'before',
				),
				'selectors'   => array(
					'{{WRAPPER}} .cxf--item-separator::before' => "content: '{{VALUE}}'",
				),
			)
		);

		$repeater->add_control(
			'separator_css_after',
			array(
				'label'       => esc_html__( 'Separator After', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '|', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Enter your separator', 'codexshaper-framework' ),
				'condition'   => array(
					'separator_display_on' => 'css',
					'separator_location'   => 'after',
				),
				'selectors'   => array(
					'{{WRAPPER}} .cxf--item-separator::after' => "content: '{{VALUE}}'",
				),
			)
		);

		$repeater->add_control(
			'separator_html_before',
			array(
				'label'       => esc_html__( 'Separator Before', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '|', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Enter your separator', 'codexshaper-framework' ),
				'condition'   => array(
					'separator_display_on' => 'html',
					'separator_location'   => 'before',
				),
			)
		);

		$repeater->add_control(
			'separator_html_after',
			array(
				'label'       => esc_html__( 'Separator After', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '|', 'codexshaper-framework' ),
				'placeholder' => esc_html__( 'Enter your separator', 'codexshaper-framework' ),
				'condition'   => array(
					'separator_display_on' => 'html',
					'separator_location'   => 'after',
				),
			)
		);

		$this->add_control(
			'list',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'type'          => 'author',
						'selected_icon' => array(
							'value'   => 'far fa-user-circle',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'date',
						'selected_icon' => array(
							'value'   => 'fas fa-calendar',
							'library' => 'fa-solid',
						),
					),
					array(
						'type'          => 'comments',
						'selected_icon' => array(
							'value'   => 'far fa-comment-dots',
							'library' => 'fa-regular',
						),
					),
				),
				'title_field' => '{{{ type.toUpperCase() }}}',
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
			'section_icon_list',
			array(
				'label' => esc_html__( 'List', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px'  => array(
						'max' => 100,
					),
					'em'  => array(
						'max' => 10,
					),
					'rem' => array(
						'max' => 10,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf-meta-list' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label' => esc_html__( 'Icon', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--item .cxf--meta-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cxf--item .cxf--meta-icon svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Size', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'default'    => array(
					'size' => 14,
				),
				'range'      => array(
					'px'  => array(
						'min' => 6,
					),
					'em'  => array(
						'max' => 0.6,
					),
					'rem' => array(
						'max' => 0.6,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--item .cxf--meta-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cxf--item .cxf--meta-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => esc_html__( 'Text', 'codexshaper-framework' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs(
			'text_tabs',
		);
		$this->start_controls_tab(
			'text_normal_tab',
			array(
				'label' => __( 'Normal', 'codexshaper-framework' ),
			)
		);

		$this->add_control(
			'text_indent',
			array(
				'label'      => esc_html__( 'Indent', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px'  => array(
						'max' => 50,
					),
					'em'  => array(
						'max' => 5,
					),
					'rem' => array(
						'max' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--meta-titlet' => 'padding-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .cxf--meta-title'  => 'padding-right: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--meta-title, {{WRAPPER}} a.cxf--meta-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'icon_typography',
				'selector' => '{{WRAPPER}} .cxf--meta-title',
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_hover_tab',
			array(
				'label' => __( 'Hover', 'codexshaper-framework' ),
			)
		);
		$this->add_control(
			'text_color_hover',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf--item a:hover .cxf--meta-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'custom_text',
			array(
				'label'     => esc_html__( 'Custom Text/Divider', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'separator_display',
			array(
				'label'     => esc_html__( 'Separator Display', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'inline-block' => esc_html__( 'Show', 'codexshaper-framework' ),
					'none'         => esc_html__( 'None', 'codexshaper-framework' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf-custom-text-separator' => 'display: {{VALUE}}',
					'{{WRAPPER}} .cxf--item-separator::after' => 'display: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'vertical_position_text',
			array(
				'label'      => esc_html__( 'Vertical position', 'codexshaper-framework' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .cxf--item-separator::after' => 'top: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'separator_display_on' => 'css',
				),
			)
		);

		$this->add_control(
			'cus_text_color',
			array(
				'label'     => esc_html__( 'Custom Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .cxf-meta-list .cxf--item > span ' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cxf--item-separator::after' => 'color: {{VALUE}}',
				),
				'separator' => 'after',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cus_text_typography',
				'selector' => '{{WRAPPER}} .cxf-meta-list .cxf--item > span , {{WRAPPER}} .cxf--item-separator::after',
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
		$settings = $this->get_settings_for_display();

		ob_start();
		if ( ! empty( $settings['list'] ) ) {
			foreach ( $settings['list'] as $meta ) {
				$this->render_item( $meta, $settings );
			}
		}
		$items_html = ob_get_clean();

		if ( empty( $items_html ) ) {
			return;
		}

		$this->add_render_attribute(
			'list',
			'class',
			array(
				'cxf-meta-list',
				// "cxf--post-meta-{$settings['layout']}"
			)
		);
		?>
		<ul <?php $this->print_render_attribute_string( 'list' ); ?>>
			<?php
			// PHPCS - the variable $terms_list is safe.
			?>
			<?php
			echo $items_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
			?>
		</ul>
		<?php
	}

	/**
	 * Get meta data.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array
	 */
	protected function get_meta_taxonomies() {
		$args = array(
			'show_in_nav_menus' => true,
		);

		$taxonomies = get_taxonomies( $args, 'objects' );
		$options    = array(
			'' => esc_html__( 'Select Term', 'codexshaper-framework' ),
		);

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

	/**
	 * Render item
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param mixed $meta Post Meta.
	 * @param mixed $settings Widget Settings.
	 * @return array
	 */
	protected function render_item( $meta, $settings ) {
		$meta_data = $this->get_meta_data( $meta );
		$id        = $meta['_id'];

		if ( empty( $meta_data['title'] ) && empty( $meta_data['terms'] ) ) {
			return;
		}

		$meta_link            = "link_{$id}";
		$meta_list            = "item_{$id}";
		$separator_display_on = $meta['separator_display_on'] ?? 'html';
		$separator_location   = $meta['separator_location'] ?? 'after';
		$separator_field      = "separator_{$separator_display_on}_{$separator_location}";
		$separator            = $meta[ $separator_field ] ?? '';

		$this->add_render_attribute(
			$meta_list,
			'class',
			array(
				'cxf--item',
				"cxf--item-{$id}",
				// "cxf--item-{$settings['layout_format']}",
			)
		);

		if ( $separator && 'css' === $separator_display_on ) {
			$separator_location_class = "cxf--separator-css-{$separator_location}";
			$this->add_render_attribute( $meta_list, 'class', array( 'cxf--item-separator', $separator_location_class ) );
			$this->add_render_attribute( $meta_list, 'data-separator', esc_attr( $meta_data['separator'] ) );
		}

		$show_link = isset( $meta_data['url'] ) && ! empty( $meta_data['url'] );

		if ( $show_link ) {
			$this->add_link_attributes(
				$meta_link,
				array(
					'url' => $meta_data['url'],
				)
			);
		}

		$data = array(
			'meta_list'                 => $meta_list,
			'separator'                 => $separator,
			'separator_display_on'      => $separator_display_on,
			'separator_location'        => $separator_location,
			'show_link'                 => $show_link,
			'meta_list_attr'            => $this->get_render_attribute_string( $meta_list ),
			'meta_link'                 => $this->get_render_attribute_string( $meta_link ),
			'render_meta_icon_or_image' => $this->render_meta_icon_or_image( $meta_data, $meta, $id ),
			'render_meta_title'         => $this->render_meta_title( $meta_data, $id ),

		);
		cxf_view( 'post-meta.content', $data );
	}

	/**
	 * Render meta data
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param mixed $meta Post Meta.
	 *
	 * @return array
	 */
	protected function get_meta_data( $meta ) {
		$title         = '';
		$terms         = array();
		$icon          = '';
		$selected_icon = array();
		$url           = '';
		$image         = '';
		$separator     = $meta['separator'] ?? '';
		$max_terms     = $meta['max_terms'] ?? '';

		switch ( $meta['type'] ) {
			case 'author':
				$title         = get_the_author_meta( 'display_name' );
				$icon          = 'fa fa-user-circle-o';
				$selected_icon = array(
					'value'   => 'far fa-user-circle',
					'library' => 'fa-regular',
				);

				if ( 'yes' === $meta['link'] ) {
					$url = get_author_posts_url( get_the_author_meta( 'ID' ) );
				}

				if ( 'yes' === $meta['show_avatar'] ) {
					$image = get_avatar_url( get_the_author_meta( 'ID' ), 96 );
				}

				break;

			case 'date':
				$format_options = array(
					'default' => 'F j, Y',
					'0'       => 'F j, Y',
					'1'       => 'Y-m-d',
					'2'       => 'm/d/Y',
					'3'       => 'd/m/Y',
				);

				$title         = get_the_time( $format_options[ $meta['date_format'] ] );
				$icon          = 'fa fa-calendar';
				$selected_icon = array(
					'value'   => 'fas fa-calendar',
					'library' => 'fa-solid',
				);

				if ( 'yes' === $meta['link'] ) {
					$url = get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) );
				}
				break;

			case 'time':
				$format_options = array(
					'default' => 'g:i a',
					'0'       => 'g:i a',
					'1'       => 'g:i A',
					'2'       => 'H:i',
				);
				$title          = get_the_time( $format_options[ $meta['time_format'] ] );
				$icon           = 'fa fa-clock-o';
				$selected_icon  = array(
					'value'   => 'far fa-clock',
					'library' => 'fa-regular',
				);
				break;

			case 'comments':
				if ( comments_open() ) {
					$num_comments  = (int) get_comments_number(); // get_comments_number returns only a numeric value.
					$title         = esc_html__( 'No Comments', 'codexshaper-framework' );
					$icon          = 'fa fa-commenting-o';
					$selected_icon = array(
						'value'   => 'far fa-comment-dots',
						'library' => 'fa-regular',
					);

					if ( $num_comments > 0 ) {
						$title = sprintf(
							/* translators: 1: number of comments */
							_n(
								'%s Comment',
								'%s Comments',
								$num_comments,
								'codexshaper-framework'
							),
							$num_comments
						);
					}

					if ( 'yes' === $meta['link'] ) {
						$url = get_comments_link();
					}
				}
				break;

			case 'terms':
				$icon          = 'fa fa-tags';
				$selected_icon = array(
					'value'   => 'fas fa-tags',
					'library' => 'fa-solid',
				);
				$taxonomy      = $meta['taxonomy'];
				$terms_list    = wp_get_post_terms( get_the_ID(), $taxonomy );

				foreach ( $terms_list as $term ) {
					$terms[ $term->term_id ]['title'] = $term->name;
					if ( 'yes' === $meta['link'] ) {
						$terms[ $term->term_id ]['url'] = get_term_link( $term );
					}
				}
				break;

			case 'custom':
				$title         = $meta['custom_title'];
				$icon          = 'fa fa-info-circle';
				$selected_icon = array(
					'value'   => 'far fa-tags',
					'library' => 'fa-regular',
				);

				if ( 'yes' === $meta['link'] && ! empty( $meta['custom_url'] ) ) {
					$url = $meta['custom_url'];
				}

				break;
		}

		return array(
			'type'          => $meta['type'],
			'title'         => $title,
			'url'           => $url,
			'terms'         => $terms,
			'image'         => $image,
			'icon'          => $icon,
			'selected_icon' => $selected_icon,
			'separator'     => $separator,
			'max_terms'     => $max_terms,
		);
	}

	/**
	 * Render meta icon or image
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @param mixed $meta_data Meta Data.
	 * @param mixed $meta Post Meta.
	 * @param mixed $id Post Id.
	 */
	protected function render_meta_icon_or_image( $meta_data, $meta, $id ) {
		$show_icon = $meta['show_icon'] ?? '';

		if ( 'none' === $meta['show_icon'] ) {
			$show_icon                  = '';
			$meta_data['selected_icon'] = array();
		}

		if ( 'custom' === $meta['show_icon'] && ! empty( $meta['selected_icon'] ) ) {
			$meta_data['selected_icon'] = $meta['selected_icon'];
		}

		if ( empty( $meta_data['icon'] ) && empty( $meta_data['selected_icon'] ) && empty( $meta_data['image'] ) ) {
			return;
		}

		$show_image      = isset( $meta_data['image'] ) && ! empty( $meta_data['image'] );
		$image_render_id = "image_{$id}";

		if ( ! ( $show_icon || $show_image ) ) {
			return;
		}

		if ( $show_image ) {
			$this->add_render_attribute(
				$image_render_id,
				array(
					'class'   => 'cxf--avatar',
					'src'     => $meta_data['image'],
					'alt'     => sprintf(
						/* translators: %s: Author name. */
						esc_attr__( 'Picture of %s', 'codexshaper-framework' ),
						$meta_data['title']
					),
					'loading' => 'lazy',
				)
			);
		}

		$data = array(
			'show_image'       => $show_image,
			'show_icon'        => $show_icon,
			'render_meta_icon' => $this->render_meta_icon( $meta_data ),
			'avater_image' =>  $this->get_render_attribute_string($image_render_id),
		);
		return cxf_view_render( 'post-meta.icon-image', $data );
	}

	/**
	 * Render meta icon
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param mixed $meta_data Meta Data.
	 * @return string Html markup for meta icon.
	 */
	protected function render_meta_icon( $meta_data ) {
		$migration_allowed = Icons_Manager::is_migration_allowed();
		$migrated          = isset( $meta['__fa4_migrated']['selected_icon'] );
		$is_new            = empty( $meta['icon'] ) && $migration_allowed;

		if ( $is_new || $migrated ) {
			return Icons_Manager::try_get_icon_html( $meta_data['selected_icon'], array( 'aria-hidden' => 'true' ) );
		} else {
			return sprintf( '<i class="%1$s" area-hidden="%2$s"></i>', esc_attr( $meta_data['icon'] ), true );
		}
	}

	/**
	 * Render meta title
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param mixed $meta_data Meta Data.
	 * @param mixed $id Post Id.
	 * @return string Html markup for meta title.
	 */
	protected function render_meta_title( $meta_data, $id ) {
		$title_wrapper_id = "title_{$id}";
		$type             = $meta_data['type'];
		$terms            = $this->get_meta_title_terms( $meta_data );

		$this->add_render_attribute(
			$title_wrapper_id,
			'class',
			array(
				'cxf--meta-title',
				"cxf--meta-type-{$type}",
			)
		);

		$data = array(
			'title_wrapper'                   => $this->get_render_attribute_string( $title_wrapper_id ),
			'render_meta_title_terms_content' => $this->render_meta_title_terms_content( $terms, $meta_data, $title_wrapper_id ),
			'render_meta_title_content'       => $this->render_meta_title_content( $meta_data, $terms ),
		);
		return cxf_view_render( 'post-meta.title', $data );
	}

	/**
	 * Get meta title terms.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param mixed $meta_data Meta data.
	 *
	 * @return array
	 */
	private function get_meta_title_terms( $meta_data ) {
		$term_item_class = 'cxf--meta-term-item';
		$max_terms       = (int) $meta_data['max_terms'] ?? -1;
		$terms           = array();

		if ( ! empty( $meta_data['terms'] ) ) {
			foreach ( $meta_data['terms'] as $term ) {
				// Stop loop when it matches limit.
				if ( -1 !== $max_terms && count( $terms ) >= $max_terms ) {
					break;
				}

				$term = sprintf(
					'<span class="%1$s">%2$s</span>',
					esc_attr( $term_item_class ),
					esc_html( $term['title'] )
				);

				if ( ! empty( $term['url'] ) ) {
					$term = sprintf(
						'<a href="%1$s" class="%2$s">%3$s</a>',
						esc_url( $term['url'] ),
						esc_attr( $term_item_class ),
						esc_html( $term['title'] )
					);
				}

				$terms[] = $term;
			}
		}

		return $terms;
	}

	/**
	 * Render meta title terms content.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param mixed $terms Terms.
	 * @param mixed $meta_data Meta Data.
	 * @param mixed $title_wrapper_id Wrapper Id.
	 */
	protected function render_meta_title_terms_content( $terms, $meta_data, $title_wrapper_id ) {

		if ( empty( $terms ) ) {
			return;
		}

		if ( ! empty( $meta_data['terms'] ) ) {
			$this->add_render_attribute( $title_wrapper_id, 'class', 'cxf--meta-terms' );
		}

		// PHPCS - the variable $terms is safe.
		return sprintf(
			'<span class="%1$s">%2$s</span>',
			esc_attr( 'cxf--meta-item-wrapper' ),
			implode( ', ', $terms ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}

	/**
	 * Render meta title content
	 *
	 * @since 1.0.0
	 * @access protected
	 * @param mixed $meta_data Meta data.
	 * @param mixed $terms Terms.
	 */
	protected function render_meta_title_content( $meta_data ) {
		if ( ! empty( $terms ) ) {
			return;
		}

		$content = ( 'date' === $meta_data['type'] || 'time' === $meta_data['type'] )
			? sprintf( '<time>%s</time>', $meta_data['title'] )
			: $meta_data['title'];

		return wp_kses(
			$content,
			array(
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(),
			)
		);
	}
}
