<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacState;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\NestClientInterface;

trait ThermostatHelperTrait
{
    protected function getThermostatObject(NestClientInterface $client, ?string $name = ''): Thermostat
    {
        return new Thermostat(
                $client,
                '',
                '',
                '',
                $name,
                '',
                Scale::celsius(),
                '',
                '',
                true,
                true,
                true,
                Temperature::celsius(20.5),
                Temperature::celsius(20.5),
                Temperature::celsius(20.5),
                Temperature::celsius(20.5),
                Temperature::celsius(20.5),
                Temperature::celsius(20.5),
                false,
                40,
                HvacMode::off(),
                HvacState::off(),
                false,
                false,
                false,
                null,
                false,
                new DateTimeImmutable()
            );
    }
}
