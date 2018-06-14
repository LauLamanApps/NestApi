Nest Api
===============
This package provides a simple integration of the [Official Nest Api][nest-api-documentation] for your PHP project.

[![Build Status](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/LauLamanApps/nest-api/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/LauLamanApps/nest-api/v/stable)](https://packagist.org/packages/LauLamanApps/nest-api)
[![License](https://poser.pugx.org/LauLamanApps/nest-api/license)](https://packagist.org/packages/LauLamanApps/nest-api)

Installation
------------
With [composer](http://packagist.org), add:

```bash
$ composer require LauLamanApps/nest-api
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
$ make test-unit
$ make test-integration
```

Author
-------

Nest API has been developed by [LauLaman].

[nest-api-documentation]: https://developers.nest.com/documentation
[LauLaman]: https://github.com/LauLaman
