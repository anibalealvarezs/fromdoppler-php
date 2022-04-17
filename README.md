# FromDoppler-PHP
[![Github tag](https://badgen.net/github/tag/anibalealvarezs/fromdoppler-php)](https://github.com/anibalealvarezs/fromdoppler-php/tags/) [![GitHub license](https://img.shields.io/github/license/anibalealvarezs/fromdoppler-php.svg)](https://github.com/anibalealvarezs/fromdoppler-php/blob/master/LICENSE) [![Github all releases](https://img.shields.io/github/downloads/anibalealvarezs/fromdoppler-php/total.svg)](https://github.com/anibalealvarezs/fromdoppler-php/releases/) [![GitHub latest commit](https://badgen.net/github/last-commit/anibalealvarezs/fromdoppler-php)](https://GitHub.com/anibalealvarezs/fromdoppler-php/commit/) [![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://github.com/anibalealvarezs/anibalealvarezs)

## About

PHP library to connect to the [FromDopple API](https://restapi.fromdoppler.com/docs/gettingstarted?utm_source=www.google.com#authentication).

***

## Requirements

  * PHP >= 8.0
  * Composer

***

## Installation

Add the following to `composer.json`
```json
{
  "require": {
    "anibalealvarezs/fromdoppler-php": "*"
  },
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/anibalealvarezs/fromdoppler-php"
    }
  ]
}
```

Install all composer dependencies using:
```shell
composer install
```

Or install it via GitHub
```shell
composer require anibalealvarezs/fromdoppler-php
```

## Quick Start

### Note that this SDK requires PHP 8.0 or above.

```php
require_once('/path/to/FromDopplerPHP/vendor/autoload.php');

$doppler = new FromDopplerPHP\ApiClient();

$doppler->setConfig([
  'apiKey' => 'YOUR_API_KEY',
  'account' => 'YOUR_ACCOUNT', // email@email.com
]);

$response = $doppler->lists->getAllLists();
print_r($response);
```

## Authentication Method

The client library must be configured to use **Bearer Token**.

## Other configuration options
The APIClient class lets you set various configuration options like timeouts, host, user agent, and debug output.