<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Protect;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static AlarmState ok()
 * @method bool isOk()
 * @method static AlarmState replace()
 * @method bool isReplace()
 */
final class BatteryHealth extends AbstractEnum
{
    private const OK = 'ok';
    private const REPLACE = 'replace';
}
