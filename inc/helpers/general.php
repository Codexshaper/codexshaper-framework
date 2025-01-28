<?php
/**
 * Helper functions file
 *
 * @category   Helper
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

use CodexShaper\Framework\Builder\Option;
use CodexShaper\Framework\Builder\Section;

if ( ! function_exists( 'cxf_get_svg_rules' ) ) {

	/**
	 * Get svg rules
	 *
	 * @return array The svg rules.
	 */
	function cxf_get_svg_rules() {

		return array_merge(
			// Default option.
			wp_kses_allowed_html( 'post' ),
			// SVG options.
			array(
				'svg'   => array(
					'class'           => true,
					'aria-hidden'     => true,
					'aria-labelledby' => true,
					'role'            => true,
					'xmlns'           => true,
					'width'           => true,
					'height'          => true,
					'viewbox'         => true,
					'fill'            => true,
				),
				'g'     => array(
					'fill' => true,
					'id'   => true,
				),
				'title' => array( 'title' => true ),
				'path'  => array(
					'd'               => true,
					'fill'            => true,
					'id'              => true,
					'stroke'          => true,
					'stroke-width'    => true,
					'stroke-linecap'  => true,
					'stroke-linejoin' => true,
				),

			),
		);
	}
}

$prefix = 'cxf_setting_options';
// Create options.
Option::create(
	$prefix,
	array(
		'menu_title'         => esc_html__( 'Theme Options', 'codexshaper-framework' ),
		'menu_slug'          => $prefix,
		'parent_slug'        => 'codexshaper-framework',
		'menu_type'          => 'submenu',
		'footer_credit'      => ' ',
		'menu_icon'          => 'fa fa-filter',
		'show_footer'        => false,
		'enqueue_webfont'    => false,
		'show_search'        => true,
		'show_reset_all'     => true,
		'show_reset_section' => true,
		'show_all_options'   => false,
		'theme'              => 'dark',
		'framework_title'    => 'CodexShaper Framework Menu',
	)
);

/*
-------------------------------------------------------
	** General  Options
--------------------------------------------------------
*/

// Section::create(
// $prefix,
// array(
// 'title' => esc_html__( 'General', 'codexshaper-framework' ),
// 'id'    => 'general_options',
// 'icon'  => 'fas fa-cogs',
// )
// );

Section::create(
	$prefix,
	array(
		'title'  => esc_html__( 'Test', 'codexshaper-framework' ),
		'id'     => 'theme_general_test_options',
		'icon'   => 'fa fa-spinner',
		// 'parent' => 'general_options',
		'fields' => array(
			array(
				'id'    => 'theme_name',
				'type'  => 'text',
				'title' => 'Text',
			),
			array(
				'id'         => 'opt-accordion-1',
				'type'       => 'accordion',
				'title'      => 'Accordion',
				'accordions' => array(
					array(
						'title'  => 'Accordion 1',
						'icon'   => 'fa fa-heart',
						'fields' => array(
							array(
								'id'    => 'opt-text-1',
								'type'  => 'text',
								'title' => 'Text',
							),
							array(
								'id'    => 'opt-text-2',
								'type'  => 'textarea',
								'title' => 'Text Area',
							),
						),
					),
					array(
						'title'  => 'Accordion 2',
						'icon'   => 'fa fa-gear',
						'fields' => array(
							array(
								'id'    => 'opt-color-1',
								'type'  => 'color',
								'title' => 'Color',
							),
						),
					),
				),
			),
			array(
				'id'    => 'opt-text-2',
				'type'  => 'textarea',
				'title' => 'Text Area',
			),
		),
	)
);

