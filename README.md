# LocaleDate for Laravel 5.*

[![Build Status](https://travis-ci.org/terdelyi/laravel-localedate.svg?branch=master)](https://travis-ci.org/terdelyi/laravel-localedate)


> IMPORTANT! From Laravel 5.8 the framework is supporting Carbon 2 by default which has a [better and nicer solution](https://carbon.nesbot.com/docs/#api-localization) for localising dates therefor this package lost its purpose and is no longer supported.

### What's this?
Simple date localization for Laravel.

### Why?
As you probably know Laravel has a built-in support for translations. It's very good if you want to display text in different languages. But what about dates?

Laravel uses [Carbon](http://carbon.nesbot.com/) for dates, but when you change the `locale` setting in `config/app.php` it won't affect the textual representation of dates, like `diffForHumans` or `formatLocalized` methods in Carbon. With this package you can synchronize your locale setting with Carbon and [PHP's setlocale method](http://php.net/manual/en/function.setlocale.php).  

### Ok, I got it, now what?

Firstly you need to install the package with Composer:
```bash
composer require terdelyi/laravel-localedate
```

or add it to your `composer.json` file:

```json
"require": {
    "terdelyi/laravel-localedate": "1.*"
}
```

After `composer update` add `Terdelyi\LocaleDate\LocaleDateServiceProvider::class` to the providers array in `config/app.php`.

### Is there anything more what I should know?

Because different systems (MacOs, Windows, Linux) have different naming schemes for locales, date formatting uses a `locales.php` config file to override them. You can easily publish this config file into your application:
```bash
php artisan vendor:publish --provider="Terdelyi\LocaleDate\LocaleDateServiceProvider"
```

Now set up the correct locale value in `config/app.php` and check that you have a valid reference to the key in `locales.php`. If everything goes well you'll get localized dates with:

```php
Carbon::now()->diffForHumans(Carbon::now()->subYear()) // this gives back '1 year later'
```

And so:

```php
Carbon::createFromDate(2016,6,9)->formatLocalized('%A') // this gives back 'thursday'
```

### Change locale on runtime

If you want to change locale setting on runtime, you can use:

```php
App::setlocale()
```

Because the package is watching the event what is fired with this method and does what is necessary.
