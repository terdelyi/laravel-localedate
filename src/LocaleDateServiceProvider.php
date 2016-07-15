<?php

namespace Terdelyi\LocaleDate;

use Illuminate\Support\ServiceProvider;

class LocaleDateServiceProvider extends ServiceProvider
{
    protected $locale;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->date = new Date($app);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish config file
        $this->publishes([
            __DIR__.'/config/locales.php' => config_path('locales.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // merge package configuration with the application
        $this->mergeConfigFrom(
            __DIR__.'/config/locales.php', 'locales'
        );

        // load locales
        $this->date->loadLocales($this->app->config->get('locales'));

        // catch 'local.changed' event
        $this->app->events->listen('locale.changed', function ($locale) {
            $this->date->setCarbon($locale);
            $this->date->setLocale($locale);
        });

        // set locale in PHP
        $this->date->setLocale($this->app->config->get('app.locale'));
        $this->date->setCarbon($this->app->config->get('app.locale'));
    }
}
