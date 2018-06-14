<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Thermostat\Temperature;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static Scale celsius()
 * @method bool isCelsius()
 * @method static Scale fahrenheit()
 * @method bool isFahrenheit()
 */
final class Scale extends AbstractEnum
{
    private const CELSIUS =  'c';
    private const FAHRENHEIT =  'f';

    public static function get($value): AbstractEnum
    {
        return parent::get(strtolower($value));
    }
}
