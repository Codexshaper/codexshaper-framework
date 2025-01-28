<?php
/**
 * Query Fields Trait file
 *
 * @category   Query
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Traits\Query;

use CodexShaper\Framework\Models\Post\Post;
use CodexShaper\Framework\Models\Taxonomies\Taxonomy;
use Elementor\Controls_Manager;

/**
 * Query Fields trait
 *
 * @category   Trait
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
trait Fields {

	/**
	 * Fields
	 *
	 * @var array
	 */
	protected static $fields;

	/**
	 * Initialize fields
	 *
	 * @return array Fields.
	 * @since 1.0.0
	 */
	protected function init_fields() {
		$args = $this->get_args();
		return $this->init_fields_by_name( $args['name'] );
	}

	/**
	 * Initialize fields by name
	 *
	 * @param string $name Field name.
	 *
	 * @return array Fields.
	 * @since 1.0.0
	 */
	protected function init_fields_by_name( $name ) {
		$fields             = array();
		$name              .= '_';
		$args               = $this->get_args();
		$post_type_args     = array();
		$default_post_types = array();

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['post_type'] = $args['post_type'];
		}

		$post_types        = Post::get_public_types( $post_type_args, $default_post_types );
		$default_post_type = false !== array_key_exists( 'post', $post_types ) ? 'post' : key( $post_types );
		$related_terms     = Taxonomy::get_supported_taxonomies( $post_types );

		$fields['query_type'] = array(
			'label'   => esc_html__( 'Query Type', 'codexshaper-framework' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'custom',
			'options' => array(
				'custom'        => esc_html__( 'Custom', 'codexshaper-framework' ),
				'related'       => esc_html__( 'Related', 'codexshaper-framework' ),
				'current_query' => esc_html__( 'Current Query', 'codexshaper-framework' ),
			),
		);

		$fields['post_type'] = array(
			'label'     => esc_html__( 'Source', 'codexshaper-framework' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => $post_types,
			'default'   => $default_post_type,
			'condition' => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['query_args'] = array(
			'type' => Controls_Manager::TABS,

		);

		$tabs_wrapper    = $name . 'query_args';
		$include_wrapper = $name . 'query_include';
		$exclude_wrapper = $name . 'query_exclude';

		$fields['query_include'] = array(
			'type'         => Controls_Manager::TAB,
			'label'        => esc_html__( 'Include', 'codexshaper-framework' ),
			'tabs_wrapper' => $tabs_wrapper,
			'condition'    => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['include'] = array(
			'label'        => esc_html__( 'Include By', 'codexshaper-framework' ),
			'type'         => Controls_Manager::SELECT2,
			'multiple'     => true,
			'options'      => array(
				'terms'   => esc_html__( 'Term', 'codexshaper-framework' ),
				'authors' => esc_html__( 'Author', 'codexshaper-framework' ),
			),
			'label_block'  => true,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $include_wrapper,
			'condition'    => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['include_term_ids'] = array(
			'label'        => esc_html__( 'Term', 'codexshaper-framework' ),
			'description'  => esc_html__( 'Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'codexshaper-framework' ),
			'type'         => Controls_Manager::TEXT,
			'label_block'  => true,
			'group_prefix' => $name,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $include_wrapper,
			'condition'    => array(
				'query_type' => 'custom',
				'include'    => 'terms',
			),
		);

		$fields['related_taxonomies'] = array(
			'label'        => esc_html__( 'Term', 'codexshaper-framework' ),
			'type'         => Controls_Manager::SELECT2,
			'options'      => $related_terms ?? array(),
			'label_block'  => true,
			'multiple'     => true,
			'condition'    => array(
				'include'    => 'terms',
				'query_type' => array(
					'related',
				),
			),
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $include_wrapper,
		);

		$fields['include_authors'] = array(
			'label'        => esc_html__( 'Author', 'codexshaper-framework' ),
			'type'         => Controls_Manager::TEXT,
			'label_block'  => true,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $include_wrapper,
			'export'       => false,
			'condition'    => array(
				'query_type' => 'custom',
				'include'    => 'authors',
			),
		);

		$fields['query_exclude'] = array(
			'type'         => Controls_Manager::TAB,
			'label'        => esc_html__( 'Exclude', 'codexshaper-framework' ),
			'tabs_wrapper' => $tabs_wrapper,
			'condition'    => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['exclude'] = array(
			'label'        => esc_html__( 'Exclude By', 'codexshaper-framework' ),
			'type'         => Controls_Manager::SELECT2,
			'multiple'     => true,
			'options'      => array(
				'current_post'     => esc_html__( 'Current Post', 'codexshaper-framework' ),
				'manual_selection' => esc_html__( 'Manual Selection', 'codexshaper-framework' ),
				'terms'            => esc_html__( 'Term', 'codexshaper-framework' ),
				'authors'          => esc_html__( 'Author', 'codexshaper-framework' ),
			),
			'label_block'  => true,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $exclude_wrapper,
			'condition'    => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['exclude_ids'] = array(
			'label'        => esc_html__( 'Enter Post IDS', 'codexshaper-framework' ),
			'type'         => Controls_Manager::TEXT,
			'label_block'  => true,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $exclude_wrapper,
			'export'       => false,
			'condition'    => array(
				'query_type!' => 'current_query',
				'exclude'     => 'manual_selection',
			),
		);

		$fields['exclude_term_ids'] = array(
			'label'        => esc_html__( 'Term', 'codexshaper-framework' ),
			'type'         => Controls_Manager::TEXT,
			'label_block'  => true,
			'group_prefix' => $name,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $exclude_wrapper,
			'export'       => false,
			'condition'    => array(
				'query_type!' => 'current_query',
				'exclude'     => 'terms',
			),
		);

		$fields['exclude_authors'] = array(
			'label'        => esc_html__( 'Author', 'codexshaper-framework' ),
			'type'         => Controls_Manager::TEXT,
			'label_block'  => true,
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $exclude_wrapper,
			'export'       => false,
			'condition'    => array(
				'query_type' => 'custom',
				'exclude'    => 'authors',
			),
		);

		$fields['offset'] = array(
			'label'        => esc_html__( 'Offset', 'codexshaper-framework' ),
			'type'         => Controls_Manager::NUMBER,
			'default'      => 0,
			'description'  => esc_html__( 'Use this setting to skip over posts (e.g. \'2\' to skip over 2 posts).', 'codexshaper-framework' ),
			'tabs_wrapper' => $tabs_wrapper,
			'inner_tab'    => $exclude_wrapper,
			'condition'    => array(
				'query_type' => 'custom',
			),
		);

		$fields['related_fallback'] = array(
			'label'       => esc_html__( 'Fallback', 'codexshaper-framework' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => array(
				'fallback_none'   => esc_html__( 'None', 'codexshaper-framework' ),
				'fallback_by_id'  => esc_html__( 'Manual Selection', 'codexshaper-framework' ),
				'fallback_recent' => esc_html__( 'Recent Posts', 'codexshaper-framework' ),
			),
			'default'     => 'fallback_none',
			'description' => esc_html__( 'Displayed if no relevant results are found. Manual selection display order is random', 'codexshaper-framework' ),
			'separator'   => 'before',
			'condition'   => array(
				'query_type' => 'related',
			),
		);

		$fields['fallback_ids'] = array(
			'label'       => esc_html__( 'Search & Select', 'codexshaper-framework' ),
			'options'     => array(),
			'label_block' => true,
			'export'      => false,
			'condition'   => array(
				'query_type'       => 'related',
				'related_fallback' => 'fallback_by_id',
			),
		);

		$fields['allow_pagination'] = array(
			'label'        => esc_html__( 'Allow Pagination?', 'codexshaper-framework' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
			'condition'    => array(
				'query_type!' => 'current_query',
			),
			'description'  => esc_html__( 'Enable if you want to display pagination.', 'codexshaper-framework' ),
		);

		$fields['posts_per_page'] = array(
			'label'     => esc_html__( 'Posts Per Page', 'codexshaper-framework' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 3,
			'condition' => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['post_date'] = array(
			'label'     => esc_html__( 'Date', 'codexshaper-framework' ),
			'type'      => Controls_Manager::SELECT,
			'post_type' => '',
			'options'   => array(
				'anytime'  => esc_html__( 'All', 'codexshaper-framework' ),
				'-1 day'   => esc_html__( 'Past Day', 'codexshaper-framework' ),
				'-1 week'  => esc_html__( 'Past Week', 'codexshaper-framework' ),
				'-1 month' => esc_html__( 'Past Month', 'codexshaper-framework' ),
				'-3 month' => esc_html__( 'Past Quarter', 'codexshaper-framework' ),
				'-1 year'  => esc_html__( 'Past Year', 'codexshaper-framework' ),
				'custom'   => esc_html__( 'Custom', 'codexshaper-framework' ),
			),
			'default'   => 'anytime',
			'multiple'  => false,
			'separator' => 'before',
			'condition' => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['date_before'] = array(
			'label'       => esc_html__( 'Before', 'codexshaper-framework' ),
			'type'        => Controls_Manager::DATE_TIME,
			'post_type'   => '',
			'label_block' => false,
			'multiple'    => false,
			'placeholder' => esc_html__( 'Choose', 'codexshaper-framework' ),
			'condition'   => array(
				'query_type!' => 'current_query',
				'post_date'   => 'custom',
			),
			'description' => esc_html__( 'Setting a ‘Before’ date will show all the posts published until the chosen date (inclusive).', 'codexshaper-framework' ),
		);

		$fields['date_after'] = array(
			'label'       => esc_html__( 'After', 'codexshaper-framework' ),
			'type'        => Controls_Manager::DATE_TIME,
			'post_type'   => '',
			'label_block' => false,
			'multiple'    => false,
			'placeholder' => esc_html__( 'Choose', 'codexshaper-framework' ),
			'condition'   => array(
				'query_type!' => 'current_query',
				'post_date'   => 'custom',
			),
			'description' => esc_html__( 'Setting an ‘After’ date will show all the posts published since the chosen date (inclusive).', 'codexshaper-framework' ),
		);

		$fields['orderby'] = array(
			'label'     => esc_html__( 'Order By', 'codexshaper-framework' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'post_date',
			'options'   => array(
				'post_date'     => esc_html__( 'Date', 'codexshaper-framework' ),
				'post_title'    => esc_html__( 'Title', 'codexshaper-framework' ),
				'menu_order'    => esc_html__( 'Menu Order', 'codexshaper-framework' ),
				'modified'      => esc_html__( 'Last Modified', 'codexshaper-framework' ),
				'comment_count' => esc_html__( 'Comment Count', 'codexshaper-framework' ),
				'rand'          => esc_html__( 'Random', 'codexshaper-framework' ),
			),
			'condition' => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['order'] = array(
			'label'     => esc_html__( 'Order', 'codexshaper-framework' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'desc',
			'options'   => array(
				'asc'  => esc_html__( 'ASC', 'codexshaper-framework' ),
				'desc' => esc_html__( 'DESC', 'codexshaper-framework' ),
			),
			'condition' => array(
				'query_type!' => 'current_query',
			),
		);

		$fields['ignore_sticky_posts'] = array(
			'label'        => esc_html__( 'Ignore Sticky Posts', 'codexshaper-framework' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
			'condition'    => array(
				'query_type!' => 'current_query',
			),
			'description'  => esc_html__( 'Sticky-posts ordering is visible on frontend only', 'codexshaper-framework' ),
		);

		return $fields;
	}
}
