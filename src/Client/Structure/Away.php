<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Structure;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static Away home()
 * @method bool isHome()
 * @method static Away away()
 * @method bool isAway()
 */
final class Away extends AbstractEnum
{
    private const HOME = 'home';
    private const AWAY = 'away';
}
