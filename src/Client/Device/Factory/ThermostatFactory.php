<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Factory;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacState;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\NestClient;

final class ThermostatFactory extends AbstractFactory implements ThermostatFactoryInterface
{
    public function fromData(array $data, NestClient $client): Thermostat
    {
        $scale = Scale::get($this->extractString('temperature_scale', $data));

        return new Thermostat(
            $client,
            $this->extractString('device_id', $data),
            $this->extractString('where_id', $data),
            $this->extractString('structure_id', $data),
            $this->extractString('name', $data),
            $this->extractString('name_long', $data),
            $scale,
            $this->extractString('locale', $data),
            $this->extractString('software_version', $data),
            $this->extractBoolean('can_heat', $data),
            $this->extractBoolean('can_cool', $data),
            $this->extractBoolean('has_fan', $data),
            $this->extractTemperature('ambient_temperature', $scale, $data),
            $this->extractTemperature('target_temperature', $scale, $data),
            $this->extractTemperature('target_temperature_high', $scale, $data),
            $this->extractTemperature('target_temperature_low', $scale, $data),
            $this->extractTemperature('locked_temp_min', $scale, $data),
            $this->extractTemperature('locked_temp_max', $scale, $data),
            $this->extractBoolean('has_leaf', $data),
            $this->extractInteger('humidity', $data),
            HvacMode::get($this->extractString('hvac_mode', $data)),
            HvacState::get($this->extractString('hvac_state', $data)),
            $this->extractBoolean('is_using_emergency_heat', $data),
            $this->extractBoolean('is_locked', $data),
            $this->extractBoolean('is_online', $data),
            $this->extractDateTimeImmutableOrNull('last_connection', $data),
            $this->extractBoolean('fan_timer_active', $data),
            new DateTimeImmutable($this->extractString('fan_timer_timeout', $data))
        );
    }

    private function extractTemperature(string $key, Scale $scale, array $data)
    {
        $key = sprintf('%s_%s', $key, strtolower($scale->getValue()));

        return new Thermostat\Temperature($scale, $this->extractFloat($key, $data));
    }
}
