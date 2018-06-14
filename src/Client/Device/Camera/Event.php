<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Camera;

use DateTimeImmutable;

final class Event
{
    /**
     * @var DateTimeImmutable
     */
    private $startTime;

    /**
     * @var DateTimeImmutable
     */
    private $endTime;

    /**
     * @var DateTimeImmutable
     */
    private $urlsExpireTime;

    /**
     * @var bool
     */
    private $sound;

    /**
     * @var bool
     */
    private $motion;

    /**
     * @var bool
     */
    private $person;

    /**
     * @var string
     */
    private $webUrl;

    /**
     * @var string
     */
    private $appUrl;

    public function __construct(
        DateTimeImmutable $startTime,
        DateTimeImmutable $endTime,
        DateTimeImmutable $urlsExpireTime,
        bool $sound,
        bool $motion,
        bool $person,
        string $webUrl,
        string $appUrl
    ) {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->urlsExpireTime = $urlsExpireTime;
        $this->sound = $sound;
        $this->motion = $motion;
        $this->person = $person;
        $this->webUrl = $webUrl;
        $this->appUrl = $appUrl;
    }

    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function getEndTime(): DateTimeImmutable
    {
        return $this->endTime;
    }

    public function getUrlsExpireTime(): DateTimeImmutable
    {
        return $this->urlsExpireTime;
    }

    public function hasSound(): bool
    {
        return $this->sound;
    }

    public function hasMotion(): bool
    {
        return $this->motion;
    }

    public function hasPerson(): bool
    {
        return $this->person;
    }

    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    public function getAppUrl(): string
    {
        return $this->appUrl;
    }
}
