<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Thermostat;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static HvacState heating()
 * @method bool isHeating()
 * @method static HvacState cooling()
 * @method bool isCooling()
 * @method static HvacState off()
 * @method bool isOff()
 */
final class HvacState extends AbstractEnum
{
    private const HEATING = 'heating';
    private const COOLING = 'cooling';
    private const OFF = 'off';
}
