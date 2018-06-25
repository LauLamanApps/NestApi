<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\NestClient;

interface ProtectFactoryInterface
{
    public function fromData(array $data): Protect;
}
