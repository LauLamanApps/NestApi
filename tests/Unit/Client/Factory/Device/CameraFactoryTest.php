<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Factory\Device\Camera\EventFactoryInterface;
use LauLamanApps\NestApi\Client\Factory\Device\CameraFactory;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use PHPUnit\Framework\TestCase;

final class CameraFactoryTest extends TestCase
{
    use TestDataLoaderTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../../files/UnitTests/Client/Factory/Device/CameraFactoryTest/';

    /**
     * @test
     * @dataProvider getCameraData
     */
    public function fromData(array $data): void
    {
        $eventFactory = \Mockery::mock(EventFactoryInterface::class);

        if (isset($data['last_event'])) {
            $eventFactory->shouldReceive('fromData')->with($data['last_event'])->once()->andReturnNull();
        } else {
            $eventFactory->shouldReceive('fromData')->with(null)->once()->andReturnNull();
        }

        $factory = new CameraFactory($eventFactory);
        $thermostat = $factory->fromData($data);

        self::assertSame($data['device_id'], $thermostat->getDeviceId());
        self::assertSame($data['where_id'], $thermostat->getWhereId());
        self::assertSame($data['structure_id'], $thermostat->getStructureId());
        self::assertSame($data['name'], $thermostat->getName());
        self::assertSame($data['name_long'], $thermostat->getNameLong());
        self::assertSame($data['software_version'], $thermostat->getSoftwareVersion());
        self::assertSame($data['is_online'], $thermostat->isOnline());
        self::assertSame($data['is_streaming'], $thermostat->isStreaming());
        self::assertSame($data['is_audio_input_enabled'], $thermostat->isAudioInputEnabled());
        self::assertSame($data['last_is_online_change'], $thermostat->getLastIsOnlineChange()->format('Y-m-d\TH:i:s.000\Z'));
        self::assertSame($data['is_video_history_enabled'], $thermostat->isVideoHistoryEnabled());
        self::assertSame($data['web_url'], $thermostat->getWebUrl());
        self::assertSame($data['app_url'], $thermostat->getAppUrl());
    }

    public function getCameraData(): array
    {
        return [
            'camera without event' => [$this->getDataFromFile('without_event.json')],
            'camera with event' => [$this->getDataFromFile('with_event.json')],
        ];
    }
}
