<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\AlarmState;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\BatteryHealth;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm\UiColorState;

final class SmokeCoAlarm
{
    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var string
     */
    private $whereId;

    /**
     * @var string
     */
    private $structureId;

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
    private $locale;

    /**
     * @var string
     */
    private $softwareVersion;

    /**
     * @var bool
     */
    private $online;

    /**
     * @var ?DateTimeImmutable
     */
    private $lastConnection;

    /**
     * @var BatteryHealth
     */
    private $batteryHealth;

    /**
     * @var AlarmState
     */
    private $coAlarmState;

    /**
     * @var AlarmState
     */
    private $smokeAlarmState;

    /**
     * @var UiColorState
     */
    private $uiColorState;

    /**
     * @var bool
     */
    private $manualTestActive;

    /**
     * @var DateTimeImmutable
     */
    private $lastManualTest;

    public function __construct(
        string $deviceId,
        string $whereId,
        string $structureId,
        string $name,
        string $nameLong,
        string $locale,
        string $softwareVersion,
        bool $online,
        ?DateTimeImmutable $lastConnection = null,
        BatteryHealth $batteryHealth,
        AlarmState $coAlarmState,
        AlarmState $smokeAlarmState,
        UiColorState $uiColorState,
        bool $manualTestActive,
        DateTimeImmutable $lastManualTest
    ) {
        $this->deviceId = $deviceId;
        $this->whereId = $whereId;
        $this->structureId = $structureId;
        $this->name = $name;
        $this->nameLong = $nameLong;
        $this->locale = $locale;
        $this->softwareVersion = $softwareVersion;
        $this->online = $online;
        $this->lastConnection = $lastConnection;
        $this->batteryHealth = $batteryHealth;
        $this->coAlarmState = $coAlarmState;
        $this->smokeAlarmState = $smokeAlarmState;
        $this->uiColorState = $uiColorState;
        $this->manualTestActive = $manualTestActive;
        $this->lastManualTest = $lastManualTest;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getWhereId(): string
    {
        return $this->whereId;
    }

    public function getStructureId(): string
    {
        return $this->structureId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNameLong(): string
    {
        return $this->nameLong;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getSoftwareVersion(): string
    {
        return $this->softwareVersion;
    }

    public function isOnline(): bool
    {
        return $this->online;
    }

    public function getLastConnection(): ?DateTimeImmutable
    {
        return $this->lastConnection;
    }

    public function getBatteryHealth(): BatteryHealth
    {
        return $this->batteryHealth;
    }

    public function getCoAlarmState(): AlarmState
    {
        return $this->coAlarmState;
    }

    public function getSmokeAlarmState(): AlarmState
    {
        return $this->smokeAlarmState;
    }

    public function getUiColorState(): UiColorState
    {
        return $this->uiColorState;
    }

    public function isManualTestActive(): bool
    {
        return $this->manualTestActive;
    }

    public function getLastManualTest(): DateTimeImmutable
    {
        return $this->lastManualTest;
    }
}
