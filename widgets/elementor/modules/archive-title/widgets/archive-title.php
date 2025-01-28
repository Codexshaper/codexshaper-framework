<?php
/**
 * Archive_Title Widget file
 *
 * @category   Widget
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\ArchiveTitle\Widgets;

use CodexShaper\Framework\Foundation\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Archive_Title widget class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Archive_Title extends Widget {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cxf--archive-title';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CXF Archive Title', 'codexshaper-framework' );
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
		return 'eicon-t-letter';
	}

	/**
	 * Get widget keywords.
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return array( 'Archive Title', 'CodexShaper', 'CodexShaper Framework', 'CXF' );
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
		return array( 'cxf--archive-title' );
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
			'header_tag',
			array(
				'label'   => esc_html__( 'HTML Tag', 'codexshaper-framework' ),
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
				'default' => 'h2',
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title', 'codexshaper-framework' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'page_type',
			array(
				'label'   => esc_html__( 'Page Type', 'codexshaper-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'blog'                   => esc_html__( 'Blog Archive', 'codexshaper-framework' ),
					'category'               => esc_html__( 'Category', 'codexshaper-framework' ),
					'tag'                    => esc_html__( 'Tag', 'codexshaper-framework' ),
					'archive_day'            => esc_html__( 'Date Day', 'codexshaper-framework' ),
					'archive_day_month'      => esc_html__( 'Date Day Month', 'codexshaper-framework' ),
					'archive_day_month_year' => esc_html__( 'Date Day Month Year', 'codexshaper-framework' ),
					'search'                 => esc_html__( 'Search', 'codexshaper-framework' ),
					'search_not_found'       => esc_html__( 'Search Not Found', 'codexshaper-framework' ),
					'author'                 => esc_html__( 'Author', 'codexshaper-framework' ),
					'404'                    => esc_html__( '404', 'codexshaper-framework' ),
					'custom_archive'         => esc_html__( 'Custom Archive', 'codexshaper-framework' ),
					'custom_taxonomy'        => esc_html__( 'Custom Taxonomy', 'codexshaper-framework' ),
				),
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'       => esc_html__( 'Content', 'codexshaper-framework' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Blogs for {category_name} ', 'codexshaper-framework' ),
				'placeholder' => 'Blogs for {category_name}',
				'description' => 'Use {category_name},{taxonomy_name},{archive_name},{author_name},{tag_name},{search_query},{day},{month},{year}',
				'show_label'  => false,
			)
		);

		$this->add_control(
			'custom',
			array(
				'label'        => esc_html__( 'Allow custom?', 'codexshaper-framework' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'    => esc_html__( 'No', 'codexshaper-framework' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'list',
			array(
				'label'       => esc_html__( 'Custom Page', 'codexshaper-framework' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'condition'   => array( 'custom' => 'yes' ),
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
		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'codexshaper-framework' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'codexshaper-framework' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => '',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'codexshaper-framework' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .cxf--archive-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .cxf--archive-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			array(
				'name'     => 'text_stroke',
				'selector' => '{{WRAPPER}} .cxf--archive-title',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'text_shadow',
				'selector' => '{{WRAPPER}} .cxf--archive-title',
			)
		);

		$this->add_control(
			'blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'codexshaper-framework' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => esc_html__( 'Normal', 'codexshaper-framework' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .cxf--archive-title' => 'mix-blend-mode: {{VALUE}}',
				),
				'separator' => 'none',
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

		$title = $this->get_the_title();

		if ( ! $title ) {
			return;
		}

		$this->add_render_attribute( 'title', 'class', 'cxf--archive-title' );

		$title_html = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			Utils::validate_html_tag( $settings['header_tag'] ),
			$this->get_render_attribute_string( 'title' ),
			$title
		);

		// PHPCS - the variable $title_html holds safe data.
		echo $title_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Get Archive Title
	 *
	 * @return string Archive Title.
	 */
	protected function get_the_title() {
		$title         = get_the_archive_title();
		$archive_type  = $this->get_archive_type();
		$content       = '';
		$template_type = '';
		$replaces      = array();

		if ( ! $this->is_type_exists( $archive_type ) ) {
			return $title;
		}

		switch ( $archive_type ) {
			case 'tag':
				$title         = single_tag_title( '', false );
				$template_type = 'tag_name';
				$replaces[]    = $title;
				break;
			case 'archive_day':
				$title         = esc_html__( 'Blogs for', 'codexshaper-framework' ) . get_the_time( 'F jS, Y' );
				$template_type = 'day';
				$replaces[]    = get_the_time( 'F jS, Y' );
				break;
			case 'archive_day_month':
				$title         = esc_html__( 'Blogs for', 'codexshaper-framework' ) . get_the_time( 'F, Y' );
				$template_type = 'month';
				$replaces[]    = get_the_time( 'F, Y' );
				break;
			case 'archive_day_month_year':
				$title         = esc_html__( 'Blogs for', 'codexshaper-framework' ) . get_the_time( 'Y' );
				$template_type = 'year';
				$replaces[]    = get_the_time( 'Y' );
				break;
			case 'category':
				$category      = get_queried_object();
				$title         = $category->name;
				$template_type = 'category_name';
				$replaces[]    = $title;
				break;
			case '404':
				$title = esc_html__( '404 Error', 'codexshaper-framework' );
				break;
			case 'author':
				$title         = get_the_author_meta( 'display_name' );
				$template_type = 'author_name';
				$replaces[]    = get_the_author_meta( 'display_name' );
				break;
			case 'blog':
				$title = 'Blogs';
				break;
			case 'search':
				$title         = 'Search Page';
				$template_type = 'search_query';
				$replaces[]    = get_search_query();
				break;
			case 'search_not_found':
				$title         = 'Nothing found!';
				$template_type = 'search_query';
				$replaces[]    = get_search_query();
				break;
			case 'custom_taxonomy':
				$template_type = 'taxonomy_name';
				$tax           = get_queried_object();
				$replaces[]    = $tax->name;
				break;
				break;
			case 'custom_archive':
				$title         = post_type_archive_title( '', false );
				$template_type = 'archive_name';
				$replaces[]    = $title;
				break;
		}

		$result  = $this->get_custom_page_settings( $archive_type );
		$content = $result['content'] ?? '';

		if ( ! $content || '' === $template_type ) {
			return $content;
		}

		$title = str_replace( array( "{{$template_type}}" ), array( $replaces ), $content );

		return $title;
	}

	/**
	 * Get Archive Type
	 *
	 * @return string Archive Type.
	 */
	protected function get_archive_type() {
		if ( is_tag() ) {
			return 'tag';
		}

		if ( is_day() ) {
			return 'archive_day';
		}

		if ( is_month() ) {
			return 'archive_day_month';
		}

		if ( is_year() ) {
			return 'archive_day_month_year';
		}

		if ( is_category() ) {
			return 'category';
		}

		if ( is_404() ) {
			return '404';
		}

		if ( is_author() ) {
			return 'author';
		}

		if ( ! is_front_page() && is_home() ) {
			return 'blog';
		}

		if ( is_search() ) {

			if ( ! have_posts() ) {
				return 'search_not_found';
			}

			return 'search';
		}

		if ( is_tax() ) {
			return 'custom_taxonomy';
		}

		if ( is_post_type_archive() ) {
			return 'custom_archive';
		}
	}

	/**
	 * Get Custom Page Settings
	 *
	 * @param string $type Page Type.
	 * @return array Custom Page Settings.
	 */
	protected function get_custom_page_settings( $type = '' ) {

		$lists = $this->get_lists();

		if ( ! $lists ) {
			return false;
		}

		$key = array_search( $type, array_column( $lists, 'page_type' ) );

		return $lists[ $key ] ?? false;
	}

	/**
	 * Check if type exists
	 *
	 * @param string $type Page Type.
	 * @return boolean
	 */
	protected function is_type_exists( $type = '' ) {

		$lists = $this->get_lists();

		if ( ! $lists ) {
			return false;
		}

		$page_types = wp_list_pluck( $lists, 'page_type' );

		if ( ! in_array( $type, $page_types ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Get Lists
	 *
	 * @return array Lists.
	 */
	protected function get_lists() {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['custom'] ) {
			return false;
		}

		$lists = $settings['list'] ?? array();

		if ( empty( $lists ) ) {
			return false;
		}

		return $lists;
	}
}
