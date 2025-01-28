<?php
/**
 * Config file
 *
 * @category   Support
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Config;

// exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Config class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Config {

	protected $configs = array();

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
	public function __construct() {
		// Do your settings here
	}

	/**
	 * Get the Config
	 *
	 * @param string $path The path of the config.
	 * @return WP_Config The Config instance.
	 */
	public function get( $path ) {
		$path  = str_replace( array( '.', '|' ), ' ', $path );
		$parts = explode( ' ', $path );

		$configs = array();

		if ( count( $parts ) > 0 ) {
			$config_path = CXF_CONFIG_PATH . $parts[0] . '.php';
			if ( file_exists( $config_path ) ) {
				$configs = include $config_path;
			}
		}

		unset( $parts[0] );

		foreach ( $parts as $part ) {
			$configs = $configs[ $part ] ?? array();
		}

		return $configs;
	}
}
