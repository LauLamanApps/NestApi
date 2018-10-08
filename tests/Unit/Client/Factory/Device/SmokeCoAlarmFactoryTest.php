<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Factory\Device\SmokeCoAlarmFactory;
use LauLamanApps\NestApi\Client\Structure\SmokeCoAlarmProxy;
use LauLamanApps\NestApi\Tests\Unit\_helpers\AssertionTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use PHPUnit\Framework\TestCase;

final class SmokeCoAlarmFactoryTest extends TestCase
{
    use AssertionTrait;
    use TestDataLoaderTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../../files/UnitTests/Client/Factory/Device/SmokeCoAlarmFactoryTest/';

    /**
     * @test
     * @dataProvider getSmokeCoAlarmData
     */
    public function fromData(array $data): void
    {
        $factory = new SmokeCoAlarmFactory();
        $SmokeCoAlarm = $factory->fromData($data);

        self::assertSame($data['device_id'], $SmokeCoAlarm->getDeviceId());
        self::assertSame($data['where_id'], $SmokeCoAlarm->getWhereId());
        self::assertSame($data['structure_id'], $SmokeCoAlarm->getStructureId());
        self::assertSame($data['name'], $SmokeCoAlarm->getName());
        self::assertSame($data['name_long'], $SmokeCoAlarm->getNameLong());
        self::assertSame($data['software_version'], $SmokeCoAlarm->getSoftwareVersion());
        self::assertSame($data['is_online'], $SmokeCoAlarm->isOnline());
        self::assertSame($data['locale'], $SmokeCoAlarm->getLocale());
        self::assertSame($data['battery_health'], $SmokeCoAlarm->getBatteryHealth()->getValue());
        self::assertSame($data['co_alarm_state'], $SmokeCoAlarm->getCoAlarmState()->getValue());
        self::assertSame($data['smoke_alarm_state'], $SmokeCoAlarm->getSmokeAlarmState()->getValue());
        self::assertSame($data['ui_color_state'], $SmokeCoAlarm->getUiColorState()->getValue());
        self::assertSame($data['is_manual_test_active'], $SmokeCoAlarm->isManualTestActive());
        self::assertDateTimeOrNull($data, 'last_connection', $SmokeCoAlarm->getLastConnection());
        self::assertDateTimeOrNull($data, 'last_manual_test_time', $SmokeCoAlarm->getLastManualTest());
    }

    public function getSmokeCoAlarmData(): array
    {
        return [
            'SmokeCoAlarm' => [$this->getDataFromFile('smokecoalarm.json')],
        ];
    }
}
