<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use LauLamanApps\NestApi\Client\DeviceProxy;
use LauLamanApps\NestApi\NestClient;

final class CameraProxy extends DeviceProxy
{
    protected function __load(NestClient $client, string $deviceId)
    {
        return $client->getCamera($deviceId);
    }
}
