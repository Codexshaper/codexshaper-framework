<?php
/**
 *  Admin Service Provider File
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

/**
 *  Admin Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class AdminServiceProvider extends ServiceProvider {

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
		// Registere code.
		$this->providers = apply_filters( 'cxf_console_providers', $this->providers );
	}
}
