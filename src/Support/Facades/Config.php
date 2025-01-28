<?php
/**
 * Config Facade file
 *
 * @category   Facade
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Support\Facades;

use CodexShaper\Framework\Config\Config as ConfigRepository;
use CodexShaper\Framework\Foundation\Facade;

// exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Config Facade class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Config extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return ConfigRepository::class;
	}
}
