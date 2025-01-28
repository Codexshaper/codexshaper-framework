<?php
/**
 * Queryable Trait file
 *
 * @category   Query
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Traits\Query;

/**
 * Queryable trait
 *
 * @category   Trait
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
trait Queryable {

	use Query;

	/**
	 * Get current page
	 *
	 * @since 1.0.0
	 *
	 * @return int Current page number.
	 */
	public function get_current_page() {
		return max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
	}

	/**
	 * Is allowed pagination
	 *
	 * @since 1.0.0
	 *
	 * @return bool Whether pagination is allowed or not.
	 */
	public function is_allowed_pagination() {
		return 'yes' === $this->get_settings_for_display( 'allow_pagination' );
	}

	/**
	 * Get posts per page
	 *
	 * @param string      $field Field name.
	 * @param string|null $prefix Prefix.
	 *
	 * @since 1.0.0
	 *
	 * @return int Posts per page.
	 */
	public function get_posts_per_page( $field = 'posts_per_page', $prefix = null ) {
		$prefix         = $prefix ?? $this->prefix;
		$posts_per_page = $this->get_settings_for_display( $field );
		if ( ! $posts_per_page ) {
			$field = "{$prefix}_{$field}";
			return $this->get_settings_for_display( $field );
		}
		return $this->get_settings_for_display( $field );
	}
}
