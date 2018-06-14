<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacState;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\Client\DeviceProxy;
use LauLamanApps\NestApi\NestClient;

/**
 * @method string getDeviceId()
 * @method string getWhereId()
 * @method string getStructureId()
 * @method string getName()
 * @method string getNameLong()
 * @method Scale getScale()
 * @method string getLocale()
 * @method string getSoftwareVersion()
 * @method bool isCanHeat()
 * @method bool isCanCool()
 * @method bool isHasFan()
 * @method Temperature getAmbientTemperature()
 * @method Temperature getTargetTemperature()
 * @method Temperature getTargetTemperatureHigh()
 * @method Temperature getTargetTemperatureLow()
 * @method Temperature getLockedTempMin()
 * @method Temperature getLockedTempMax()
 * @method bool isHasLeaf()
 * @method int getHumidity()
 * @method HvacMode getHvacMode()
 * @method HvacState getHvacState()
 * @method bool isUsingEmergencyHeat()
 * @method bool isLocked()
 * @method bool isOnline()
 * @method null|DateTimeImmutable getLastConnection()
 * @method bool isFanTimerActive()
 * @method DateTimeImmutable getFanTimerTimeout()
 * @method void setScale(Scale $scale)
 * @method void setTargetTemperature(Temperature $temperature)
 * @method void setTargetTemperatureHigh(Temperature $temperature)
 * @method void setTargetTemperatureLow(Temperature $temperature)
 * @method void setEcoTemperatureHigh(Temperature $temperature)
 * @method void setEcoTemperatureLow(Temperature $temperature)
 * @method void setHvacMode(HvacMode $mode)
 * @method void setLabel(string $label)
 * @method void setFanTimerDuration(int $duration)
 */
final class ThermostatProxy extends DeviceProxy
{
    protected function __load(NestClient $client, string $deviceId)
    {
        return $client->getThermostat($deviceId);
    }
}
