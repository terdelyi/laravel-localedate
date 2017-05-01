<?php

namespace Terdelyi\LocaleDate;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class LocaleDateServiceProvider extends ServiceProvider
{
    /**
     * Application instance.
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Date instance.
     * @var \Terdelyi\LocaleDate\Date
     */
    protected $date;

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * Initialize a new service provider.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->date = new Date($this->app, new Carbon);
    }

    /**
     * Boot the application services.
     */
    public function boot()
    {
        // Publish config file
        $this->publishes([__DIR__.'/config/locales.php' => config_path('locales.php')], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Merge package configuration with the application's configuration
        $this->mergeConfigFrom(
            __DIR__.'/config/locales.php', 'locales'
        );

        // Load locales
        $this->date->loadLocales($this->app->config->get('locales'));

        // Catch 'local.changed' event
        $this->app->events->listen('locale.changed', function ($locale) {
            $this->date->setCarbon($locale);
            $this->date->setLocale($locale);
        });

        // Set locale in PHP
        $this->date->setLocale($this->app->config->get('app.locale'));
        $this->date->setCarbon($this->app->config->get('app.locale'));
    }
}
