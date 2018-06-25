<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\NestClient;

interface CameraFactoryInterface
{
    public function fromData(array $data): Camera;
}
