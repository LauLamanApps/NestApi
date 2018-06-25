<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\NestClientInterface;

interface ThermostatFactoryInterface
{
    public function fromData(array $data, NestClientInterface $client): Thermostat;
}
