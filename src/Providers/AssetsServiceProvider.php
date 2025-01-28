<?php
/**
 *  Asset Service Provider File
 *
 * @category   ServiceProvider
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Providers;

use CodexShaper\Framework\Foundation\ServiceProvider;
use CodexShaper\Framework\Foundation\Traits\Hook;

/**
 *  Asset Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class AssetsServiceProvider extends ServiceProvider {

	use Hook;

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot() {
		// Booted code.
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->providers = apply_filters( 'cxf_console_providers', $this->providers );

		// Enqueue styles
		$this->add_action( 'wp_enqueue_scripts', 'cxf_enqueue_styles' );
		// Enqueue Scripts.
		$this->add_action( 'wp_enqueue_scripts', 'cxf_enqueue_scripts' );
		// Equeue custom fonts style.
		$this->add_action( 'wp_enqueue_scripts', 'cxf_custom_fonts_styles' );
		// Admin styles.
		$this->add_action( 'admin_enqueue_scripts', 'cxf_admin_enqueue_styles' );
		// Admin scripts.
		$this->add_action( 'admin_enqueue_scripts', 'cxf_admin_enqueue_scripts' );
	}

	/**
	 * Plug Assets
	 *
	 * Load all plugin assets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function cxf_enqueue_styles() {

		if ( ! wp_style_is( 'cxf-fa5' ) ) {
			wp_enqueue_style( 'cxf-fa5', CXF_URL . 'assets/css/vendor/fontawesome.min.css', array(), '5.15.5', 'all' );
		}

		$all_css_files = array(
			array(
				'handle' => 'cxf--frontend',
				'src'    => CXF_URL . 'assets/css/cxf--frontend.css',
				'deps'   => array(),
				'ver'    => filemtime( CXF_PATH . 'assets/css/cxf--frontend.css' ),
				'media'  => 'all',
			),
		);
		$all_css_files = apply_filters( 'cxf_css', $all_css_files );

		if ( is_array( $all_css_files ) && count( $all_css_files ) > 0 ) {
			foreach ( $all_css_files as $css ) {
				call_user_func_array( 'wp_enqueue_style', $css );
			}
		}
	}

	/**
	 * Plug Assets
	 *
	 * Load all plugin assets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function cxf_enqueue_scripts() {

		// Localize. Send data from PHP to Javascript.
		wp_enqueue_script( 'cxf--localize', CXF_URL . 'assets/js/cxf--localize.js', array( 'jquery' ), CXF_VERSION, true );
		$data = apply_filters(
			'cxf_localize_data',
			array(
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
				'cxf_nonce'     => wp_create_nonce( 'cxf_nonce' ),
				'post_id'       => get_the_ID(),
				'cxf_animation' => cxf_settings( 'cxf_animation' ),
				'color_palette' => apply_filters( 'cxf_color_palette', array() ),
				'i18n'          => array(
					'confirm'         => esc_html__( 'Are you sure?', 'codexshaper-framework' ),
					'typing_text'     => esc_html__( 'Please enter two or more characters', 'codexshaper-framework' ),
					'searching_text'  => esc_html__( 'Searching...', 'codexshaper-framework' ),
					'no_results_text' => esc_html__( 'No results found.', 'codexshaper-framework' ),
				),
			)
		);

		wp_localize_script( 'cxf--localize', 'CXF_LOCALIZE_JS', $data );
		wp_enqueue_script( 'cxf--localize' );

		wp_register_script(
			'cxf--wrapper-link',
			CXF_URL . 'assets/js/cxf--wrapper-link.js',
			array( 'jquery' ),
			filemtime( CXF_PATH . 'assets/js/cxf--wrapper-link.js' ),
			true
		);

		wp_register_script(
			'cxf--lazy-load',
			CXF_URL . 'assets/js/cxf--lazy-load.min.js',
			array(),
			filemtime( CXF_PATH . 'assets/js/cxf--lazy-load.min.js' ),
			true
		);

		wp_register_script(
			'cxf--goodshare',
			CXF_URL . 'assets/js/vendor/goodshare.min.js',
			array( 'jquery' ),
			filemtime( CXF_PATH . 'assets/js/vendor/goodshare.min.js' ),
			true
		);

		wp_enqueue_script(
			'cxf--script',
			CXF_URL . 'assets/js/cxf--frontend.js',
			array( 'jquery' ),
			filemtime( CXF_PATH . 'assets/js/cxf--frontend.js' ),
			true
		);
	}

	/**
	 * Custom font styles
	 *
	 * Load all plugin assets.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function cxf_custom_fonts_styles() {

		wp_enqueue_style(
			'cxf--custom-font',
			CXF_URL . 'assets/css/cxf--custom-font.css',
			array(),
			filemtime( CXF_PATH . 'assets/css/cxf--custom-font.css' ),
			'all',
		);

		$custom_fonts      = apply_filters( 'cxf_custom_fonts', array() );
		$custom_font_faces = array();
		foreach ( $custom_fonts as $font_family => $fonts ) {
			foreach ( $fonts as $font ) {
				$custom_font_faces[] = sprintf(
					'
                        @font-face {
                          font-family: %s;
                          src: url(%s);
                          font-weight: %s;                         
                        }',
					$font_family,
					$font['src'],
					$font['weight']
				);
			}
		}

		$custom_font_css = implode( ' ', $custom_font_faces );

		wp_add_inline_style( 'cxf--custom-font', $custom_font_css );
	}

	/**
	 * Admin styles
	 *
	 * @return void.
	 */
	public function cxf_admin_enqueue_styles() {
		// Add fontawesome support for admin
		if ( ! wp_style_is( 'cxf--fa5-admin' ) ) {
			wp_enqueue_style( 'cxf--fa5-admin', CXF_URL . 'assets/css/vendor/fontawesome.min.css', array(), '5.15.5', 'all' );
		}

		wp_enqueue_style(
			'cxf--options',
			CXF_URL . 'assets/css/cxf--options.css',
			array(),
			filemtime( CXF_PATH . 'assets/css/cxf--options.css' ),
			'all',
		);
	}

	/**
	 * Admin scripts
	 *
	 * @return void.
	 */
	public function cxf_admin_enqueue_scripts() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- This is a controlled admin context.
		if ( current_user_can( 'manage_options' ) && isset( $_GET['page'] ) && $_GET['page'] == 'codexshaper-framework-settings' ) {
			wp_enqueue_script( 'jquery-ui-accordion' );
		}

		// Added wp media.
		wp_enqueue_media();

		wp_enqueue_script( 'cxf--admin-localize', CXF_URL . 'assets/js/cxf--admin-localize.js', array( 'jquery' ), CXF_VERSION, true );
		$data = apply_filters(
			'cxf_admin_localize_data',
			array(
				'admin_uRL'       => admin_url(),
				'ajax_url'        => admin_url( 'admin-ajax.php' ),
				'cxf_nonce'       => wp_create_nonce( 'cxf_nonce' ),
				'post_id'         => get_the_ID(),
				'smooth_scroller' => json_decode( get_option( 'cxf_smooth_scroller' ) ),
				'color_palette'   => apply_filters( 'cxf_color_palette', array() ),
				'i18n'            => array(
					'confirm'         => esc_html__( 'Are you sure?', 'codexshaper-framework' ),
					'typing_text'     => esc_html__( 'Please enter two or more characters', 'codexshaper-framework' ),
					'searching_text'  => esc_html__( 'Searching...', 'codexshaper-framework' ),
					'no_results_text' => esc_html__( 'No results found.', 'codexshaper-framework' ),
				),
			)
		);

		wp_localize_script( 'cxf-admin-localize', 'CXF_ADMIN_LOCALIZE_JS', $data );
		wp_enqueue_script( 'cxf-admin-localize' );

		wp_enqueue_script(
			'cxf--plugins-script',
			CXF_URL . 'assets/js/cxf--plugins.js',
			array( 'jquery' ),
			filemtime( CXF_PATH . 'assets/js/cxf--plugins.js' ),
			true
		);

		wp_enqueue_script(
			'cxf--admin-script',
			CXF_URL . 'assets/js/cxf--admin.js',
			array( 'jquery', 'cxf--plugins-script', 'cxf--admin-localize' ),
			filemtime( CXF_PATH . 'assets/js/cxf--admin.js' ),
			true
		);

		wp_localize_script( 'cxf--admin-script', 'CXF_ADMIN_LOCALIZE_JS', $data );
	}
}
