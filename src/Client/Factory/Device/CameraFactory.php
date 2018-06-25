<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Factory\Device\Camera\EventFactoryInterface;
use LauLamanApps\NestApi\NestClient;

final class CameraFactory extends AbstractFactory implements CameraFactoryInterface
{
    /**
     * @var EventFactoryInterface
     */
    private $eventFactory;

    public function __construct(EventFactoryInterface $eventFactory)
    {
        $this->eventFactory = $eventFactory;
    }

    public function fromData(array $data): Camera
    {
        return new Camera(
            $this->extractString('device_id', $data),
            $this->extractString('structure_id', $data),
            $this->extractString('where_id', $data),
            $this->extractString('name', $data),
            $this->extractString('name_long', $data),
            $this->extractString('software_version', $data),
            $this->extractBoolean('is_online', $data),
            $this->extractBoolean('is_streaming', $data),
            $this->extractBoolean('is_audio_input_enabled', $data),
            new DateTimeImmutable($this->extractString('last_is_online_change', $data)),
            $this->extractBoolean('is_video_history_enabled', $data),
            $this->eventFactory->fromData($this->extractArrayOrNull('last_event', $data)),
            $this->extractString('web_url', $data),
            $this->extractString('app_url', $data)
        );
    }
}
