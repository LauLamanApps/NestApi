<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use DateTimeImmutable;
use LauLamanApps\NestApi\Client\Device\Camera;

trait CameraHelperTrait
{
    protected function getCameraObject(?string $name = ''): Camera
    {
        return new Camera(
            '',
            '',
            '',
            $name,
            '',
            '',
            true,
            true,
            true,
            new DateTimeImmutable(),
            true,
            null,
            '',
            ''
        );
    }
}
