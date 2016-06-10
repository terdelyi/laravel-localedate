<?php

namespace Terdelyi\LocaleDate;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;

class Date
{
    /**
     * Loaded locales
     * @var array
     */
    protected $locales = [];

    /**
     * Contructor
     * @param Application $app [description]
     */
    public function __construct(Application $app)
    {
        $this->carbon = new Carbon;
        $this->app = $app;
    }

    /**
     * Load locales
     * @param  [type] $locales [description]
     * @return [type]          [description]
     */
    public function loadLocales($locales)
    {
        $this->locales = $locales;
    }

    /**
     * Get locale by key
     * @param  [type] $locale [description]
     * @return [type]         [description]
     */
    public function getLocale($locale)
    {
        return isset($this->locales[$locale]) ? $this->locales[$locale] : null;
    }

    /**
     * Get loaded locales
     * @return [type] [description]
     */
    public function getLocales()
    {
        return !empty($this->locales) ? $this->locales : [];
    }

    /**
     * Set Carbon localization
     * @param [type] $locale [description]
     */
    public function setCarbon($locale)
    {
        $this->carbon->setLocale($locale);
    }

    /**
     * Set locale method in PHP
     * @param [type] $locale [description]
     */
    public function setLocale($locale)
    {
        setlocale(LC_TIME, $this->getLocale($locale));
    }
}