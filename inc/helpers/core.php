<?php

/**
 * Helper functions
 *
 * @category   Core
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

if ( ! function_exists( 'cxf_config' ) ) {

	/**
	 * Get core helper function
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_config( $name ) {
		if ( ! class_exists( '\CodexShaper\Framework\Support\Facades\Config' ) ) {
			return;
		}
		return CodexShaper\Framework\Support\Facades\Config::get( $name );
	}
}

if ( ! function_exists( 'cxf_get_option' ) ) {

	/**
	 * Get CodexShaper Option Builder option
	 *
	 * @param string $option Option name.
	 * @param mixed  $default_value Default value if option doesn't exists.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_get_option( $option = '', $default_value = null ) {
		$options = get_option( 'cxf_theme_options' );
		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default_value;
	}
}

if ( ! function_exists( 'cxf_get_page_by_title' ) ) {

	/**
	 * Get page by page title
	 *
	 * @param string $title Page title.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_get_page_by_title( $title ) {
		$query = new WP_Query(
			array(
				'post_type'              => 'page',
				'title'                  => esc_html( $title ),
				'post_status'            => 'all',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'ignore_sticky_posts'    => true,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'orderby'                => 'post_date ID',
				'order'                  => 'ASC',
			)
		);

		return $query->post ?? null;
	}
}

if ( ! function_exists( 'cxf_view_base' ) ) {

	/**
	 * Get view base
	 *
	 * @param array $base View name.
	 *
	 * @return string View base path.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_view_base( $view_base = '' ) {
		if ( ! $view_base || empty( $view_base ) ) {
			$view_base = CXF_PATH . 'views';
		}

		return $view_base;
	}
}

if ( ! function_exists( 'cxf_view_path' ) ) {

	/**
	 * Render View
	 *
	 * @param array  $view View name.
	 * @param string $base View base.
	 *
	 * @return string View path.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_view_path( $view, $base = '', $extension = 'view.php' ) {
		// Get the view base path.
		$view_base = cxf_view_base( $base );
		// Sanitize the view name.
		$path                = str_replace( array( '.', '|' ), DIRECTORY_SEPARATOR, $view );
		$fallback_base       = $base ?? CXF_PATH . 'views';
		$elementor_view_base = CXF_PATH . 'widgets/elementor/views';
		$wordpress_view_base = CXF_PATH . 'widgets/wordpress/views';

		// Check if the view file exists.
		if ( empty( $base ) ) {
			/**
			 * Filter view bases
			 *
			 * @param array $bases View bases.
			 */
			$bases = apply_filters(
				'cxf/view/bases',
				array(
					$elementor_view_base,
					$wordpress_view_base,
					$fallback_base,
				)
			);

			foreach ( $bases as $custom_base ) {

				$view_path = "{$custom_base}/{$path}.{$extension}";
				// Check if the view file exists. If exists, break the loop.
				if ( file_exists( $view_path ) ) {
					break;
				}
			}
		}

		if ( ! file_exists( $view_path ) ) {
			// Define the view path.
			$view_path = "{$view_base}/{$path}.{$extension}";
		}

		return $view_path;
	}
}

if ( ! function_exists( 'cxf_view_exists' ) ) {

	/**
	 * Check view exists
	 *
	 * @param array  $view View name.
	 * @param string $base View base.
	 *
	 * @return bool Is view exists?
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_view_exists( $view, $base = '' ) {

		$view_path = cxf_view_path( $view, $base );

		// Check if the view file exists
		if ( ! file_exists( $view_path ) ) {
			return false;
		}

		return true;
	}
}

if ( ! function_exists( 'cxf_view' ) ) {

	/**
	 * Render a View with Full Scope Isolation
	 *
	 * @param string $view View name.
	 * @param array  $data Variables to pass to the view.
	 * @param bool   $render Whether to return the rendered content instead of echoing it.
	 * @param string $base Base directory for the view files.
	 *
	 * @return string|void Rendered output or void if rendered directly.
	 */
	function cxf_view( $view, $data = array(), $render = false, $base = '' ) {
		static $data_stack = array(); // Keeps track of view data for nested calls.

		// Resolve the full path to the view file.
		$view_path = cxf_view_path( $view, $base );

		// Check if the view file exists.
		if ( ! file_exists( $view_path ) ) {
			throw new Exception(
				sprintf(
					/* translators: %s: View file path. */
					esc_html__( 'View file not found: %s', 'codexshaper-framework' ),
					esc_html( $view_path )
				)
			);
		}

		// Push the current view data onto the stack.
		array_push( $data_stack, $data );

		// Use a closure to isolate the view's scope.
		$output = ( function ( $view_path ) use ( &$data_stack ) {
			// Extract the latest data on the stack.
			extract( end( $data_stack ), EXTR_SKIP );

			// Start output buffering.
			ob_start();

			// Include the view file.
			include $view_path;

			// Return the buffered content.
			return ob_get_clean();
		} )( $view_path );

		// Pop the current view data off the stack after rendering.
		array_pop( $data_stack );

		// Return or echo the output based on the $render flag.
		if ( $render ) {
			return $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'cxf_view_render' ) ) {

	/**
	 * Render View
	 *
	 * @param string $view View name.
	 * @param array  $data View data.
	 * @param string $base View base.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_view_render( $view, $data = array(), $base = '' ) {
		return cxf_view( $view, $data, true, $base );
	}
}

if ( ! function_exists( 'cxf_get_string_attributes' ) ) {

	/**
	 * Get settings
	 *
	 * @param array $attributes Attributes.
	 *
	 * @return void
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_get_string_attributes( $attributes, $render = false ) {

		$attributes_html = implode( ' ', $attributes );

		if ( $render ) {
			return $attributes_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Intentional unescaped output.
		}

		echo $attributes_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Intentional unescaped output.
	}
}

if ( ! function_exists( 'cxf_settings' ) ) {

	/**
	 * Get settings
	 *
	 * @param string $option_name Option name.
	 * @param string $key Option key.
	 * @param mixed  $default Default value.
	 * @param string $sanitize_callback Sanitize callback.
	 *
	 * @return mixed Option value.
	 *
	 * @package CodexShaper_Framework
	 */
	function cxf_settings( $option_name, $key = null, $default = false, $sanitize_callback = '' ) {
		$settings = get_option( $option_name, array() );

		if ( $key !== null && ! empty( $key ) ) {
			$value = $settings[ $key ] ?? $default;
			return $sanitize_callback ? call_user_func( $sanitize_callback, $value ) : $value;
		}

		// If settings is an array, Sanitize the entire array if no specific key is requested.
		if ( is_array( $settings ) ) {
			foreach ( $settings as $setting_name => $setting ) {
				$settings[ $setting_name ] = $sanitize_callback ? call_user_func( $sanitize_callback, $setting ) : $setting;
			}
		}

		return $settings;
	}
}
