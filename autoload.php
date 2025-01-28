<?php
/**
 * Autoload file
 *
 * @category   Autoload
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework;

use CodexShaper\Framework\Foundation\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // exit if access directly.
}

/**
 * Class Autoloader
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Autoload {

	use Singleton;

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Autoload
	 *
	 * Autoload all missing classes by their namespace.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $class_namespace class name with namespace.
	 *
	 * @return void
	 */
	private function autoload( $class_namespace ) {

		if ( 0 !== strpos( $class_namespace, __NAMESPACE__ ) ) {
			return;
		}

		if ( ! class_exists( $class_namespace ) ) {

			$class_namespace = str_replace( __NAMESPACE__ . '\\', '', $class_namespace );

			$file_namespace_path = strtolower(
				preg_replace(
					array( '/^\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '', '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$class_namespace
				)
			);

			$file_path = CXF_PATH . $file_namespace_path . '.php';

			if ( file_exists( $file_path ) && is_readable( $file_path ) ) {
				include $file_path;
			}
		}
	}
}

Autoload::instance();
