<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Http\Command;

use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\Http\Command\ThermostatCommand;
use PHPUnit\Framework\TestCase;

final class ThermostatCommandTest extends TestCase
{
    private const THERMOSTAT_ID = '543kjhg56s457a8';
    private const CELSIUS = 'C';
    private const FAHRENHEIT = 'F';


    /**
     * @test
     *
     * @dataProvider getTemperatureScales
     */
    public function setScale(Scale $scale, string $unit): void
    {
        $command = $this->ThermostatCommand();
        $command->setScale($scale);

        self::assertSame(['temperature_scale' => $unit], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperature_Celsius(): void
    {
        $degrees = 20.5;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperature(Temperature::celsius($degrees));

        self::assertSame(['target_temperature_c' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperatureHigh_Celsius(): void
    {
        $degrees = 20.5;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperatureHigh(Temperature::celsius($degrees));

        self::assertSame(['target_temperature_high_c' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperatureLow_Celsius(): void
    {
        $degrees = 20.5;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperatureLow(Temperature::celsius($degrees));

        self::assertSame(['target_temperature_low_c' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setEcoTemperatureHigh_Celsius(): void
    {
        $degrees = 20.5;

        $command = $this->ThermostatCommand();
        $command->setEcoTemperatureHigh(Temperature::celsius($degrees));

        self::assertSame(['eco_temperature_high_c' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setEcoTemperatureLow_Celsius(): void
    {
        $degrees = 20.5;

        $command = $this->ThermostatCommand();
        $command->setEcoTemperatureLow(Temperature::celsius($degrees));

        self::assertSame(['eco_temperature_low_c' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperature_Fahrenheit(): void
    {
        $degrees = 75;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperature(Temperature::fahrenheit($degrees));

        self::assertSame(['target_temperature_f' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperatureHigh_Fahrenheit(): void
    {
        $degrees = 75;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperatureHigh(Temperature::fahrenheit($degrees));

        self::assertSame(['target_temperature_high_f' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setTargetTemperatureLow_Fahrenheit(): void
    {
        $degrees = 75;

        $command = $this->ThermostatCommand();
        $command->setTargetTemperatureLow(Temperature::fahrenheit($degrees));

        self::assertSame(['target_temperature_low_f' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setEcoTemperatureHigh_Fahrenheit(): void
    {
        $degrees = 75;

        $command = $this->ThermostatCommand();
        $command->setEcoTemperatureHigh(Temperature::fahrenheit($degrees));

        self::assertSame(['eco_temperature_high_f' => $degrees], $command->getCommands());
    }

    /**
     * @test
     */
    public function setEcoTemperatureLow_Fahrenheit(): void
    {
        $degrees = 75;

        $command = $this->ThermostatCommand();
        $command->setEcoTemperatureLow(Temperature::fahrenheit($degrees));

        self::assertSame(['eco_temperature_low_f' => $degrees], $command->getCommands());
    }

    /**
     * @test
     *
     * @dataProvider getHvacModes
     */
    public function setHvacMode(HvacMode $hvacMode): void
    {
        $command = $this->ThermostatCommand();
        $command->setHvacMode($hvacMode);

        self::assertSame(['hvac_mode' => $hvacMode->getValue()], $command->getCommands());
    }

    /**
     * @test
     */
    public function setLabel(): void
    {
        $label = 'new label';

        $command = $this->ThermostatCommand();
        $command->setLabel($label);

        self::assertSame(['label' => $label], $command->getCommands());
    }

    /**
     * @test
     */
    public function setFanTimerDuration(): void
    {
        $tanDuration = 349;

        $command = $this->ThermostatCommand();
        $command->setFanTimerDuration($tanDuration);

        self::assertSame(['fan_timer_duration' => $tanDuration], $command->getCommands());
    }

    /**
     * @test
     */
    public function getCommands(): void
    {
        $command = $this->ThermostatCommand();


        self::assertSame([], $command->getCommands());
    }

    /**
     * @test
     */
    public function getId(): void
    {
        $command = $this->ThermostatCommand();

        self::assertSame(self::THERMOSTAT_ID, $command->getDeviceId());
    }

    private function ThermostatCommand(): ThermostatCommand
    {
        return new ThermostatCommand(self::THERMOSTAT_ID);
    }

    public function getTemperatureScales(): array
    {
        return [
            self::CELSIUS => [Scale::celsius(), self::CELSIUS],
            self::FAHRENHEIT => [Scale::fahrenheit(), self::FAHRENHEIT],
        ];
    }

    /**
     * @return HvacMode[][]
     */
    public function getHvacModes(): array
    {
        $data = [];
        $modes = HvacMode::getValidOptions();
        foreach ($modes as $mode) {
            $data[$mode] = [HvacMode::get($mode)];
        }

        return $data;
    }
}
