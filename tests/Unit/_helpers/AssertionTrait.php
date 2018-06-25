<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use DateTimeInterface;

trait AssertionTrait
{
    public static function assertDateTimeOrNull(array $data, string $key, ?DateTimeInterface $expected): void
    {
        if (isset($data[$key])) {
            self::assertSame($data[$key], $expected->format('Y-m-d\TH:i:s.000\Z'));
        } else {
            self::assertNull($expected);
        }
    }
}
