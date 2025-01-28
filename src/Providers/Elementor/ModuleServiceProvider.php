<?php
/**
 * Module Service Provider File
 *
 * @category   ServiceProvider
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Providers\Elementor;

use Elementor\Plugin;
use CodexShaper\Framework\Base\BaseModule;
use CodexShaper\Framework\Foundation\ServiceProvider;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *  Module Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class ModuleServiceProvider extends ServiceProvider {
	/**
	 * @var BaseModule[]
	 */
	private $modules = array();

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
		$modules = array();

		$module_directory = CXF_PATH . 'widgets/elementor/modules/*/';
		foreach ( glob( $module_directory ) as $path ) {
			if ( is_dir( $path ) ) {
				$parts  = explode( '/', untrailingslashit( $path ) );
				$module = end( $parts );

				if ( ! in_array( $module, $modules, true ) ) {
					$modules[] = $module;
				}
			}
		}

		foreach ( $modules as $module_name ) {
			$words            = str_replace( '-', ' ', $module_name );
			$module_namespace = str_replace( ' ', '', ucwords( $words ) );
			$module_class     = '\CodexShaper\Framework\Widgets\Elementor\Modules\\' . $module_namespace . '\Module';

			/** @var BaseModule $module_class */
			$experimental_data = $module_class::get_experimental_data();

			if ( $experimental_data ) {
				Plugin::instance()->experiments->add_feature( $experimental_data );

				if ( ! Plugin::instance()->experiments->is_feature_active( $experimental_data['name'] ) ) {
					continue;
				}
			}

			if ( $module_class::is_active() ) {
				$this->modules[ $module_name ] = $module_class::instance();
			}
		}
	}

	/**
	 * Get modules
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string|null $module_name The module name.
	 *
	 * @return BaseModule|BaseModule[]
	 */
	public function get_modules( $module_name = null ) {
		if ( $module_name ) {
			if ( isset( $this->modules[ $module_name ] ) ) {
				return $this->modules[ $module_name ];
			}

			return null;
		}

		return $this->modules;
	}
}
