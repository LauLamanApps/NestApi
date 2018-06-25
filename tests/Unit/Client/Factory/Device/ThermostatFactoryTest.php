<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Factory\Device\ThermostatFactory;
use LauLamanApps\NestApi\NestClientInterface;
use LauLamanApps\NestApi\Tests\Unit\_helpers\AssertionTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

final class ThermostatFactoryTest extends TestCase
{
    use AssertionTrait;
    use TestDataLoaderTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../../files/UnitTests/Client/Factory/Device/ThermostatFactoryTest/';

    /**
     * @var NestClientInterface|MockInterface
     */
    private $clientInterface;

    protected function setUp()
    {
        $this->clientInterface = \Mockery::mock(NestClientInterface::class);
    }

    /**
     * @test
     * @dataProvider getThermostatData
     */
    public function fromData(array $data): void
    {
        $factory = new ThermostatFactory();
        $thermostat = $factory->fromData($data, $this->clientInterface);

        self::assertSame($data['device_id'], $thermostat->getDeviceId());
        self::assertSame($data['where_id'], $thermostat->getWhereId());
        self::assertSame($data['structure_id'], $thermostat->getStructureId());
        self::assertSame($data['name'], $thermostat->getName());
        self::assertSame($data['name_long'], $thermostat->getNameLong());
        self::assertSame($data['locale'], $thermostat->getLocale());
        self::assertSame($data['software_version'], $thermostat->getSoftwareVersion());
        self::assertSame($data['can_heat'], $thermostat->canHeat());
        self::assertSame($data['can_cool'], $thermostat->canCool());
        self::assertSame($data['has_fan'], $thermostat->hasFan());
        self::assertSame($data['has_leaf'], $thermostat->hasLeaf());
        self::assertSame($data['humidity'], $thermostat->getHumidity());
        self::assertSame($data['hvac_mode'], $thermostat->getHvacMode()->getValue());
        self::assertSame($data['hvac_state'], $thermostat->getHvacState()->getValue());
        self::assertSame($data['is_using_emergency_heat'], $thermostat->isUsingEmergencyHeat());
        self::assertSame($data['is_locked'], $thermostat->isLocked());
        self::assertSame($data['is_online'], $thermostat->isOnline());
        self::assertSame($data['fan_timer_active'], $thermostat->isFanTimerActive());
        self::assertSame($data['fan_timer_timeout'], $thermostat->getFanTimerTimeout()->format('Y-m-d\TH:i:s.000\Z'));
        self::assertDateTimeOrNull($data, 'last_connection', $thermostat->getLastConnection());

        if ($thermostat->getScale()->isCelsius()) {
            self::assertEquals($data['ambient_temperature_c'], $thermostat->getAmbientTemperature()->getDegrees());
            self::assertEquals($data['target_temperature_c'], $thermostat->getTargetTemperature()->getDegrees());
            self::assertEquals($data['target_temperature_high_c'], $thermostat->getTargetTemperatureHigh()->getDegrees());
            self::assertEquals($data['target_temperature_low_c'], $thermostat->getTargetTemperatureLow()->getDegrees());
            self::assertEquals($data['locked_temp_min_c'], $thermostat->getLockedTempMin()->getDegrees());
            self::assertEquals($data['locked_temp_max_c'], $thermostat->getLockedTempMax()->getDegrees());
        }

        if ($thermostat->getScale()->isFahrenheit()) {
            self::assertSame($data['ambient_temperature_f'], $thermostat->getAmbientTemperature()->getDegrees());
            self::assertSame($data['target_temperature_f'], $thermostat->getTargetTemperature()->getDegrees());
            self::assertSame($data['target_temperature_high_f'], $thermostat->getTargetTemperatureHigh()->getDegrees());
            self::assertSame($data['target_temperature_low_f'], $thermostat->getTargetTemperatureLow()->getDegrees());
            self::assertSame($data['locked_temp_min_f'], $thermostat->getLockedTempMin()->getDegrees());
            self::assertSame($data['locked_temp_max_f'], $thermostat->getLockedTempMax()->getDegrees());
        }
    }

    public function getThermostatData(): array
    {
        return [
            'celcius' => [$this->getDataFromFile('celcius.json')],
            'fahrenheit' => [$this->getDataFromFile('fahrenheit.json')],
        ];
    }
}
