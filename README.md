# Localdate for Laravel 5
Simple date localization for Laravel by the locale config value

## Install
```bash
composer require terdelyi/laravel-localedate
```

or add it to your composer.json file:

```json
"require": {
    "terdelyi/laravel-localedate": "dev-master"
}
```

## Using
In `config/app.php` add `Terdelyi/Localedate/LocaledateServiceProdiver` to the provider section and modify the locale value in `locale` key and from then you get localized dates with Carbon.

You can also change locale with `App::setlocale()`, this package also watches the event what is fired with it.