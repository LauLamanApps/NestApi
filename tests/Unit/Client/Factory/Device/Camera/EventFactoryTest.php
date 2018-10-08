<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Client\Factory\Device\Camera;

use LauLamanApps\NestApi\Client\Factory\Device\Camera\EventFactory;
use LauLamanApps\NestApi\Tests\Unit\_helpers\TestDataLoaderTrait;
use PHPUnit\Framework\TestCase;

final class EventFactoryTest extends TestCase
{
    use TestDataLoaderTrait;

    protected const TEST_FILES_DIR = __DIR__ . '/../../../../../files/UnitTests/Client/Factory/Device/Camera/EventFactoryTest/';

    /**
     * @test
     */
    public function fromData(): void
    {
        $data = $this->getDataFromFile('event.json');

        $factory = new EventFactory();
        $event = $factory->fromData($data);

        self::assertSame($data['start_time'], $event->getStartTime()->format('Y-m-d\TH:i:s.000\Z'));
        self::assertSame($data['end_time'], $event->getEndTime()->format('Y-m-d\TH:i:s.000\Z'));
        self::assertSame($data['urls_expire_time'], $event->getUrlsExpireTime()->format('Y-m-d\TH:i:s.000\Z'));
        self::assertSame($data['has_sound'], $event->hasSound());
        self::assertSame($data['has_motion'], $event->hasMotion());
        self::assertSame($data['has_person'], $event->hasPerson());
        self::assertSame($data['web_url'], $event->getWebUrl());
        self::assertSame($data['app_url'], $event->getAppUrl());
    }

    /**
     * @test
     */
    public function fromDataNull(): void
    {
        $factory = new EventFactory();
        $event = $factory->fromData(null);

        self::assertNull($event);
    }
}
