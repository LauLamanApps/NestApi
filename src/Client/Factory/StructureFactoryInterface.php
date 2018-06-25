<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory;

use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\NestClientInterface;

interface StructureFactoryInterface
{
    public function fromData(array $data, NestClientInterface $client): Structure;
}
