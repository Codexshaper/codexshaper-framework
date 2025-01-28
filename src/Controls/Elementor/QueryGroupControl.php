<?php
/**
 * Query Group file
 *
 * @category   Query Group
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Controls\Elementor;

use CodexShaper\Framework\Foundation\Traits\Query\Fields;
use Elementor\Group_Control_Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Query Group Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class QueryGroupControl extends Group_Control_Base {

	use Fields;

	/**
	 * Get control type
	 *
	 * Retrieve the control type, in this case `query-group-control`.
	 *
	 * @return string Control type.
	 *
	 * @since 1.0.0
	 */
	public static function get_type() {
		return 'query-group-control';
	}

	/**
	 * Get default options
	 *
	 * Retrieve the default options of the control.
	 *
	 * @return array Control default options.
	 *
	 * @since 1.0.0
	 */
	protected function get_default_options() {
		return array(
			'popover' => false,
		);
	}

	/**
	 * Initialize arguments
	 *
	 * @param array $args Fields arguments.
	 *
	 * @return void
	 *
	 * @since 1.0.0
	 */
	protected function init_args( $args ) {
		parent::init_args( $args );
		$args           = $this->get_args();
		static::$fields = $this->init_fields_by_name( $args['name'] );
	}
}
