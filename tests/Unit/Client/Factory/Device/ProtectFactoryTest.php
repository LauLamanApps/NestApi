<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Factory\Device\ProtectFactory;
use LauLamanApps\NestApi\Client\Structure\ProtectProxy;
use LauLamanApps\NestApi\Tests\Unit\_helpers\AssertionTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use PHPUnit\Framework\TestCase;

final class ProtectFactoryTest extends TestCase
{
    use AssertionTrait;
    use TestDataLoaderTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../../files/UnitTests/Client/Factory/Device/ProtectFactoryTest/';

    /**
     * @test
     * @dataProvider getProtectData
     */
    public function fromData(array $data): void
    {
        $factory = new ProtectFactory();
        $protect = $factory->fromData($data);

        self::assertSame($data['device_id'], $protect->getDeviceId());
        self::assertSame($data['where_id'], $protect->getWhereId());
        self::assertSame($data['structure_id'], $protect->getStructureId());
        self::assertSame($data['name'], $protect->getName());
        self::assertSame($data['name_long'], $protect->getNameLong());
        self::assertSame($data['software_version'], $protect->getSoftwareVersion());
        self::assertSame($data['is_online'], $protect->isOnline());
        self::assertSame($data['locale'], $protect->getLocale());
        self::assertSame($data['battery_health'], $protect->getBatteryHealth()->getValue());
        self::assertSame($data['co_alarm_state'], $protect->getCoAlarmState()->getValue());
        self::assertSame($data['smoke_alarm_state'], $protect->getSmokeAlarmState()->getValue());
        self::assertSame($data['ui_color_state'], $protect->getUiColorState()->getValue());
        self::assertSame($data['is_manual_test_active'], $protect->isManualTestActive());
        self::assertDateTimeOrNull($data, 'last_connection', $protect->getLastConnection());
        self::assertDateTimeOrNull($data, 'last_manual_test_time', $protect->getLastManualTest());
    }

    public function getProtectData(): array
    {
        return [
            'protect' => [$this->getDataFromFile('protect.json')],
        ];
    }
}
