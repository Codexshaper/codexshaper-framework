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
use CodexShaper\Framework\Builder\Builder;
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
class BuilderServiceProvider extends ServiceProvider {

	use Hook;

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
		// Initialize admin menu.
		Builder::instance();
	}

}
