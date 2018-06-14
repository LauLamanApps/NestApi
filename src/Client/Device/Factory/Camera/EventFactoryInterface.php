<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Factory\Camera;

use LauLamanApps\NestApi\Client\Device\Camera\Event;

interface EventFactoryInterface
{
    public function fromData(?array $data): ?Event;
}
