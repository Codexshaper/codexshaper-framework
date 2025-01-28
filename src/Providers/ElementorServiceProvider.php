<?php
/**
 * Elementor Service Provider File
 *
 * @category   Service Provider
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Providers;

use CodexShaper\Framework\Foundation\ServiceProvider;
use CodexShaper\Framework\Foundation\Traits\Hook;
use CodexShaper\Framework\Providers\Elementor\ControlServiceProvider;
use CodexShaper\Framework\Providers\Elementor\ModuleServiceProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class ElementorServiceProvider extends ServiceProvider {
	use Hook;

	/**
	 * The provider class names.
	 *
	 * @var string[]
	 */
	public $providers = array();

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the bucket.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.21.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the bucket.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Module Manager
	 *
	 * @since 1.0.0
	 * @access private
	 * @var \CodexShaper\Framework\Manager\ElementorModuleManager module manager.
	 */
	private $module_manager;

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {

		$this->providers = apply_filters( 'cxf_elementor_providers', $this->providers );

		add_action( 'init', array( $this, 'load_text_domain' ) );

		if ( $this->is_compatible() ) {
			$this->providers = array_merge(
				$this->providers,
				array(
					ControlServiceProvider::class,
					ModuleServiceProvider::class,
				)
			);
			add_action( 'elementor/init', array( $this, 'init' ) );

			// Styles.
			add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'register_frontend_styles' ) );
			add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_styles' ) );

			// Scripts.
			add_action( 'elementor/frontend/before_register_scripts', array( $this, 'register_frontend_scripts' ) );
			add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
			add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'enqueue_slider_scripts' ) );

		}
		// Admin enqueue.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function load_text_domain() {
		load_plugin_textdomain( 'codexshaper-framework', false, CXF_PATH . '/languages/' );
	}

	/**
	 * Initialize
	 *
	 * Load the buckets functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		// Register Widget Categories.
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
	}

	/**
	 * Register frontend styles
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_frontend_styles() {
		wp_register_style(
			'cxf-eb-swiper',
			CXF_URL . 'widgets/elementor/assets/vendor/swiper/bundle.min.css',
			array(),
			'11.1.4',
			'all'
		);

		wp_register_style(
			'cxf-eb-magnefic',
			CXF_URL . 'widgets/elementor/assets/vendor/magnefic.css',
			array(),
			CXF_VERSION,
			'all'
		);

		wp_enqueue_style( 'cxf-eb-magnefic' );
	}

	/**
	 * Enqueue styles
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'cxf-eb-frontend',
			CXF_URL . 'widgets/elementor/assets/css/eb-frontend.css',
			array(),
			CXF_VERSION,
			'all'
		);
	}

	/**
	 * Register frontend scripts
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_frontend_scripts() {
		wp_register_script(
			'cxf-eb-swiper',
			CXF_URL . 'widgets/elementor/assets/vendor/swiper/bundle.min.js',
			array( 'jquery' ),
			'11.1.4',
			true
		);

		wp_register_script(
			'cxf-eb-magnefic',
			CXF_URL . 'widgets/elementor/assets/vendor/magnefic.min.js',
			array(),
			CXF_VERSION,
			true
		);
	}

	/**
	 * Enqueue frontend scripts
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_frontend_scripts() {
	}

	/**
	 * Enqueue slider scripts
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_slider_scripts() {
		wp_register_script(
			'cxf--slider',
			CXF_URL . 'assets/js/cxf--slider.js',
			array(),
			filemtime( CXF_PATH . 'assets/js/cxf--slider.js' ),
			true
		);

		// wp_enqueue_script( 'cxf--slider' );
	}

	/**
	 * Enqueue admin scripts
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_enqueue() {
		wp_register_style(
			'cxf-eb-admin-css',
			CXF_URL . 'widgets/elementor/assets/css/eb-admin.css',
			array(),
			CXF_VERSION,
			'all',
		);

		wp_register_style(
			'cxf-eb-google-fonts',
			add_query_arg( 'family', rawurlencode( 'Rethink+Sans:ital,wght@0,400..800;1,400..800&display=swap' ), '//fonts.googleapis.com/css' ),
			array(),
			CXF_VERSION,
			'all',
		);

		wp_enqueue_style( 'cxf-eb-admin-css' );
		wp_enqueue_style( 'cxf-eb-google-fonts' );
	}

	/**
	 * Register elementor categories
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param \Elementor\Elements_Manager $elements_manager elements manager object.
	 *
	 * @return void
	 */
	public function add_widget_categories( $elements_manager ) {

		$categories = array(
			'cxf--widget' => array(
				'title' => esc_html__( 'CXF', 'codexshaper-framework' ),
				'icon'  => 'fa fa-plug',
			),
		);

		// See the original solution here https://github.com/elementor/elementor/issues/7445#issuecomment-692123467
		$old_categories = $elements_manager->get_categories();
		$categories     = array_merge( $categories, $old_categories );

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	/**
	 * Check compatibility
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor_activation' ) );
			return false;
		}

		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return false;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return false;
		}

		return true;
	}

	/**
	 * Check element active or not. If not active display activation button.
	 * If not installed then diaplay installation button.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_notice_missing_elementor_activation() {

		$btn['text'] = esc_html__( 'Install Elementor', 'codexshaper-framework' );
		$btn['url']  = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$btn['text'] = esc_html__( 'Activate Elementor', 'codexshaper-framework' );
			$btn['url']  = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
		}

		printf(
			'<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',
			sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated. Click here to %3$s', 'codexshaper-framework' ),
				'<strong>' . esc_html__( 'CodexShaper Framework', 'codexshaper-framework' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'codexshaper-framework' ) . '</strong>',
				'<a href="' . esc_url( $btn['url'] ) . '" class="button button-primary">' . esc_html( $btn['text'] ) . '</a>'
			)
		);
	}

	/**
	 * Check minimum elementor version
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_notice_minimum_elementor_version() {

		printf(
			'<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',
			sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'codexshaper-framework' ),
				'<strong>' . esc_html__( 'CodexShaper Framework', 'codexshaper-framework' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'codexshaper-framework' ) . '</strong>',
				esc_html( self::MINIMUM_ELEMENTOR_VERSION )
			)
		);
	}

	/**
	 * Check PHP Version
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function admin_notice_minimum_php_version() {

		printf(
			'<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>',
			sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'codexshaper-framework' ),
				'<strong>' . esc_html__( 'CodexShaper Framework', 'codexshaper-framework' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'codexshaper-framework' ) . '</strong>',
				esc_html( self::MINIMUM_PHP_VERSION )
			)
		);
	}

	/**
	 * Get asset url
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @param string $path an asset path.
	 *
	 * @return string
	 */
	public static function asset_url( $path = '' ) {
		return CXF_URL . 'widgets/elementor/assets/' . $path;
	}
}
