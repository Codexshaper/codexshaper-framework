<?php
/**
 * Admin menu
 *
 * @category   Admin
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Admin;

use CodexShaper\Framework\Foundation\Traits\Hook;

if ( ! defined( 'ABSPATH' ) ) {
	exit(); // Exit if access directly.
}

/**
 * Admin menu class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Menu {
	use Hook;

	/**
	 * Instance
	 *
	 * @var \CodexShaper\Framework\Admin\Menu
	 * @static
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Settings
	 *
	 * @var \CodexShaper\Framework\Admin\Serttings
	 * @static
	 * @since 1.0.0
	 */
	private $settings;

	/**
	 * Constructor
	 *
	 * Admin menu register.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		$this->add_action( 'admin_menu', 'add_menu_pages', 9 );
		$this->add_action( 'admin_menu', 'set_menu_order', 10 );
	}

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return \CodexShaper\Framework\Admin\Menu An instance of the class.
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Theme admin menu page
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_menu_pages() {
		// Check user capability.
		if ( ! current_user_can( 'edit_posts', get_current_user_id() ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_posts', get_current_user_id() ) ) {
			return;
		}

		// Add menu page.
		add_menu_page(
			esc_html__( 'CodexShaper Framework Page', 'codexshaper-framework' ),
			esc_html__( 'CodexShaper Framework', 'codexshaper-framework' ),
			'manage_options',
			'codexshaper-framework',
			array( $this, 'render' ),
			'dashicons-art',
			'10'
		);

		add_submenu_page(
			'codexshaper-framework',
			__( 'Dashboard', 'codexshaper-framework' ),
			__( 'Dashboard', 'codexshaper-framework' ),
			'manage_options',
			'codexshaper-framework-dashboard',
			array( $this, 'render_dashboard' )
		);
		add_submenu_page(
			'codexshaper-framework',
			__( 'Modules', 'codexshaper-framework' ),
			__( 'Modules', 'codexshaper-framework' ),
			'manage_options',
			'codexshaper-framework-modules',
			array( $this, 'render_core_modules' )
		);
	}

	public function add_admin_bar( $wp_admin_bar, $options ) {

		if ( ! current_user_can( $options['menu_capability'] ) ) {
			return;
		}

		if ( is_network_admin() && ( $options['database'] !== 'network' || $options['show_in_network'] !== true ) ) {
			return;
		}

		if ( ! empty( $options['show_bar_menu'] ) && empty( $options['menu_hidden'] ) ) {

			global $submenu;

			$menu_slug = $options['menu_slug'];
			$menu_icon = ( ! empty( $options['admin_bar_menu_icon'] ) ) ? '<span class="cxf--ab-icon ab-icon ' . esc_attr( $options['admin_bar_menu_icon'] ) . '"></span>' : '';

			$wp_admin_bar->add_node(
				array(
					'id'    => $menu_slug,
					'title' => $menu_icon . esc_attr( $options['menu_title'] ),
					'href'  => esc_url( ( is_network_admin() ) ? network_admin_url( 'admin.php?page=' . $menu_slug ) : admin_url( 'admin.php?page=' . $menu_slug ) ),
				)
			);

			if ( ! empty( $submenu[ $menu_slug ] ) ) {
				foreach ( $submenu[ $menu_slug ] as $menu_key => $menu_value ) {
					$wp_admin_bar->add_node(
						array(
							'parent' => $menu_slug,
							'id'     => $menu_slug . '-' . $menu_key,
							'title'  => $menu_value[0],
							'href'   => esc_url( ( is_network_admin() ) ? network_admin_url( 'admin.php?page=' . $menu_value[2] ) : admin_url( 'admin.php?page=' . $menu_value[2] ) ),
						)
					);
				}
			}
		}
	}

	/**
	 * Add menu pages.
	 *
	 * @param array $options Menu options.
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function add_menus( $options ) {

		$root_menu_slug = $options['menu_slug'] ?? '';
		$capability     = $options['menu_capability'] ?? 'manage_options';
		$callback       = $options['callback'] ?? '';
		$position       = $options['position'] ?? null;
		$menus          = $options['menus'] ?? array();

		foreach ( $menus as $menu ) {
			$menu_title      = $menu['menu_title'];
			$page_title      = $menu['page_title'] ?? $menu_title;
			$menu_slug       = $menu['slug'] ?? $root_menu_slug;
			$menu_capability = $menu['capability'] ?? $capability;
			$menu_type       = $menu['type'] ?? 'menu';
			$menu_callback   = $menu['callback'] ?? $callback;
			$menu_position   = $menu['position'] ?? $position;
			$parent_slug     = $menu['parent_slug'] ?? '';
			$icon_url        = $menu['icon_url'] ?? '';

			$this->add_menu(
				array(
					'type'        => $menu_type,
					'parent_slug' => $parent_slug,
					'page_title'  => $page_title,
					'menu_title'  => $menu_title,
					'capability'  => $menu_capability,
					'menu_slug'   => $menu_slug,
					'callback'    => $menu_callback,
					'icon_url'    => $icon_url,
					'position'    => $menu_position,
				)
			);
		}
	}

	/**
	 * Add menu.
	 *
	 * @param array $menu
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function add_menu( $menu ) {
		$menu_title      = $menu['menu_title'];
		$page_title      = $menu['page_title'] ?? $menu_title;
		$menu_slug       = $menu['menu_slug'];
		$menu_capability = $menu['capability'] ?? 'manage_options';
		$menu_type       = $menu['type'] ?? 'menu';
		$menu_callback   = $menu['callback'] ?? '';
		$menu_position   = $menu['position'] ?? null;

		if ( 'submenu' === $menu_type ) {
			$parent_slug = $menu['parent_slug'] ?? 'codexshaper-framework';
			add_submenu_page(
				$parent_slug,
				sprintf(
					/* translators: %s: page title */
					esc_html__( 'CXF %s', 'codexshaper-framework' ),
					$page_title
				),
				sprintf(
					/* translators: %s: menu title */
					esc_html__( 'CXF %s', 'codexshaper-framework' ),
					$menu_title
				),
				$menu_capability,
				$menu_slug,
				$menu_callback,
				$menu_position
			);

			return;
		}

		add_menu_page(
			sprintf(
				/* translators: %s: page title */
				esc_html__( 'CXF %s', 'codexshaper-framework' ),
				$page_title
			),
			sprintf(
				/* translators: %s: menu title */
				esc_html__( 'CXF %s', 'codexshaper-framework' ),
				$menu_title
			),
			$menu_capability,
			$menu_slug,
			$menu_callback,
			$menu_position
		);
	}

	/**
	 * Unset sub menu
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render() {
	?>
		<h2 class="cxf--page-title"><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php
	}

	/**
	 * Render Dashboard Content
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function render_dashboard() {
		?>
			<div class="cxf-admin-panel">
				<h2 class="cxf-page-title"><?php echo esc_html( get_admin_page_title() ); ?></h2>
				<!-- CXF Widget Counter Start -->
				<div class="cxf-admin-widget-area">
					<div class="cxf--grid cxf--gap-28">

						<div class="cxf--col-span-12 sm:cxf--col-span-6 lg:cxf--col-span-4 xxl:cxf--col-span-3">
							<div class="cxf-card cxf-widget-card">
								<h2 class="cxf-card-title">Modules</h2>
								<div class="cxf-card-counter">
									<div class="cxf-card-total">
										<h3>Total</h3>
										<p>17</p>
									</div>
									<div class="cxf-card-used">
										<h3>Used</h3>
										<p>17</p>
									</div>
								</div>
							</div>
						</div>

						<div class="cxf--col-span-12 sm:cxf--col-span-6 lg:cxf--col-span-4 xxl:cxf--col-span-3">
							<div class="cxf-card cxf-widget-card">
								<h2 class="cxf-card-title">Widgets</h2>
								<div class="cxf-card-counter">
									<div class="cxf-card-total">
										<h3>Total</h3>
										<p>17</p>
									</div>
									<div class="cxf-card-used">
										<h3>Used</h3>
										<p>17</p>
									</div>
								</div>
							</div>
						</div>

						<div class="cxf--col-span-12 sm:cxf--col-span-6 lg:cxf--col-span-4 xxl:cxf--col-span-3">
							<div class="cxf-card cxf-widget-card">
								<h2 class="cxf-card-title">Sections</h2>
								<div class="cxf-card-counter">
									<div class="cxf-card-total">
										<h3>Total</h3>
										<p>17</p>
									</div>
									<div class="cxf-card-used">
										<h3>Used</h3>
										<p>17</p>
									</div>
								</div>
							</div>
						</div>

						<div class="cxf--col-span-12 sm:cxf--col-span-6 lg:cxf--col-span-4 xxl:cxf--col-span-3">
							<div class="cxf-card cxf-widget-card">
								<h2 class="cxf-card-title">Upcoming</h2>
								<div class="cxf-card-counter">
									<div class="cxf-card-total">
										<h3>Total</h3>
										<p>1000+</p>
									</div>
									<div class="cxf-card-used">
										<h3>Used</h3>
										<p>0</p>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- CXF Widget Counter End -->

				<!-- Footer -->
				<div class="cxf-footer-bottom">
					<p class="cxf-copyright">Copyright © 2024. CodexShaper All Rights Reserved</p>
				</div>
			</div>
		<?php
	}

	/**
	 * Render Dashboard Content
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function render_post_types() {
		echo esc_attr__( 'Post Types', 'codexshaper-framework' );
	}

	/**
	 * Render Dashboard Content
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function render_metaboxes() {
		echo esc_attr__( 'Metaboxes', 'codexshaper-framework' );
	}

	/**
	 * Render Dashboard Content
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function render_taxonomies() {
		echo esc_attr__( 'Taxonomies', 'codexshaper-framework' );
	}

	/**
	 * Render Element Bucket Setting.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render_core_modules() {
		$modules          = array();
		$module_directory = CXF_PATH . 'widgets/elementor/modules/*/';
		?>
			<div class="cxf-admin-panel">
				<!-- Element Bucket Widget Counter Start -->
				<div class="cxf-admin-widget-area">
					<h3 class="cxf-page-title">Widget <?php echo esc_html( get_admin_page_title() ); ?></h3>
					<div class="cxf--grid cxf--gap-28">
						<?php
						foreach ( glob( $module_directory ) as $path ) {
							if ( is_dir( $path ) ) {
								$parts  = explode( '/', untrailingslashit( $path ) );
								$module = end( $parts );

								if ( ! in_array( $module, $modules, true ) ) {
									$module_name = ucwords( str_replace( '-', ' ', $module ) );
									?>
									<div class="cxf--col-span-12 sm:cxf--col-span-6 xl:cxf--col-span-4 xxl:cxf--col-span-3">
										<div class="cxf-card cxf-widget-card cxf-d-flex cxf-justify-between cxf-items-center">
											<h2 class="cxf-card-title text-left"><?php echo esc_html( $module_name ); ?></h2>
											<label class="cxf-module-activation-switch">
												<input type="checkbox" class="cxf-module-activation-input" checked disabled />
												<span class="active-label" data-on="On" data-off="Off"></span>
												<span class="activation-handler"></span>
											</label>
										</div>

									</div>
									<?php
								}
							}
						}
						?>
					
				</div>
				<!-- Element Bucket Widget Counter End -->

				<!-- Footer -->
				<div class="cxf-footer-bottom">
					<p class="cxf-copyright">Copyright © 2024. CodexShaper All Rights Reserved</p>
				</div>
			</div>
		<?php
	}

	/**
	 * Unset sub menu
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_menu_order() {
		global $submenu;
		if ( isset( $submenu['codexshaper-framework'] ) ) {
			$menus = $submenu['codexshaper-framework'];
			unset( $menus[0] );
			$submenu['codexshaper-framework'] = $menus;
		}
	}
}
