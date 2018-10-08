<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\AlarmState;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\BatteryHealth;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\UiColorState;

trait SmokeCoAlarmHelperTrait
{
    protected function getSmokeCoAlarmObject(?string $name = ''): SmokeCoAlarm
    {
        return new SmokeCoAlarm(
            '',
            '',
            '',
            $name,
            '',
            '',
            '',
            true,
            new DateTimeImmutable(),
            BatteryHealth::ok(),
            AlarmState::ok(),
            AlarmState::ok(),
            UiColorState::green(),
            false,
            new DateTimeImmutable()
        );
    }
}
