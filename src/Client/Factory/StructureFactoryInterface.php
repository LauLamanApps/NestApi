<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory;

use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\NestClient;

interface StructureFactoryInterface
{
    public function fromData(array $data, NestClient $client): Structure;
}
