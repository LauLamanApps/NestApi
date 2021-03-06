<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Structure\CameraProxy;
use LauLamanApps\NestApi\Client\Structure\SmokeCoAlarmProxy;
use LauLamanApps\NestApi\Client\Structure\ThermostatProxy;
use LauLamanApps\NestApi\NestClientInterface;

abstract class DeviceProxy
{
    /**
     * @var NestClientInterface
     */
    private $__client;

    /**
     * @var string
     */
    private $__deviceId;

    /**
     * @var null|Thermostat|SmokeCoAlarm|Camera
     */
    private $__device;

    /**
     * @return ThermostatProxy|SmokeCoAlarmProxy|CameraProxy
     */
    public function __construct(NestClientInterface $client, $deviceId)
    {
        $this->__deviceId = $deviceId;
        $this->__client = $client;
    }

    /**
     * @return Thermostat|SmokeCoAlarm|Camera
     */
    abstract protected function __load(NestClientInterface $client, string $deviceId);

    public function __call($method, $args)
    {
        if (!$this->__device) {
            $this->__device = $this->__load($this->__client, $this->__deviceId);
        }

        return call_user_func_array([$this->__device, $method], $args);
    }
}
