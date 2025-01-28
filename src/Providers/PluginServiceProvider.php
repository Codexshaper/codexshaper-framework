<?php
/**
 * Plugin Service Provider File
 *
 * @category   Core
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Providers;

use CodexShaper\Framework\Admin\Menu;
use CodexShaper\Framework\Import\Importer;
use CodexShaper\Framework\Foundation\ServiceProvider;
use CodexShaper\Framework\Managers\Manager;
use CodexShaper\Framework\Foundation\Traits\Hook;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Plugin Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class PluginServiceProvider extends ServiceProvider {

	use Hook;

	/**
	 * Widget Manager
	 *
	 * @since 1.0.0
	 * @var CodexShaper\Framework\Managers\WidgetManager  Widget manager.
	 */
	protected $widget_manager;
	/**
	 * The provider class names.
	 *
	 * @var string[]
	 */
	public $providers = array();

	/**
	 * The singletons to register into the container.
	 *
	 * @var array
	 */
	public $singletons = array();

	/**
	 * Constructor
	 *
	 * Admin menu register.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register() {

		$this->providers = apply_filters( 'cxf_plugin_providers', $this->providers );

		$this->app->callMethod( array( $this, 'includes' ) );
		// Includes files.
		// $this->includes();
		// Initialize admin menu.
		Menu::instance();

		// Load plugin text domain.
		$this->add_action( 'init', 'load_textdomain' );
		// Add custom icon
		$this->add_filter( 'cxf_field_icon_add_icons', 'cxf_custom_icon' );
		// $this->add_filter('admin_init', 'import_demo_data', 9);
		// $this->add_filter('admin_init', 'setup_default_settings', 11);
		$this->add_action( 'plugins_loaded', 'cxf_plugins_loaded' );
	}

	/**
	 * Plugin loaded
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return void
	 */
	public function cxf_plugins_loaded() {
		// Element bucket initialize.
	}

	/**
	 * Register widgets
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return void
	 */
	public function register_widgets() {
		// Initialize WordPress widgets.
	}

	/**
	 * Includes
	 *
	 * Load all required static files.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	public function includes() {

		$files = array(
			array(
				'name' => 'autoload',
				'path' => '',
			),
			array(
				'name' => 'codestar-framework',
				'path' => 'lib/codestar-framework',
			),
			array(
				'name' => 'general',
				'path' => 'inc/helpers',
			),
			array(
				'name' => 'core',
				'path' => 'inc/helpers',
			),
			array(
				'name' => 'inflector',
				'path' => 'inc/utils',
			),

		);

		foreach ( $files as $file ) {

			$file_path = CXF_PATH . $file['path'] . '/' . $file['name'] . '.php';

			if ( file_exists( $file_path ) ) {
				require_once $file_path;
			}
		}
	}

	/**
	 * Text Domain
	 *
	 * Load text domain.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'codexshaper-framework',
			false,
			CXF_PATH . 'languages'
		);
	}

	/**
	 * Import Demo data
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function import_demo_data() {
		// $importer = new Importer();

		// $importer->import_demo_content();
		// $importer->setup_theme_options( '', 'cxf_theme_options' );
		// $importer->import_widgets();
		// $importer->import_customizer();
	}

	public function setup_default_settings() {
		$main_menu   = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$footer_menu = get_term_by( 'name', 'Footer Quick Links', 'nav_menu' );

		set_theme_mod(
			'nav_menu_locations',
			array(
				'main-menu'   => $main_menu->term_id,
				'footer-menu' => $footer_menu->term_id,
			)
		);

		// Assign front page and posts page (blog page).
		$front_page_id = cxf_get_page_by_title( 'Home One' );
		$blog_page_id  = cxf_get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
	}

	/**
	 * Custom icon
	 *
	 * Load custom icon
	 *
	 * @param array $icons Custom icons.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function cxf_custom_icon( $icons ) {
		// Adding new icon.
		$icons[] = array(
			'title' => esc_html__( 'Flaticon', 'codexshaper-framework' ),
			'icons' => array(
				'flaticon-right-arrow',
				'flaticon-left-arrow',
			),
		);
		$icons   = array_reverse( $icons );
		return $icons;
	}
}
