<?php
/**
 * Post file
 *
 * @category   ORM
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/CodexShaper-Devs/cxf
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Models\Control;

use CodexShaper\Framework\Foundation\Model;
use WP_Query;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/CodexShaper-Devs/cxf
 * @since      1.0.0
 */
class QueryGroup extends Model {

	/**
	 * Base Widget Object.
	 *
	 * @var Widget_Base $widget The widget object that represents this widget instance.
	 */
	protected $widget;

	/**
	 * Query.
	 *
	 * @var \WP_Query $query The query object.
	 */
	protected $query;

	/**
	 * Fallback query args.
	 *
	 * @var array $query_args The query arguments.
	 */
	protected $query_args;

	/**
	 * Fallback query args.
	 *
	 * @var array $fallback_args The fallback query arguments.
	 */
	protected $fallback_args = array();

	/**
	 * Prefix.
	 *
	 * @var string $prefix The prefix for the query group.
	 */
	protected $prefix;

	/**
	 * Widget settings.
	 *
	 * @var array $widget_settings The widget settings.
	 */
	protected $widget_settings;

	/**
	 * Displayed IDs.
	 *
	 * @var array $displayed_ids The displayed IDs.
	 */
	protected $displayed_ids = array();

	/**
	 * Defaults.
	 *
	 * @var array $defaults The default values.
	 */
	protected $defaults = array();

	/**
	 * Query Group Model constructor.
	 *
	 * @param Widget_Base $widget
	 * @param string      $group_name_prefix
	 * @param array       $query_args
	 *
	 * @return void
	 */
	public function __construct( $widget, $group_name_prefix = '', $query_args = array() ) {
		$this->widget     = $widget;
		$this->prefix     = $group_name_prefix ? $group_name_prefix . '_' : '';
		$this->query_args = $query_args;

		$this->defaults = array(
			$this->prefix . 'post_type'      => 'post',
			$this->prefix . 'posts_ids'      => array(),
			$this->prefix . 'orderby'        => 'date',
			$this->prefix . 'order'          => 'desc',
			$this->prefix . 'offset'         => 0,
			$this->prefix . 'posts_per_page' => 3,
		);

		$settings = $this->widget->get_settings_for_display();

		$this->widget_settings = wp_parse_args( $settings, $this->defaults );
	}

	/**
	 * Get built WP_Query
	 *
	 * @return \WP_Query
	 */
	public function get_query() {

		$query_type     = $this->get_widget_settings( 'query_type' );
		$offset_control = $this->get_widget_settings( 'offset' );

		if ( 'current_query' === $query_type ) {
			$this->set_current_query_args();
			return new WP_Query( $this->query_args );
		}

		// Set query args and return all args.
		$this->set_custom_query_args();

		if ( 0 < $offset_control ) {
			/**
			 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
			 */
			add_action( 'pre_get_posts', array( $this, 'set_query_offset' ), 1 );
			add_filter( 'found_posts', array( $this, 'adjust_query_offset_pagination' ), 1, 2 );
		}

		$this->query = new WP_Query( $this->query_args );

		if (
			! $this->query->post_count &&
			'related' === $query_type &&
			in_array( $this->get_widget_settings( 'related_fallback' ), array( 'fallback_recent', 'fallback_by_id' ) )
		) {

			$this->set_relative_query_args();

			$this->query = new \WP_Query( $this->fallback_args );

		}

		// Reset hooked hooks
		remove_action( 'pre_get_posts', array( $this, 'set_query_offset' ), 1 );
		remove_filter( 'found_posts', array( $this, 'adjust_query_offset_pagination' ), 1 );

		return $this->query;
	}

