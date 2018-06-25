<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Device;

use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\Http\Command\Command;
use LauLamanApps\NestApi\NestClientInterface;
use LauLamanApps\NestApi\Tests\Unit\_helpers\ThermostatHelperTrait;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

final class ThermostatTest extends TestCase
{
    use ThermostatHelperTrait;

    /**
     * @test
     */
    public function setLabel(): void
    {
        $label = 'Living Room Thermostat';

        $expectedData = [
            'label' => $label
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setLabel($label);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Celsius
     */
    public function setTargetTemperature_Celsius(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_c' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperature($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Fahrenheit
     */
    public function setTargetTemperature_Fahrenheit(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_f' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperature($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Celsius
     */
    public function setTargetTemperatureHigh_Celsius(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_high_c' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperatureHigh($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Fahrenheit
     */
    public function setTargetTemperatureHigh_Fahrenheit(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_high_f' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperatureHigh($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Celsius
     */
    public function setTargetTemperatureLow_Celsius(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_low_c' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperatureLow($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Fahrenheit
     */
    public function setTargetTemperatureLow_Fahrenheit(Temperature $temperature): void
    {
        $expectedData = [
            'target_temperature_low_f' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setTargetTemperatureLow($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Celsius
     */
    public function setEcoTemperatureLow_Celsius(Temperature $temperature): void
    {
        $expectedData = [
            'eco_temperature_low_c' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setEcoTemperatureLow($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Fahrenheit
     */
    public function setEcoTemperatureLow_Fahrenheit(Temperature $temperature): void
    {
        $expectedData = [
            'eco_temperature_low_f' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setEcoTemperatureLow($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Celsius
     */
    public function setEcoTemperatureHigh_Celsius(Temperature $temperature): void
    {
        $expectedData = [
            'eco_temperature_high_c' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setEcoTemperatureHigh($temperature);
    }

    /**
     * @test
     * @dataProvider getTemperatures_Fahrenheit
     */
    public function setEcoTemperatureHigh_Fahrenheit(Temperature $temperature): void
    {
        $expectedData = [
            'eco_temperature_high_f' => $temperature->getDegrees()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setEcoTemperatureHigh($temperature);
    }

    /**
     * @test
     * @dataProvider getScales
     */
    public function setScale(Scale $scale): void
    {
        $expectedData = [
            'temperature_scale' => strtoupper($scale->getValue())
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setScale($scale);
    }

    /**
     * @test
     * @dataProvider getHvacModes
     */
    public function setHvacMode(HvacMode $hvacMode): void
    {
        $expectedData = [
            'hvac_mode' => $hvacMode->getValue()
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setHvacMode($hvacMode);
    }

    /**
     * @test
     */
    public function setFanTimerDuration(): void
    {
        $duration = 10;

        $expectedData = [
            'fan_timer_duration' => $duration
        ];

        $nestClient = \Mockery::mock(NestClientInterface::class);

        $thermostat = $this->getThermostatObject($nestClient);

        self::assertCommand($nestClient, $expectedData, $thermostat);

        $thermostat->setFanTimerDuration($duration);
    }

    /**
     * @return Temperature[][]
     */
    public function getTemperatures_Celsius(): array
    {
        return [
            '20°C' => [Temperature::celsius(20)],
            '20.5°C' => [Temperature::celsius(20.5)],
        ];
    }

    /**
     * @return Temperature[][]
     */
    public function getTemperatures_Fahrenheit(): array
    {
        return [
            '75°F' => [Temperature::fahrenheit(75)],
            '90°F' => [Temperature::fahrenheit(90)],
        ];
    }

    /**
     * @return Scale[][]
     */
    public function getScales(): array
    {
        return [
            'celsius' => [Scale::celsius()],
            'fahrenheit' => [Scale::fahrenheit()],
        ];
    }

    /**
     * @return HvacMode[][]
     */
    public function getHvacModes(): array
    {
        return [
            'off' => [HvacMode::off()],
            'heat' => [HvacMode::heat()],
            'cool' => [HvacMode::cool()],
            'heat / cool' => [HvacMode::heatCool()],
            'eco' => [HvacMode::eco()],

        ];
    }

    private static function assertCommand(MockInterface $nestClient, array $expectedData, Thermostat $thermostat): void
    {
        $nestClient->shouldReceive('sendCommand')->with(\Mockery::on(
            function (Command $command) use ($expectedData, $thermostat) {
                self::assertEquals($thermostat->getDeviceId(), $command->getDeviceId());
                self::assertEquals($expectedData, $command->getCommands());

                return true;
            }
        ));
    }
}
