<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Device\Thermostat;

use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use PHPUnit\Framework\TestCase;

final class TemperatureTest extends TestCase
{

    /**
     * @test
     * @dataProvider getCelsius
     */
    public function celsius($degrees, float $expected): void
    {
        $temperature =  Temperature::celsius($degrees);

        self::assertTrue($temperature->getScale()->isCelsius());
        self::assertSame($expected, $temperature->getDegrees());
    }

    /**
     * @test
     * @dataProvider getFahrenheit
     */
    public function fahrenheit($degrees): void
    {
        $temperature =  Temperature::fahrenheit($degrees);

        self::assertTrue($temperature->getScale()->isFahrenheit());
        self::assertSame($degrees, $temperature->getDegrees());
    }

    /**
     * @test
     * @dataProvider getStringProvider
     */
    public function _toString(string $string, Temperature $temperature): void
    {
        self::assertSame($string, $temperature->__toString());
    }

    /**
     * @test
     * @dataProvider getScaleProvider
     */
    public function getScale(string $scale, Temperature $temperature): void
    {
        self::assertSame($scale, $temperature->getScale()->getValue());
    }

    public function getCelsius(): array
    {
        return [
            '20' => [20, 20.0],
            '20.0' => [20.0, 20.0],
            '20.1' => [20.1, 20.0],
            '20.2' => [20.2, 20.0],
            '20.3' => [20.3, 20.5],
            '20.4' => [20.4, 20.5],
            '20.5' => [20.5, 20.5],
            '20.6' => [20.6, 20.5],
            '20.7' => [20.7, 20.5],
            '20.8' => [20.8, 21.0],
            '20.9' => [20.9, 21.0],
        ];
    }

    public function getFahrenheit(): array
    {
        return [
            '20' => [20],
            '21' => [21],
            '22' => [22],
            '23' => [23],
            '24' => [24],
            '25' => [25],
            '26' => [26],
        ];
    }

    public function getStringProvider(): array
    {
        return [
            '20°C' => ['20.0°C', Temperature::celsius(20)],
            '20.0°C' => ['20.0°C', Temperature::celsius(20.0)],
            '20.1°C' => ['20.0°C', Temperature::celsius(20.1)],
            '20.2°C' => ['20.0°C', Temperature::celsius(20.2)],
            '20.3°C' => ['20.5°C', Temperature::celsius(20.3)],
            '20.4°C' => ['20.5°C', Temperature::celsius(20.4)],
            '20.5°C' => ['20.5°C', Temperature::celsius(20.5)],
            '20.6°C' => ['20.5°C', Temperature::celsius(20.6)],
            '20.7°C' => ['20.5°C', Temperature::celsius(20.7)],
            '20.8°C' => ['21.0°C', Temperature::celsius(20.8)],
            '20.9°C' => ['21.0°C', Temperature::celsius(20.9)],
            '20°F' => ['20°F', Temperature::fahrenheit(20)],
            '21°F' => ['21°F', Temperature::fahrenheit(21)],
            '22°F' => ['22°F', Temperature::fahrenheit(22)],
            '23°F' => ['23°F', Temperature::fahrenheit(23)],
            '24°F' => ['24°F', Temperature::fahrenheit(24)],
            '25°F' => ['25°F', Temperature::fahrenheit(25)],
            '26°F' => ['26°F', Temperature::fahrenheit(26)],
        ];
    }

    public function getScaleProvider()
    {
        return [
            'celsius' => ['c', Temperature::celsius(20)],
            'fahrenheit' => ['f', Temperature::fahrenheit(20)],
        ];
    }
}
