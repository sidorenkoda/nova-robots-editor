<?php

namespace Sidorenkoda\NovaRobotsEditor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Sidorenkoda\NovaRobotsEditor\Http\Middleware\Authorize;

class ToolServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-robots-editor');

		$this->app->booted(function () {
			$this->routes();
		});

		Nova::serving(function (ServingNova $event) {
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->mergeConfigFrom(__DIR__.'/../config/nova-robots-editor.php', 'nova-robots-editor');
	}

	/**
	 * Register the tool's routes.
	 *
	 * @return void
	 */
	protected function routes()
	{
		if ($this->app->routesAreCached()) {
			return;
		}

		Route::middleware(['nova', Authorize::class])
			->prefix('nova-vendor/nova-robots-editor')
			->group(__DIR__.'/../routes/api.php');
	}
}
