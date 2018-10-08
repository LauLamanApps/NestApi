<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory\Device;

use LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;
use LauLamanApps\NestApi\NestClient;

interface SmokeCoAlarmFactoryInterface
{
    public function fromData(array $data): SmokeCoAlarm;
}
