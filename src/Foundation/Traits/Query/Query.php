<?php
/**
 * Query Trait file
 *
 * @category   Query
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Traits\Query;

use CodexShaper\Framework\Models\Control\QueryGroup;

/**
 *  Query trait
 *
 * @category   Trait
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
trait Query {

	/**
	 * Query args
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Query prefix
	 *
	 * @var string
	 */
	protected $prefix = 'posts';

	/**
	 * Query arguments
	 *
	 * @var array
	 */
	protected $query_args = array();

	/**
	 * Set tags
	 *
	 * @var bool
	 */
	protected $set_tags = true;

	/**
	 * Query
	 *
	 * @var \WP_Query
	 */
	protected $query;

	/**
	 * Get Query.
	 *
	 * @param array  $query_args   Query arguments
	 * @param string $prefix        Query prefix
	 * @param bool   $set_tags      Set tags
	 *
	 * @return \WP_Query
	 */
	public function get_query( $query_args = array(), $prefix = '', $set_tags = true ) {
		if ( ! empty( $query_args ) || ! $this->query ) {
			$this->set_query( $query_args, $prefix, $set_tags );
		}

		return $this->query;
	}

	/**
	 * Set Query.
	 *
	 * @param array  $query_args   Query arguments
	 * @param string $prefix        Query prefix
	 * @param bool   $set_tags      Set tags
	 *
	 * @return \WP_Query
	 */
	public function set_query( $query_args = array(), $prefix = '', $set_tags = true ) {
		if ( ! $prefix && method_exists( $this, 'get_prefix' ) ) {
			$prefix = $this->get_prefix();
		}
		if ( ( ! $query_args || empty( $query_args ) ) && method_exists( $this, 'get_query_args' ) ) {
			$query_args = $this->get_query_args();
		}
		if ( ! $set_tags && method_exists( $this, 'is_set_tags' ) ) {
			$set_tags = $this->is_set_tags();
		}

		$query_group_model = new QueryGroup( $this, $prefix, $query_args, array() );
		$this->query       = $query_group_model->get_query();

		if ( ! $this->query->found_posts ) {
			return;
		}

		if ( $set_tags ) {
			$this->set_posts_tags();
		}

		return $this->query;
	}

	/**
	 * Set post tags
	 *
	 * @return void
	 */
	protected function set_posts_tags() {
		$taxonomy = $this->get_settings( 'taxonomy' );

		foreach ( $this->query->posts as $post ) {
			if ( ! $taxonomy ) {
				$post->tags = array();

				continue;
			}

			$tags = wp_get_post_terms( $post->ID, $taxonomy );

			$tags_slugs = array();

			foreach ( $tags as $tag ) {
				$tags_slugs[ $tag->term_id ] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}

	/**
	 * Get prefix.
	 *
	 * @return string Prefix.
	 */
	public function get_prefix() {
		return $this->prefix;
	}

	/**
	 * Get query args.
	 *
	 * @return array Query args.
	 */
	public function get_query_args() {
		return $this->query_args;
	}

	/**
	 * Get set tags status.
	 *
	 * @return bool Is set tags?
	 */
	public function is_set_tags() {
		return $this->set_tags;
	}
}
