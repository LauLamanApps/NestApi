<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Endpoint;

use LauLamanApps\NestApi\Http\Endpoint\Exception\EndpointCouldNotBeMappedException;

interface MapperInterface
{
    public const THERMOSTATS = 'thermostats';
    public const THERMOSTAT = 'thermostat';
    public const THERMOSTAT_PUT = 'thermostat-put';
    public const PROTECTS = 'protects';
    public const PROTECT = 'protect';
    public const CAMERAS = 'cameras';
    public const CAMERA = 'camera';
    public const STRUCTURES = 'structures';
    public const STRUCTURE = 'structure';

    /**
     * @throws EndpointCouldNotBeMappedException
     */
    public function map(string $key, array $bits): string;
}