// Section::create(
// $prefix,
// array(
// 'title' => esc_html__( 'General', 'codexshaper-framework' ),
// 'id'    => 'general_options',
// 'icon'  => 'fas fa-cogs',
// )
// );
// /* Preloader */
// Section::create(
// $prefix,
// array(
// 'title'  => esc_html__( 'Preloader & SVG Enable', 'codexshaper-framework' ),
// 'id'     => 'theme_general_preloader_options',
// 'icon'   => 'fa fa-spinner',
// 'parent' => 'general_options',
// 'fields' => array(
// array(
// 'type'    => 'subheading',
// 'content' => '<h3>' . esc_html__( 'Preloader Options', 'codexshaper-framework' ) . '</h3>',
// ),
// array(
// 'id'      => 'preloader_enable',
// 'title'   => esc_html__( 'Preloader', 'codexshaper-framework' ),
// 'type'    => 'switcher',
// 'desc'    => wp_kses( __( 'you can set <mark>Yes / No</mark> to enable/disable preloader', 'codexshaper-framework' ), array( 'mark' ) ),
// 'default' => true,
// ),
// ),
// )
// );

// /*
// -------------------------------------------------------
// ** Entire Site Header  Options
// --------------------------------------------------------
// */
// Section::create(
// $prefix,
// array(
// 'id'    => 'headers_settings',
// 'title' => esc_html__( 'Headers', 'codexshaper-framework' ),
// 'icon'  => 'fa fa-home',
// )
// );
// /* Header Style 01 */
// Section::create(
// $prefix,
// array(
// 'title'  => esc_html__( 'Header', 'codexshaper-framework' ),
// 'id'     => 'theme_header_options',
// 'icon'   => 'fa fa-image',
// 'parent' => 'headers_settings',
// 'fields' => array(
// array(
// 'type'    => 'subheading',
// 'content' => '<h3>' . esc_html__( 'Navbar Options', 'codexshaper-framework' ) . '</h3>',
// ),
// array(
// 'id'      => 'header_logo',
// 'type'    => 'media',
// 'title'   => esc_html__( 'Logo', 'codexshaper-framework' ),
// 'library' => 'image',
// 'desc'    => wp_kses( __( 'you can upload <mark> logo</mark> here it will overwrite customizer uploaded logo', 'codexshaper-framework' ), array( 'mark' ) ),
// ),
// array(
// 'id'      => 'header_btn_one_text',
// 'type'    => 'text',
// 'title'   => esc_html__( 'Btn One Text', 'codexshaper-framework' ),
// 'default' => esc_html__( 'Subscribe Now', 'codexshaper-framework' ),
// ),
// array(
// 'id'      => 'header_btn_one_url',
// 'type'    => 'text',
// 'title'   => esc_html__( 'Btn One Url', 'codexshaper-framework' ),
// 'default' => esc_html__( '#', 'codexshaper-framework' ),
// ),
// array(
// 'id'      => 'header_btn_two_text',
// 'type'    => 'text',
// 'title'   => esc_html__( 'Btn Two Text', 'codexshaper-framework' ),
// 'default' => esc_html__( 'Sign In', 'codexshaper-framework' ),
// ),
// array(
// 'id'     => 'header_social_repeater',
// 'type'   => 'repeater',
// 'title'  => esc_html__( 'Social Repeater', 'codexshaper-framework' ),
// 'fields' => array(
// array(
// 'id'      => 'header_social_icon',
// 'type'    => 'icon',
// 'default' => 'fa fa-twitter',
// ),
// array(
// 'id'      => 'header_social_url',
// 'type'    => 'text',
// 'default' => '#',
// ),
// ),
// ),
// ),
// )
// );

/*
-------------------------------------------------------
	** Backup  Options
--------------------------------------------------------
*/
Section::create(
	$prefix,
	array(
		'id'     => 'backup',
		'title'  => esc_html__( 'Import / Export', 'codexshaper-framework' ),
		'icon'   => 'eicon-export-kit',
		'fields' => array(
			array(
				'type'    => 'notice',
				'style'   => 'warning',
				'content' => esc_html__( 'You can save your current options. Download a Backup and Import.', 'codexshaper-framework' ),
			),
			array(
				'type'  => 'backup',
				'title' => esc_html__( 'Backup & Import', 'codexshaper-framework' ),
			),
		),
	)
);
