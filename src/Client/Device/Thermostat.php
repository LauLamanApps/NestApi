<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacMode;
use LauLamanApps\NestApi\Client\Device\Thermostat\HvacState;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;
use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;
use LauLamanApps\NestApi\Http\Command\ThermostatCommand;
use LauLamanApps\NestApi\NestClientInterface;

final class Thermostat
{
    /**
     * @var NestClientInterface
     */
    private $client;

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
     * @var Scale
     */
    private $scale;

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
    private $canHeat;

    /**
     * @var bool
     */
    private $canCool;

    /**
     * @var bool
     */
    private $hasFan;

    /**
     * @var Temperature
     */
    private $ambientTemperature;

    /**
     * @var Temperature
     */
    private $targetTemperature;

    /**
     * @var Temperature
     */
    private $targetTemperatureHigh;

    /**
     * @var Temperature
     */
    private $targetTemperatureLow;

    /**
     * @var Temperature
     */
    private $lockedTempMin;

    /**
     * @var Temperature
     */
    private $lockedTempMax;

    /**
     * @var bool
     */
    private $has_leaf;

    /**
     * @var int
     */
    private $humidity;

    /**
     * @var HvacMode
     */
    private $hvacMode;

    /**
     * @var HvacState
     */
    private $hvacState;

    /**
     * @var bool
     */
    private $isUsingEmergencyHeat;

    /**
     * @var bool
     */
    private $locked;

    /**
     * @var bool
     */
    private $online;

    /**
     * @var null|DateTimeImmutable
     */
    private $lastConnection;

    /**
     * @var bool
     */
    private $fanTimerActive;

    /**
     * @var DateTimeImmutable
     */
    private $fanTimerTimeout;


    public function __construct(
        NestClientInterface $nestClient,
        string $deviceId,
        string $whereId,
        string $structureId,
        string $name,
        string $nameLong,
        Scale $scale,
        string $locale,
        string $softwareVersion,
        bool $canHeat,
        bool $canCool,
        bool $hasFan,
        Temperature $ambientTemperature,
        Temperature $targetTemperature,
        Temperature $targetTemperatureHigh,
        Temperature $targetTemperatureLow,
        Temperature $lockedTempMin,
        Temperature $lockedTempMax,
        bool $has_leaf,
        int $humidity,
        HvacMode $hvacMode,
        HvacState $hvacState,
        bool $isUsingEmergencyHeat,
        bool $locked,
        bool $online,
        ?DateTimeImmutable $lastConnection = null,
        bool $fanTimerActive,
        DateTimeImmutable $fanTimerTimeout
    ) {
        $this->deviceId = $deviceId;
        $this->whereId = $whereId;
        $this->structureId = $structureId;
        $this->name = $name;
        $this->nameLong = $nameLong;
        $this->scale = $scale;
        $this->locale = $locale;
        $this->softwareVersion = $softwareVersion;
        $this->canHeat = $canHeat;
        $this->canCool = $canCool;
        $this->hasFan = $hasFan;
        $this->ambientTemperature = $ambientTemperature;
        $this->targetTemperature = $targetTemperature;
        $this->targetTemperatureHigh = $targetTemperatureHigh;
        $this->targetTemperatureLow = $targetTemperatureLow;
        $this->lockedTempMin = $lockedTempMin;
        $this->lockedTempMax = $lockedTempMax;
        $this->has_leaf = $has_leaf;
        $this->humidity = $humidity;
        $this->hvacMode = $hvacMode;
        $this->hvacState = $hvacState;
        $this->isUsingEmergencyHeat = $isUsingEmergencyHeat;
        $this->locked = $locked;
        $this->online = $online;
        $this->lastConnection = $lastConnection;
        $this->fanTimerActive = $fanTimerActive;
        $this->fanTimerTimeout = $fanTimerTimeout;
        $this->client = $nestClient;
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

    public function getScale(): Scale
    {
        return $this->scale;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getSoftwareVersion(): string
    {
        return $this->softwareVersion;
    }

    public function canHeat(): bool
    {
        return $this->canHeat;
    }

    public function canCool(): bool
    {
        return $this->canCool;
    }

    public function hasFan(): bool
    {
        return $this->hasFan;
    }

    public function getAmbientTemperature(): Temperature
    {
        return $this->ambientTemperature;
    }

    public function getTargetTemperature(): Temperature
    {
        return $this->targetTemperature;
    }

    public function getTargetTemperatureHigh(): Temperature
    {
        return $this->targetTemperatureHigh;
    }

    public function getTargetTemperatureLow(): Temperature
    {
        return $this->targetTemperatureLow;
    }

    public function getLockedTempMin(): Temperature
    {
        return $this->lockedTempMin;
    }

    public function getLockedTempMax(): Temperature
    {
        return $this->lockedTempMax;
    }

    public function hasLeaf(): bool
    {
        return $this->has_leaf;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function getHvacMode(): HvacMode
    {
        return $this->hvacMode;
    }

    public function getHvacState(): HvacState
    {
        return $this->hvacState;
    }

    public function isUsingEmergencyHeat(): bool
    {
        return $this->isUsingEmergencyHeat;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function isOnline(): bool
    {
        return $this->online;
    }

    public function getLastConnection(): ?DateTimeImmutable
    {
        return $this->lastConnection;
    }

    public function isFanTimerActive(): bool
    {
        return $this->fanTimerActive;
    }

    public function getFanTimerTimeout(): DateTimeImmutable
    {
        return $this->fanTimerTimeout;
    }

    public function setScale(Scale $scale): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setScale($scale);

        $this->client->sendCommand($command);
    }

    public function setTargetTemperature(Temperature $temperature): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setTargetTemperature($temperature);

        $this->client->sendCommand($command);
    }

    public function setTargetTemperatureHigh(Temperature $temperature): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setTargetTemperatureHigh($temperature);

        $this->client->sendCommand($command);
    }

    public function setTargetTemperatureLow(Temperature $temperature): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setTargetTemperatureLow($temperature);

        $this->client->sendCommand($command);
    }

    public function setEcoTemperatureHigh(Temperature $temperature): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setEcoTemperatureHigh($temperature);

        $this->client->sendCommand($command);
    }

    public function setEcoTemperatureLow(Temperature $temperature): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setEcoTemperatureLow($temperature);

        $this->client->sendCommand($command);
    }

    public function setHvacMode(HvacMode $mode): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setHvacMode($mode);

        $this->client->sendCommand($command);
    }

    public function setLabel(string $label): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setLabel($label);

        $this->client->sendCommand($command);
    }

    public function setFanTimerDuration(int $duration): void
    {
        $command = new ThermostatCommand($this->getDeviceId());
        $command->setFanTimerDuration($duration);

        $this->client->sendCommand($command);
    }
}