	/**
	 * Set current query args
	 *
	 * @return void
	 */
	protected function set_current_query_args() {
		$current_query_vars = $GLOBALS['wp_query']->query_vars;

		/**
		 * Add paged option support.
		 */
		if ( ! empty( $this->query_args['allow_pagination'] ) && true === $this->query_args['allow_pagination'] ) {
			$current_query_vars['paged'] = $this->query_args['paged'];
		}

		/**
		 * Current query variables.
		 *
		 * Filters the query variables for the current query. This hook allows
		 * developers to alter those variables.
		 *
		 * @since 1.0.0
		 *
		 * @param array $current_query_vars Current query variables.
		 */
		$current_query_vars = apply_filters( 'cxf/query/get_query_args/current_query', $current_query_vars );

		$this->query_args = $current_query_vars;
	}

	/**
	 * Set relative query args
	 *
	 * @return void
	 */
	protected function set_relative_query_args() {
		$post_type = $this->get_widget_settings( 'post_type' );
		// Set Related query args
		$this->set_fallback_query_arg( 'ignore_sticky_posts', true );
		$this->set_fallback_query_arg( 'post_status', 'publish' );
		$this->set_fallback_query_arg( 'post_type', $post_type );

		if ( 'fallback_by_id' === $this->get_widget_settings( 'related_fallback' ) ) {
			$this->set_fallback_query_arg( 'post__in', array( 0 ), 'fallback_ids' );
			$this->set_fallback_query_arg( 'orderby', 'rand' );
		} else { // recent posts
			$this->set_fallback_query_arg( 'orderby', 'date' );
			$this->set_fallback_query_arg( 'order', 'DESC' );
		}

		$this->set_fallback_query_arg( 'posts_per_page', $this->query->query_vars['posts_per_page'] );
		$this->set_fallback_query_arg( 'post__not_in', $this->query->query_vars['post__not_in'] );

		/**
		 * Fallback query arguments.
		 *
		 * Filters the query arguments for the fallback query. This hook allows
		 * developers to alter those arguments.
		 *
		 * @param array       $fallback_args An array of WordPress query arguments.
		 * @param Widget_Base $widget        An instance of Elementor widget.
		 */
		$this->fallback_args = apply_filters( 'cxf/query/fallback_query_args', $this->fallback_args, $this->widget );
	}

	/**
	 * Set custom query args
	 *
	 * @return array
	 */
	protected function set_custom_query_args() {
		$post_type = $this->get_widget_settings( 'post_type' );

		// Setup Common
		$this->query_args['post_status'] = 'publish';
		$this->query_args['post_type']   = $post_type;

		// Setup order args
		$this->set_query_arg( 'orderby', $this->get_widget_settings( 'orderby' ) );
		$this->set_query_arg( 'order', $this->get_widget_settings( 'order' ) );

		// Pagination
		$this->set_query_arg( 'posts_per_page', $this->get_widget_settings( 'posts_per_page' ) );
		$sticky_post = $this->get_widget_settings( 'ignore_sticky_posts' ) ? true : false;
		$this->set_query_arg( 'ignore_sticky_posts', $sticky_post );

		$this->set_post_exclude_args();
		$this->set_terms_args();
		$this->set_author_args();
		$this->set_date_args();

		/**
		 * Current query arguments.
		 *
		 * Filters the query arguments for the current query. This hook allows
		 * developers to alter those arguments.
		 *
		 * @param array       $query_args An array of WordPress query arguments.
		 * @param Widget_Base $widget     An instance of Elementor widget.
		 */
		$this->query_args = apply_filters( 'cxf/query/query_args', $this->query_args, $this->widget );

		return $this->query_args;
	}

	/**
	 * Set Query Offset
	 *
	 * @param \WP_Query $query
	 */
	public function set_query_offset( &$query ) {
		$offset                      = $this->get_widget_settings( 'offset' );
		$query->query_vars['offset'] = $offset;

		if ( $offset && $query->is_paged ) {
			$query->query_vars['offset'] = $offset + ( ( $query->query_vars['paged'] - 1 ) * $query->query_vars['posts_per_page'] );
		}
	}

