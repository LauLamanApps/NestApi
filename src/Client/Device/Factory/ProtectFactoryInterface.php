<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Factory;

use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\NestClient;

interface ProtectFactoryInterface
{
    public function fromData(array $data, NestClient $client): Protect;
}
