<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Command;

use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;

final class ThermostatCommand implements Command
{
    /**
     * @var array
     */
    private $commands;

    /**
     * @var string
     */
    private $thermostatId;

    public function __construct(string $id)
    {
        $this->thermostatId = $id;
        $this->commands = [];
    }

    public function setScale(Scale $scale): void
    {
        $this->commands['temperature_scale'] = strtoupper($scale->getValue());
    }

    public function setTargetTemperature(Temperature $temperature): void
    {
        if ($temperature->getScale()->isCelsius()) {
            $this->commands['target_temperature_c'] = $temperature->getDegrees();
        }
        if ($temperature->getScale()->isFahrenheit()) {
            $this->commands['target_temperature_f'] = $temperature->getDegrees();
        }
    }

    public function setTargetTemperatureHigh(Temperature $temperature): void
    {
        if ($temperature->getScale()->isCelsius()) {
            $this->commands['target_temperature_high_c'] = $temperature->getDegrees();
        }
        if ($temperature->getScale()->isFahrenheit()) {
            $this->commands['target_temperature_high_f'] = $temperature->getDegrees();
        }
    }

    public function setTargetTemperatureLow(Temperature $temperature): void
    {
        if ($temperature->getScale()->isCelsius()) {
            $this->commands['target_temperature_low_c'] = $temperature->getDegrees();
        }
        if ($temperature->getScale()->isFahrenheit()) {
            $this->commands['target_temperature_low_f'] = $temperature->getDegrees();
        }
    }

    public function setEcoTemperatureHigh(Temperature $temperature): void
    {
        if ($temperature->getScale()->isCelsius()) {
            $this->commands['eco_temperature_high_c'] = $temperature->getDegrees();
        }
        if ($temperature->getScale()->isFahrenheit()) {
            $this->commands['eco_temperature_high_f'] = $temperature->getDegrees();
        }
    }

    public function setEcoTemperatureLow(Temperature $temperature): void
    {
        if ($temperature->getScale()->isCelsius()) {
            $this->commands['eco_temperature_low_c'] = $temperature->getDegrees();
        }
        if ($temperature->getScale()->isFahrenheit()) {
            $this->commands['eco_temperature_low_f'] = $temperature->getDegrees();
        }
    }

    public function setHvacMode(HvacMode $mode): void
    {
        $this->commands['hvac_mode'] = $mode->getValue();
    }

    public function setLabel(string $label): void
    {
        $this->commands['label'] = $label;
    }

    public function setFanTimerDuration(int $duration): void
    {
        $this->commands['fan_timer_duration'] = $duration;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function getDeviceId(): string
    {
        return $this->thermostatId;
    }
}