	/**
	 * @param int       $found_posts
	 * @param \WP_Query $query
	 *
	 * @return int
	 */
	public function adjust_query_offset_pagination( $found_posts, $query ) {
		$offset = $this->get_widget_settings( 'offset' );

		if ( $offset ) {
			$found_posts -= $offset;
		}

		return $found_posts;
	}

	protected function get_query_defaults() {
		return $this->defaults;
	}

	/**
	 * @param string $control_name
	 *
	 * @return mixed|null
	 */
	protected function get_widget_settings( $control_name ) {
		$control_name = $this->prefix . $control_name;
		return isset( $this->widget_settings[ $control_name ] ) ? $this->widget_settings[ $control_name ] : null;
	}

	/**
	 * Is manual selection
	 *
	 * @return bool Is manual selection?
	 */
	private function is_manual_selection(): bool {
		return 'by_id' === $this->get_widget_settings( 'post_type' );
	}

	/**
	 * Set query arg
	 *
	 * @param string $key  The key to set.
	 * @param mixed  $value The value to set.
	 * @param false  $override Whether to override the value if it already exists.
	 *
	 * @return void
	 */
	protected function set_query_arg( $key, $value, $override = false ) {
		if ( ! isset( $this->query_args[ $key ] ) || $override ) {
			$this->query_args[ $key ] = $value;
		}
	}

	/**
	 * @param string $key The key to set.
	 * @param mixed  $value The value to set.
	 * @param string $control_name The control name.
	 *
	 * @return void
	 */
	protected function set_fallback_query_arg( $key, $value, $control_name = '' ) {
		if ( empty( $this->fallback_args[ $key ] ) ) {
			$settings                    = $this->widget->get_settings();
			$this->fallback_args[ $key ] = ( '' === $control_name || empty( $settings[ $this->prefix . $control_name ] ) ) ? $value : $settings[ $this->prefix . $control_name ];
		}
	}

	/**
	 * Set post exclude args
	 *
	 * @return void
	 */
	protected function set_post_exclude_args() {

		$exclude = $this->get_widget_settings( 'exclude' );

		if ( empty( $exclude ) ) {
			return;
		}

		$post__not_in = array();

		if ( $this->maybe_in_array( 'current_post', $exclude ) ) {
			if ( is_singular() ) {
				$post__not_in[] = get_queried_object_id();
			}
		}

		$exclude_ids = $this->get_widget_settings( 'exclude_ids' );

		if ( is_string( $exclude_ids ) ) {
			$exclude_ids = explode( ',', $exclude_ids );
		}

		if ( $this->maybe_in_array( 'manual_selection', $exclude ) && ! empty( $exclude_ids ) ) {
			$post__not_in = array_merge( $post__not_in, $exclude_ids );
		}

		$this->set_query_arg( 'post__not_in', $post__not_in );
	}

	/**
	 * Set terms args
	 *
	 * @return void
	 */
	protected function set_terms_args() {
		if ( $this->is_manual_selection() ) {
			return;
		}

		$this->build_terms_query_include( 'include_term_ids' );
		$this->build_terms_query_exclude( 'exclude_term_ids' );
	}

	/**
	 * Build terms query include
	 *
	 * @param string $control_id
	 *
	 * @return void
	 */
	protected function build_terms_query_include( $control_id ) {
		$this->build_terms_query( 'include', $control_id );
	}

	/**
	 * Build terms query exclude
	 *
	 * @param string $control_id
	 *
	 * @return void
	 */
	protected function build_terms_query_exclude( $control_id ) {
		$this->build_terms_query( 'exclude', $control_id, true );
	}

