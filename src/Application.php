<?php

namespace CodexShaper\Framework;

use CodexShaper\Framework\Container\Container;
use CodexShaper\Framework\Foundation\Traits\Hook;
use CodexShaper\Framework\Providers\FoundationServiceProvider;

class Application extends Container {

	use Hook;

	/**
	 * All of the registered service providers.
	 *
	 * @var array<string, \Illuminate\Support\ServiceProvider>
	 */
	protected $serviceProviders = array();

	/**
	 * The names of the loaded service providers.
	 *
	 * @var array
	 */
	protected $loadedProviders = array();

	/**
	 * Indicates if the application has "booted".
	 *
	 * @var bool
	 */
	protected $booted = false;

	/**
	 * Create a new CodexShaper\Framework application instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->register_bindings();
		$this->register_service_providers();
		$this->register_container_aliases();
	}

	/**
	 * Register the basic bindings into the container.
	 *
	 * @return void
	 */
	protected function register_bindings() {
		$this->instance( 'app', $this );
		$this->instance( Container::class, $this );
		// $this->alias(FoundationServiceProvider::class, 'fsp');
		$this->setParameter( 'fsp', FoundationServiceProvider::class );
	}

	/**
	 * Register all of the base service providers.
	 *
	 * @return void
	 */
	protected function register_service_providers() {
		$this->register( new FoundationServiceProvider( $this ) );
	}

	/**
	 * Register a service provider with the application.
	 *
	 * @param  \CodexShaper\Framework\Foundation\ServiceProvider|string $provider
	 * @param  bool                                                     $force
	 * @return \CodexShaper\Framework\Foundation\ServiceProvider
	 */
	public function register( $provider, $force = false ) {
		if ( ( $registered = $this->get_provider( $provider ) ) && ! $force ) {
			return $registered;
		}

		// If the given "provider" is a string, we will resolve it, passing in the
		// application instance automatically for the developer. This is simply
		// a more convenient way of specifying your service provider classes.
		if ( is_string( $provider ) ) {
			$provider = $this->resolve_provider( $provider );
		}

		$provider->register();

		// If there are bindings / singletons set as properties on the provider we
		// will spin through them and register them with the application, which
		// serves as a convenience layer while registering a lot of bindings.
		if ( property_exists( $provider, 'bindings' ) ) {
			foreach ( $provider->bindings as $key => $value ) {
				$this->bind( $key, $value );
			}
		}

		if ( property_exists( $provider, 'singletons' ) ) {
			foreach ( $provider->singletons as $key => $value ) {
				$key = is_int( $key ) ? $value : $key;

				$this->singleton( $key, $value );
			}
		}

		if ( property_exists( $provider, 'providers' ) ) {
			foreach ( $provider->providers as $key => $provider_class ) {
				if ( is_string( $provider_class ) ) {
					$provider->instances[] = $this->register( $provider_class );
				}

				if ( is_array( $provider_class ) ) {
					$self           = $this;
					$hook_providers = $provider_class;
					$this->add_action(
						$key,
						function () use( $provider, $self, $hook_providers ) {
							foreach ( $hook_providers as $hook_provider ) {
								$provider->instances[] = $self->register( $hook_provider );
							}
						},
						100
					);
				}
			}
		}

		$provider->boot();

		return $provider;
	}

	/**
	 * Get the registered service provider instance if it exists.
	 *
	 * @param  \CodexShaper\Framework\Support\ServiceProvider|string $provider
	 * @return \CodexShaper\Framework\Support\ServiceProvider|null
	 */
	public function get_provider( $provider ) {
		$name = is_string( $provider ) ? $provider : get_class( $provider );

		return $this->serviceProviders[ $name ] ?? null;
	}

	/**
	 * Resolve a service provider instance from the class name.
	 *
	 * @param  string $provider
	 * @return \CodexShaper\Framework\Support\ServiceProvider
	 */
	public function resolve_provider( $provider ) {
		return new $provider( $this );
	}

	/**
	 * Register the core class aliases in the container.
	 *
	 * @return void
	 */
	public function register_container_aliases() {
		$core_aliases = array(
			'app' => array(
				self::class,
				Container::class,
			),
		);
		foreach ( $core_aliases as $alias => $aliases ) {
			foreach ( $aliases as $abstract ) {
				$this->alias( $abstract, $alias );
			}
		}
	}
}
