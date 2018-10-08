Nest Api
===============
This package provides a simple integration of the [Official Nest Api][nest-api-documentation] for your PHP project.

[![Build Status](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/badges/build.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/NestApi/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/LauLamanApps/nest-api/v/stable)](https://packagist.org/packages/LauLamanApps/nest-api)
[![License](https://poser.pugx.org/LauLamanApps/nest-api/license)](https://packagist.org/packages/LauLamanApps/nest-api)

Installation
------------
With [composer](http://packagist.org), add:

```bash
$ composer require laulamanapps/nest-api
```

if you want to make use of the provided Guzzle adapter, require guzzlehttp in your composer:

```bash
$ composer require guzzlehttp/guzzle
```

Get Access Token
-----
Sign up at Nest as a Developer and get yourself an `ClientID` and `ClientSecret`

Run the `get-oauth-token` in the terminal and follow the instructions

```bash
$ ./bin/get-oauth-token
```

Usage
-----

```php
use LauLamanApps\NestApi\NestClientFactory;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;

$client = NestClientFactory::create('<AccessToken>');

$thermostat = $client->getThermostat('<DeviceId>');

// Get current Temperature
echo 'The current temperature is:';
echo $thermostat->getAmbientTemperature();

// Set Target Temperature
$newTemperature = Temperature::celsius(21.5);
$thermostat->setTargetTemperature($newTemperature);

```

Tests
-----

This package comes with 2 types of tests: Unit and Integration.
To run them you can use the make commands in the projects root.

```bash
$ make tests # Runs all tests
$ make tests-unit # Runs only unit tests
$ make tests-integration # Runs only integration tests
```

Author
-------

Nest API has been developed by [LauLaman].

[nest-api-documentation]: https://developers.nest.com/documentation
[LauLaman]: https://github.com/LauLaman