	/**
	 * Build terms query
	 *
	 * @param string $tab_id The tab id.
	 * @param string $control_id The control id.
	 * @param bool   $exclude Whether to exclude the terms.
	 *
	 * @return void
	 */
	protected function build_terms_query( $tab_id, $control_id, $exclude = false ) {
		$tab_id         = $this->get_widget_settings( $tab_id );
		$settings_terms = $this->get_widget_settings( $control_id );

		if ( empty( $tab_id ) || empty( $settings_terms ) || ! $this->maybe_in_array( 'terms', $tab_id ) ) {
			return;
		}

		if ( is_string( $settings_terms ) ) {
			$settings_terms = explode( ',', $settings_terms );
		}

		if ( ! is_array( $settings_terms ) ) {
			$settings_terms = (array) $settings_terms;
		}

		$terms = array();

		foreach ( $settings_terms as $id ) {
			$id        = (int) $id;
			$term_data = get_term_by( 'term_taxonomy_id', $id );
			if ( false !== $term_data ) {
				$taxonomy             = $term_data->taxonomy;
				$terms[ $taxonomy ][] = $id;
			}
		}

		$this->insert_tax_query( $terms, $exclude );
	}

	/**
	 * Insert tax query
	 *
	 * @param array $terms The terms.
	 * @param bool  $exclude Whether to exclude the terms.
	 *
	 * @return void
	 */
	protected function insert_tax_query( $terms, $exclude ) {
		$tax_query = array();
		foreach ( $terms as $taxonomy => $ids ) {
			$query = array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_taxonomy_id',
				'terms'    => $ids,
			);

			if ( $exclude ) {
				$query['operator'] = 'NOT IN';
			}

			$tax_query[] = $query;
		}

		if ( empty( $tax_query ) ) {
			return;
		}

		if ( empty( $this->query_args['tax_query'] ) ) {
			$this->query_args['tax_query'] = $tax_query;
		} else {
			$this->query_args['tax_query']['relation'] = 'AND';
			$this->query_args['tax_query'][]           = $tax_query;
		}
	}

	/**
	 * Set author args
	 *
	 * @return void
	 */
	protected function set_author_args() {

		$include_authors = $this->get_widget_settings( 'include_authors' );

		if ( is_string( $include_authors ) ) {
			$include_authors = explode( ',', $include_authors );
		}

		if ( ! is_array( $include_authors ) ) {
			$include_authors = (array) $include_authors;
		}

		if ( ! empty( $include_authors ) && $this->maybe_in_array( 'authors', $this->get_widget_settings( 'include' ) ) ) {
			$this->set_query_arg( 'author__in', $include_authors );
		}

		// exclude only if not explicitly included
		if ( empty( $this->query_args['author__in'] ) ) {

			$exclude_authors = $this->get_widget_settings( 'exclude_authors' );

			if ( is_string( $exclude_authors ) ) {
				$exclude_authors = explode( ',', $exclude_authors );
			}

			if ( ! empty( $exclude_authors ) && $this->maybe_in_array( 'authors', $this->get_widget_settings( 'exclude' ) ) ) {
				$this->set_query_arg( 'author__not_in', $exclude_authors );
			}
		}
	}

	/**
	 * Set date args
	 *
	 * @return void
	 */
	protected function set_date_args() {

		$post_date = $this->get_widget_settings( 'post_date' );

		if ( ! $post_date ) {
			return;
		}

		$date_query['after'] = $post_date;

		if ( 'custom' === $post_date ) {
			$after_date = $this->get_widget_settings( 'date_after' );
			if ( ! empty( $after_date ) ) {
				$date_query['after'] = $after_date;
			}
			$before_date = $this->get_widget_settings( 'date_before' );
			if ( ! empty( $before_date ) ) {
				$date_query['before'] = $before_date;
			}
			$date_query['inclusive'] = true;
		}

		$this->set_query_arg( 'date_query', $date_query );
	}

	/**
	 * @param string $value The value to check.
	 * @param mixed  $maybe_array The maybe array.
	 *
	 * @return bool Whether the value is in the array.
	 */
	protected function maybe_in_array( $value, $maybe_array ) {
		return is_array( $maybe_array ) ? in_array( $value, $maybe_array, true ) : $value === $maybe_array;
	}
}
