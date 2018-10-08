<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\Http\Command\Command;

interface NestClientInterface
{
    /**
     * @return Thermostat[]
     */
    public function getThermostats(): array;

    public function getThermostat(string $id): Thermostat;

    /**
     * @return SmokeCoAlarm[]
     */
    public function getSmokeCoAlarms(): array;

    public function getSmokeCoAlarm(string $id): SmokeCoAlarm;

    /**
     * @return Camera[]
     */
    public function getCameras(): array;

    public function getCamera(string $id): Camera;

    /**
     * @return Structure[]
     */
    public function getStructures(): array;

    public function sendCommand(Command $command): void;
}
