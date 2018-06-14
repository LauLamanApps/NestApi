<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Thermostat;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static HvacMode heat()
 * @method bool isHeat()
 * @method static HvacMode cool()
 * @method bool isCool()
 * @method static HvacMode heatCool()
 * @method bool isHeatCool()
 * @method static HvacMode eco()
 * @method bool isEco()
 * @method static HvacMode off()
 * @method bool isOff()
 */
final class HvacMode extends AbstractEnum
{
    private const HEAT ='heat';
    private const COOL ='cool';
    private const HEAT_COOL ='heat-cool';
    private const ECO ='eco';
    private const OFF ='off';
}
