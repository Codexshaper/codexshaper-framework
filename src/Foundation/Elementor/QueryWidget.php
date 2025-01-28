<?php
/**
 * Query Widget file
 *
 * @category   Query
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Elementor;

use CodexShaper\Framework\Foundation\Traits\Query\Queryable;

// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Query widget class for element bucket
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
abstract class QueryWidget extends Widget {

	use Queryable;

	/**
	 * Get Pagination Current Page
	 *
	 * @since 3.8.0
	 * @access public
	 *
	 * @param string $field
	 *
	 * @return mixed
	 */
	public function get_pagination_current_page( $field = 'pagination_type' ) {

		if ( ! method_exists( $this, 'get_settings_for_display' ) ) {
			return 1;
		}

		$field           = $field ?? 'pagination_type';
		$pagination_type = $this->get_settings_for_display( $field );

		if ( '' === $pagination_type ) {
			return 1;
		}

		return $this->get_current_page();
	}

	/**
	 * Get Skin Posts Per Page Value
	 *
	 * Returns the value of the Posts Per Page control of the widget. This method was created because in some cases,
	 * the control is registered in the widget, and in some cases, it is registered in a widget skin.
	 *
	 * @since 3.8.0
	 * @access protected
	 *
	 * @return mixed
	 */
	protected function get_skin_posts_per_page( $field = 'posts_per_page' ) {
		$posts_per_page = 6;

		if ( $skin = $this->get_current_skin() ) {
			$posts_per_page = $skin->get_instance_value( $field );
		}
		return $posts_per_page;
	}
}
