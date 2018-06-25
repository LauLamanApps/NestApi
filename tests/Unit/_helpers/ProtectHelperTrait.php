<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\Client\Device\Protect\AlarmState;
use LauLamanApps\NestApi\Client\Device\Protect\BatteryHealth;
use LauLamanApps\NestApi\Client\Device\Protect\UiColorState;

trait ProtectHelperTrait
{
    protected function getProtectObject(?string $name = ''): Protect
    {
        return new Protect(
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
