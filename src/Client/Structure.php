<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client;

use DateTimeZone;
use LauLamanApps\NestApi\Client\Structure\Away;
use LauLamanApps\NestApi\Client\Structure\CameraProxy;
use LauLamanApps\NestApi\Client\Structure\SmokeCoAlarmProxy;
use LauLamanApps\NestApi\Client\Structure\ThermostatProxy;

final class Structure
{
    /**
     * @var string
     */
    private $structureId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ThermostatProxy[]
     */
    private $thermostats;

    /**
     * @var SmokeCoAlarmProxy[]
     */
    private $smokeCoAlarms;

    /**
     * @var CameraProxy[]
     */
    private $cameras;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var DateTimeZone
     */
    private $timeZone;

    /**
     * @var Away
     */
    private $away;

    /**
     * @var bool
     */
    private $rhrEnrollment;

    public function __construct(
        string $structureId,
        string $name,
        array $thermostats,
        array $smokeCoAlarms,
        array $cameras,
        string $countryCode,
        DateTimeZone $timeZone,
        Away $away,
        bool $rhrEnrollment
    ) {
        $this->structureId = $structureId;
        $this->name = $name;
        $this->thermostats = $thermostats;
        $this->smokeCoAlarms = $smokeCoAlarms;
        $this->cameras = $cameras;
        $this->countryCode = $countryCode;
        $this->timeZone = $timeZone;
        $this->away = $away;
        $this->rhrEnrollment = $rhrEnrollment;
    }

    public function getStructureId(): string
    {
        return $this->structureId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ThermostatProxy[]
     */
    public function getThermostats(): array
    {
        return $this->thermostats;
    }

    /**
     * @return SmokeCoAlarmProxy[]
     */
    public function getSmokeCoAlarms(): array
    {
        return $this->smokeCoAlarms;
    }

    /**
     * @return CameraProxy[]
     */
    public function getCameras(): array
    {
        return $this->cameras;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getTimeZone(): DateTimeZone
    {
        return $this->timeZone;
    }

    public function getAway(): Away
    {
        return $this->away;
    }

    public function isRhrEnrollment(): bool
    {
        return $this->rhrEnrollment;
    }
}
