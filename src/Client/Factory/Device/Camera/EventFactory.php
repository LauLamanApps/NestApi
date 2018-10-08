<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device\Camera;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Device\Camera\Event;

final class EventFactory extends AbstractFactory implements EventFactoryInterface
{
    public function fromData(?array $data): ?Event
    {
        if (!$data) {
            return null;
        }

        return new Event(
            $this->extractDateTimeImmutableOrNull('start_time', $data),
            $this->extractDateTimeImmutableOrNull('end_time', $data),
            $this->extractDateTimeImmutableOrNull('urls_expire_time', $data),
            $this->extractBoolean('has_sound', $data),
            $this->extractBoolean('has_motion', $data),
            $this->extractBoolean('has_person', $data),
            $this->extractString('web_url', $data),
            $this->extractString('app_url', $data)
        );
    }
}
