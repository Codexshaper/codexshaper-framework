<?php

namespace CodexShaper\Framework\Providers\Elementor;

use CodexShaper\Framework\Foundation\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider {

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
	 * @var Extension[]
	 */
	private $extensions = array();

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
		// Registere code.
		$extensions = array();

		$elementor_ext_directory = CXF_PATH . 'src/Extensions/Elementor/*';
		foreach ( glob( $elementor_ext_directory ) as $path ) {
			if ( is_file( $path ) ) {
				$post_type = basename( $path, '.php' );

				if ( ! in_array( $post_type, $extensions, true ) ) {
					$extensions[] = $post_type;
				}
			}
		}

		foreach ( $extensions as $extension_name ) {
			$words               = str_replace( '-', ' ', $extension_name );
			$extension_namespace = str_replace( ' ', '', ucwords( $words ) );
			$extension_class     = '\CodexShaper\Framework\Extensions\Elementor\\' . $extension_namespace;

			if ( $extension_class::is_active() ) {
				$this->extensions[ $extension_name ] = $extension_class::instance();
			}
		}
	}
}
