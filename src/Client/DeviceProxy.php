<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\NestClient;

abstract class DeviceProxy
{
    /**
     * @var NestClient
     */
    private $__client;

    /**
     * @var string
     */
    private $__deviceId;

    /**
     * @var null|Thermostat|Protect
     */
    private $__device;

    /**
     * @return Thermostat|Protect|Camera
     */
    public function __construct(NestClient $client, $deviceId)
    {
        $this->__deviceId = $deviceId;
        $this->__client = $client;
    }

    /**
     * @return Thermostat|Protect
     */
    abstract protected function __load(NestClient $client, string $deviceId);

    public function __call($method, $args)
    {
        if (!$this->__device) {
            $this->__device = $this->__load($this->__client, $this->__deviceId);
        }

        return call_user_func_array([$this->__device, $method], $args);
    }
}
