<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\SmokeCoAlarm;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static AlarmState ok()
 * @method bool isOk()
 * @method static AlarmState warning()
 * @method bool isWarning()
 * @method static AlarmState emergency()
 * @method bool isEmergency()
 */
final class AlarmState extends AbstractEnum
{
    private const OK = 'ok';
    private const WARNING = 'warning';
    private const EMERGENCY = 'emergency';
}
