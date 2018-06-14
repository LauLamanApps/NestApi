<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Factory;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\Client\Device\Protect\AlarmState;
use LauLamanApps\NestApi\Client\Device\Protect\BatteryHealth;
use LauLamanApps\NestApi\Client\Device\Protect\UiColorState;
use LauLamanApps\NestApi\NestClient;

final class ProtectFactory extends AbstractFactory implements ProtectFactoryInterface
{
    public function fromData(array $data, NestClient $client): Protect
    {
        return new Protect(
            $this->extractString('device_id', $data),
            $this->extractString('where_id', $data),
            $this->extractString('structure_id', $data),
            $this->extractString('name', $data),
            $this->extractString('name_long', $data),
            $this->extractString('locale', $data),
            $this->extractString('software_version', $data),
            $this->extractBoolean('is_online', $data),
            new DateTimeImmutable($this->extractString('last_connection', $data)),
            BatteryHealth::get($this->extractString('battery_health', $data)),
            AlarmState::get($this->extractString('co_alarm_state', $data)),
            AlarmState::get($this->extractString('smoke_alarm_state', $data)),
            UiColorState::get($this->extractString('ui_color_state', $data)),
            $this->extractBoolean('is_manual_test_active', $data),
            new DateTimeImmutable($this->extractString('last_manual_test_time', $data))
        );
    }
}
