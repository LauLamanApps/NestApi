<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\AlarmState;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\BatteryHealth;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\UiColorState;
use LauLamanApps\NestApi\Client\DeviceProxy;
use LauLamanApps\NestApi\NestClientInterface;

/**
 * @method string getDeviceId()
 * @method string getWhereId()
 * @method string getStructureId()
 * @method string getName()
 * @method string getNameLong()
 * @method string getLocale()
 * @method string getSoftwareVersion()
 * @method bool isOnline()
 * @method DateTimeImmutable getLastConnection()
 * @method BatteryHealth getBatteryHealth()
 * @method AlarmState getCoAlarmState()
 * @method AlarmState getSmokeAlarmState()
 * @method UiColorState getUiColorState()
 * @method bool isManualTestActive()
 * @method DateTimeImmutable getLastManualTest()
 */
final class SmokeCoAlarmProxy extends DeviceProxy
{
    protected function __load(NestClientInterface $client, string $deviceId)
    {
        return $client->getSmokeCoAlarm($deviceId);
    }
}
