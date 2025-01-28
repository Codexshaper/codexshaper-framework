<?php
/**
 * Plugin Name:       CodexShaper Framework
 * Plugin URI:        https://github.com/Codexshaper/codexshaper-framework/
 * Description:       A framework for WordPress.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Codexshaper
 * Author URI:       https://github.com/Codexshaper/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       codexshaper-framework
 * Domain Path:       /languages
 *
 * @package CodexShaper_Framework
 */

/**
 * If this file is called directly, abort.
 *
 * @package CodexShaper_Framework
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin directory path
 *
 * @package CodexShaper_Framework
 */

if ( ! defined( 'CXF_VERSION' ) ) {
	define( 'CXF_VERSION', '1.0.0' );
}

if ( ! defined( 'CXF_FILE' ) ) {
	define( 'CXF_FILE', trailingslashit( __FILE__ ) );
}

if ( ! defined( 'CXF_PLUGIN_BASE' ) ) {
	define( 'CXF_PLUGIN_BASE', trailingslashit( plugin_basename( CXF_FILE ) ) );
}

if ( ! defined( 'CXF_PATH' ) ) {
	define( 'CXF_PATH', trailingslashit( plugin_dir_path( CXF_FILE ) ) );
}

if ( ! defined( 'CXF_CONFIG_PATH' ) ) {
	define( 'CXF_CONFIG_PATH', CXF_PATH . 'config/' );
}

if ( ! defined( 'CXF_ASSETS_PATH' ) ) {
	define( 'CXF_ASSETS_PATH', CXF_PATH . 'assets/' );
}

if ( ! defined( 'CXF_WP_ASSETS_PATH' ) ) {
	define( 'CXF_WP_ASSETS_PATH', CXF_PATH . 'widgets/wordpress/assets/' );
}

if ( ! defined( 'CXF_WP_MODULES_PATH' ) ) {
	define( 'CXF_WP_MODULES_PATH', CXF_PATH . 'widgets/wordpress/modules/' );
}

if ( ! defined( 'CXF_ELEMENTOR_ASSETS_PATH' ) ) {
	define( 'CXF_ELEMENTOR_ASSETS_PATH', CXF_PATH . 'widgets/elementor/assets/' );
}

if ( ! defined( 'CXF_ELEMENTOR_MODULES_PATH' ) ) {
	define( 'CXF_ELEMENTOR_MODULES_PATH', CXF_PATH . 'widgets/elementor/modules/' );
}

if ( ! defined( 'CXF_URL' ) ) {
	define( 'CXF_URL', trailingslashit( plugins_url( '/', CXF_FILE ) ) );
}

if ( ! defined( 'CXF_CONFIG_URL' ) ) {
	define( 'CXF_CONFIG_URL', CXF_URL . 'config/' );
}

if ( ! defined( 'CXF_ASSETS_URL' ) ) {
	define( 'CXF_ASSETS_URL', CXF_URL . 'assets/' );
}

if ( ! defined( 'CXF_WP_ASSETS_URL' ) ) {
	define( 'CXF_WP_ASSETS_URL', CXF_URL . 'widgets/wordpress/assets/' );
}

if ( ! defined( 'CXF_WP_MODULES_URL' ) ) {
	define( 'CXF_WP_MODULES_URL', CXF_URL . 'widgets/wordpress/modules/' );
}

if ( ! defined( 'CXF_ELEMENTOR_ASSETS_URL' ) ) {
	define( 'CXF_ELEMENTOR_ASSETS_URL', CXF_URL . 'widgets/elementor/assets/' );
}

if ( ! defined( 'CXF_ELEMENTOR_MODULES_URL' ) ) {
	define( 'CXF_ELEMENTOR_MODULES_URL', CXF_URL . 'widgets/elementor/modules/' );
}

if ( ! defined( 'CXF_WP_MODULE_PREFIX' ) ) {
	define( 'CXF_WP_MODULE_PREFIX', 'cxf--wp-module' );
}

if ( ! defined( 'CXF_WP_WIDGET_PREFIX' ) ) {
	define( 'CXF_WP_WIDGET_PREFIX', 'cxf--wp' );
}

if ( ! defined( 'CXF_ELEMENTOR_MODULE_PREFIX' ) ) {
	define( 'CXF_ELEMENTOR_MODULE_PREFIX', 'cxf-' );
}

if ( ! defined( 'CXF_ELEMENTOR_WIDGET_PREFIX' ) ) {
	define( 'CXF_ELEMENTOR_WIDGET_PREFIX', 'cxf-' );
}

if ( file_exists( CXF_PATH . 'vendor/autoload.php' ) ) {
	require_once CXF_PATH . 'vendor/autoload.php';

	// Initialize core plugin.
	if ( class_exists( '\CodexShaper\Framework\Application' ) ) {
		global $app;

		$app = new CodexShaper\Framework\Application();
	}
}


if ( ! function_exists( 'cxf_plugin_activate' ) ) {

	function cxf_plugin_activate() {
		flush_rewrite_rules();
	}
}

register_activation_hook( CXF_FILE, 'cxf_plugin_activate' );
