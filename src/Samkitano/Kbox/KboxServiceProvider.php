<?php namespace Samkitano\Kbox;

use Illuminate\Support\ServiceProvider;

class KboxServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('samkitano/kbox');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['kbox'] = $this->app->share(function($app)
			{
				return new Kbox;
			}
		);

		$this->app->booting(function()
			{
				$loader = \Illuminate\Foundation\AliasLoader::getInstance();
				$loader->alias('Kbox', 'Samkitano\Kbox\Facades\Kbox');
			}
		);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('kbox');
	}

}
