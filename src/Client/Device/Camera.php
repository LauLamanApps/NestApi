<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Camera\Event;

final class Camera
{
    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var string
     */
    private $structureId;

    /**
     * @var string
     */
    private $whereId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $nameLong;

    /**
     * @var string
     */
    private $softwareVersion;

    /**
     * @var bool
     */
    private $online;

    /**
     * @var bool
     */
    private $streaming;

    /**
     * @var bool
     */
    private $audioInputEnabled;

    /**
     * @var DateTimeImmutable
     */
    private $lastIsOnlineChange;

    /**
     * @var bool
     */
    private $videoHistoryEnabled;

    /**
     * @var null|Event
     */
    private $lastEvent;

    /**
     * @var string
     */
    private $webUrl;

    /**
     * @var string
     */
    private $appUrl;

    public function __construct(
        string $deviceId,
        string $structureId,
        string $whereId,
        string $name,
        string $nameLong,
        string $softwareVersion,
        bool $online,
        bool $streaming,
        bool $audioInputEnabled,
        DateTimeImmutable $lastIsOnlineChange,
        bool $videoHistoryEnabled,
        ?Event $lastEvent,
        string $webUrl,
        string $appUrl
    ) {
        $this->deviceId = $deviceId;
        $this->structureId = $structureId;
        $this->whereId = $whereId;
        $this->name = $name;
        $this->nameLong = $nameLong;
        $this->softwareVersion = $softwareVersion;
        $this->online = $online;
        $this->streaming = $streaming;
        $this->audioInputEnabled = $audioInputEnabled;
        $this->lastIsOnlineChange = $lastIsOnlineChange;
        $this->videoHistoryEnabled = $videoHistoryEnabled;
        $this->lastEvent = $lastEvent;
        $this->webUrl = $webUrl;
        $this->appUrl = $appUrl;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getStructureId(): string
    {
        return $this->structureId;
    }

    public function getWhereId(): string
    {
        return $this->whereId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNameLong(): string
    {
        return $this->nameLong;
    }

    public function getSoftwareVersion(): string
    {
        return $this->softwareVersion;
    }

    public function isOnline(): bool
    {
        return $this->online;
    }

    public function isStreaming(): bool
    {
        return $this->streaming;
    }

    public function isAudioInputEnabled(): bool
    {
        return $this->audioInputEnabled;
    }

    public function getLastIsOnlineChange(): DateTimeImmutable
    {
        return $this->lastIsOnlineChange;
    }

    public function isVideoHistoryEnabled(): bool
    {
        return $this->videoHistoryEnabled;
    }

    public function getLastEvent(): ?Event
    {
        return $this->lastEvent;
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
