# Faker PHP — ru_RU locale

Russian (`ru_RU`) locale for [Faker PHP](https://github.com/xefi/faker-php).

## Installation

```bash
composer require --dev xefi/faker-php-locales-ru-ru
```

The service provider is discovered automatically through Composer.

## Usage

```php
use Xefi\Faker\Faker;

$faker = new Faker('ru_RU');
```

Generators without a `ru_RU` variant fall back to the default locale.

## What's included

- Names in Cyrillic, with surnames in the masculine or feminine form matching the first name: `name()`, `firstName()`, `lastName(?string $gender)`, `title()`.
- Personal identifiers: `individualInn()` (ИНН, 12 digits, two check digits) and `snils()` (СНИЛС, `XXX-XXX-XXX YY`).
- Company identifiers: `companyInn()` (ИНН, 10 digits) and `ogrn()` (ОГРН, 13 digits).
- Addresses: `region()`, `regionCode()`, `city()`, 6-digit `postcode()`, `streetName()`, `streetAddress()` and `fullAddress()` in the Russian Post order (street, house, flat, city, region, postcode).
- Phone numbers with the `8` trunk prefix or the `+7` indicator.
- `iban()`: Russia does not use IBAN, so this returns an IBAN-shaped `RU` value built from a BIK and a 20-digit account number.
- Colours and text in Russian; `words()` lowercases Cyrillic correctly.

## Contributing

1. Fork the repository and create a branch from `main`.
2. Add an extension under `src/Extensions/` and register it in `FakerRuRuServiceProvider::boot()`.
3. Add a test under `tests/Unit/`.
4. Run the suite with `vendor/bin/phpunit` (or `docker compose run php vendor/bin/phpunit`).
5. Open a pull request against `main`.

## License

MIT
