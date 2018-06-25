<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\_helpers;

use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\Client\Structure\Away;

trait StructureHelperTrait
{
    protected function getStructureObject(string $name): Structure
    {
        return new Structure(
            '',
            $name,
            [],
            [],
            [],
            '',
            new \DateTimeZone('UTC'),
            Away::away(),
            true
        );
    }
}
