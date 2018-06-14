<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Factory;

use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\NestClient;

interface ThermostatFactoryInterface
{
    public function fromData(array $data, NestClient $client): Thermostat;
}
