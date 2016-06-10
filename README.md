# Localdate for Laravel 5
Simple date localization for Laravel by the locale config value

## Install
```bash
composer require terdelyi/laravel-localedate
```

or add it to your `composer.json` file:

```json
"require": {
    "terdelyi/laravel-localedate": "dev-master"
}
```

After `composer update` add `Terdelyi\LocaleDate\LocaleDateServiceProvider::class` to the providers section in `config/app.php`.

## Using

Because different systems have different naming schemes for locales, date formatting uses a `locales.php` config file. You can easily publish it to your application to modify it:
```bash
php artisan vendor:publish --provider="Terdelyi\LocaleDate\LocaleDateServiceProvider"`
```

Set up the correct locale value in `config/app.php` and check that you have a valid reference to the key in `locales.php`. If everything goes well you get localized dates with `Carbon::now()->addYear()->diffForHumans()` and `Carbon::now()->formatLocalized()`.

You can also change locale with `App::setlocale()`, because package also watches the event what is fired with the method.