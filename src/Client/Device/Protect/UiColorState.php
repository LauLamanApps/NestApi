<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Protect;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static UiColorState gray()
 * @method bool isGray()
 * @method static UiColorState green()
 * @method bool isGreen()
 * @method static UiColorState yellow()
 * @method bool isYellow()
 * @method static UiColorState red()
 * @method bool isRed()
 */
final class UiColorState extends AbstractEnum
{
    private const GRAY = 'gray';
    private const GREEN = 'green';
    private const YELLOW = 'yellow';
    private const RED = 'red';
}
