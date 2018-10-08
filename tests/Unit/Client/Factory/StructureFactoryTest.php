<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Factory\StructureFactory;
use LauLamanApps\NestApi\Client\Structure\CameraProxy;
use LauLamanApps\NestApi\Client\Structure\SmokeCoAlarmProxy;
use LauLamanApps\NestApi\Client\Structure\ThermostatProxy;
use LauLamanApps\NestApi\NestClientInterface;
use LauLamanApps\NestApi\Tests\Unit\_helpers\CameraHelperTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\SmokeCoAlarmHelperTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\ThermostatHelperTrait;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

final class StructureFactoryTest extends TestCase
{
    use TestDataLoaderTrait;
    use CameraHelperTrait;
    use SmokeCoAlarmHelperTrait;
    use ThermostatHelperTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../files/UnitTests/Client/Factory/StructureFactoryTest/';

    /**
     * @var NestClientInterface|MockInterface
     */
    private $clientInterface;

    protected function setUp(): void
    {
        $this->clientInterface = \Mockery::mock(NestClientInterface::class);
    }

    /**
     * @test
     * @dataProvider getStructureData
     */
    public function fromData(array $data): void
    {
        $factory = new StructureFactory();
        $structure = $factory->fromData($data, $this->clientInterface);

        self::assertSame($data['structure_id'], $structure->getStructureId());
        self::assertSame($data['name'], $structure->getName());
        self::assertSame($data['country_code'], $structure->getCountryCode());
        self::assertSame($data['time_zone'], $structure->getTimeZone()->getName());
        self::assertSame($data['away'], $structure->getAway()->getValue());
        self::assertSame($data['rhr_enrollment'], $structure->isRhrEnrollment());



        if (isset($data['cameras'])) {
            self::assertCameras($data['cameras'], $structure->getCameras());
        }

        if (isset($data['smoke_co_alarms'])) {
            self::assertSmokeCoAlarms($data['smoke_co_alarms'], $structure->getSmokeCoAlarms());
        }

        if (isset($data['thermostats'])) {
            self::assertThermostats($data['thermostats'], $structure->getThermostats());
        }
    }

    /**
     * @param array $expectedCameras
     * @param Camera[]|CameraProxy[] $actualCameras
     */
    private function assertCameras(array $expectedCameras, array $actualCameras): void
    {
        $count = 0;
        foreach ($expectedCameras as $expectedCamera) {
            self::assertInstanceOf(CameraProxy::class, $actualCameras[$expectedCamera]);
            $this->clientInterface->shouldReceive('getCamera')->with($expectedCamera)->andReturn($this->getCameraObject());
            $actualCameras[$expectedCamera]->getDeviceId();
            $count++;
        }

        self::assertSame(count($expectedCameras), $count, 'looks like the amount of Camera objects does not match up');
    }

    /**
     * @param array $expectedSmokeCoAlarms
     * @param SmokeCoAlarm[]|SmokeCoAlarmProxy[] $actualSmokeCoAlarms
     */
    private function assertSmokeCoAlarms(array $expectedSmokeCoAlarms, array $actualSmokeCoAlarms): void
    {
        $count = 0;
        foreach ($expectedSmokeCoAlarms as $expectedSmokeCoAlarm) {
            self::assertInstanceOf(SmokeCoAlarmProxy::class, $actualSmokeCoAlarms[$expectedSmokeCoAlarm]);
            $this->clientInterface->shouldReceive('getSmokeCoAlarm')->with($expectedSmokeCoAlarm)->andReturn($this->getSmokeCoAlarmObject());
            $actualSmokeCoAlarms[$expectedSmokeCoAlarm]->getDeviceId();
            $count++;
        }

        self::assertSame(count($expectedSmokeCoAlarms), $count, 'looks like the amount of SmokeCoAlarm objects does not match up');
    }

    /**
     * @param array $expectedThermostats
     * @param Thermostat[]|ThermostatProxy[] $actualThermostats
     */
    private function assertThermostats(array $expectedThermostats, array $actualThermostats): void
    {
        $count = 0;
        foreach ($expectedThermostats as $expectedThermostat) {
            self::assertInstanceOf(ThermostatProxy::class, $actualThermostats[$expectedThermostat]);
            $this->clientInterface->shouldReceive('getThermostat')->with($expectedThermostat)->andReturn($this->getThermostatObject($this->clientInterface));
            $actualThermostats[$expectedThermostat]->getDeviceId();
            $count++;
        }

        self::assertSame(count($expectedThermostats), $count, 'looks like the amount of Thermostat objects does not match up');
    }

    public function getStructureData(): array
    {
        return [
            'only cameras' => [$this->getDataFromFile('only_cameras.json')],
            'only smoke co alarms' => [$this->getDataFromFile('only_smoke_co_alarms.json')],
            'only thermostats' => [$this->getDataFromFile('only_thermostats.json')],
            'all devices' => [$this->getDataFromFile('all_devices.json')],
        ];
    }
}
