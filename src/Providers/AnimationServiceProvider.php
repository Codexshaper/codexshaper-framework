<?php
/**
 *  Animation Service Provider File
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
use CodexShaper\Framework\Foundation\Traits\Hook;

/**
 *  Animation Service Provider Class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class AnimationServiceProvider extends ServiceProvider {

	use Hook;

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
	 * The scripts to be registered.
	 *
	 * @var array
	 */
	protected $scripts = array(
		'gsap'            => array(
			'path'    => 'libs',
			'name'    => 'gsap.min.js',
			'dep'     => array(),
			'version' => false,
			'arg'     => true,
		),
		'scroll-smoother' => array(
			'path'    => 'libs',
			'name'    => 'ScrollSmoother.min.js',
			'dep'     => array( 'gsap' ),
			'version' => false,
			'arg'     => true,
		),
		'scroll-to'       => array(
			'path'    => 'libs',
			'name'    => 'ScrollToPlugin.min.js',
			'dep'     => array( 'gsap' ),
			'version' => false,
			'arg'     => true,
		),
		'scroll-trigger'  => array(
			'path'    => 'libs',
			'name'    => 'ScrollTrigger.min.js',
			'dep'     => array( 'gsap' ),
			'version' => false,
			'arg'     => true,
		),
		'split-text'      => array(
			'path'    => 'libs',
			'name'    => 'SplitText.min.js',
			'dep'     => array( 'gsap' ),
			'version' => false,
			'arg'     => true,
		),
	);

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

		$cxf_animation = get_option( 'cxf_animation' );
		$gsap          = $cxf_animation['gsap'] ?? false;

		if ( ! $gsap ) {
			return;
		}

		$smooth_scroller        = $cxf_animation['smooth_scroller'] ?? false;
		$mobile_smooth_scroller = $cxf_animation['mobile_smooth_scroller'] ?? false;

		if ( ! $smooth_scroller && ! $mobile_smooth_scroller ) {
			unset( $this->scripts['scroll-smoother'] );
		}

		// Registere code.
		$this->providers = apply_filters( 'cxf_console_providers', $this->providers );

		// Register scripts.
		$this->add_action( 'wp_enqueue_scripts', 'register_scripts', 1 );

		// Add tags for smooth scroller.
		if ( $smooth_scroller || $mobile_smooth_scroller ) {
			$this->add_action( 'wp_body_open', 'add_smoother_opener_tag' );
			$this->add_action( 'wp_footer', 'add_smoother_closer_tag', 1 );
		}
	}

	/**
	 * Print scroll smoother opening tag.
	 *
	 * @return void.
	 */
	function register_scripts() {
		foreach ( $this->scripts as $handler => $script ) {
			$script_path = CXF_URL . 'assets/js/' . $script['path'] . '/' . $script['name'];
			wp_register_script(
				$handler,
				$script_path,
				$script['dep'],
				$script['version'],
				$script['arg']
			);

			wp_enqueue_script( $handler );
		}

		wp_enqueue_script( 'cxf-addons' );

		// Enqueue js files.
		wp_register_script(
			'cxf-gca',
			CXF_URL . 'assets/js/gca.js',
			array(),
			filemtime( CXF_PATH . 'assets/js/gca.js' ),
			true
		);

		wp_enqueue_script( 'cxf-gca' );
	}

	/**
	 * Print scroll smoother opening tag.
	 *
	 * @return void.
	 */
	public function add_smoother_opener_tag() {
		echo '<div id="smooth-wrapper"><div id="smooth-content">';
	}

	/**
	 * Print scroll smoother closing tag.
	 *
	 * @return void.
	 */
	public function add_smoother_closer_tag() {
		echo '</div></div>';
	}
}
