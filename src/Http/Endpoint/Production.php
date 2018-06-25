<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Endpoint;

use Exception;
use LauLamanApps\NestApi\Http\Endpoint\Exception\EndpointCouldNotBeMappedException;

final class Production implements MapperInterface
{
    public const BASE_URL = 'https://developer-api.nest.com';
    private const THERMOSTATS_ENDPOINT = '/devices/thermostats';
    private const THERMOSTAT_ENDPOINT = '/devices/thermostats/%s';
    private const PUT_THERMOSTAT_ENDPOINT = '/devices/thermostats/%s';
    private const PROTECTS_ENDPOINT = '/devices/smoke_co_alarms';
    private const PROTECT_ENDPOINT = '/devices/smoke_co_alarms/%s';
    private const CAMERAS_ENDPOINT = '/devices/cameras';
    private const CAMERA_ENDPOINT = '/devices/cameras/%s';
    private const STRUCTURES_ENDPOINT = '/structures';
    private const STRUCTURE_ENDPOINT = '/structures/%s';

    private $map = [];

    public function __construct()
    {
        $this->map = [
            MapperInterface::THERMOSTATS => self::BASE_URL . self::THERMOSTATS_ENDPOINT,
            MapperInterface::THERMOSTAT => self::BASE_URL . self::THERMOSTAT_ENDPOINT,
            MapperInterface::THERMOSTAT_PUT => self::BASE_URL . self::PUT_THERMOSTAT_ENDPOINT,
            MapperInterface::PROTECTS => self::BASE_URL . self::PROTECTS_ENDPOINT,
            MapperInterface::PROTECT => self::BASE_URL . self::PROTECT_ENDPOINT,
            MapperInterface::CAMERAS => self::BASE_URL . self::CAMERAS_ENDPOINT,
            MapperInterface::CAMERA => self::BASE_URL . self::CAMERA_ENDPOINT,
            MapperInterface::STRUCTURES => self::BASE_URL . self::STRUCTURES_ENDPOINT,
            MapperInterface::STRUCTURE => self::BASE_URL . self::STRUCTURE_ENDPOINT,
        ];
    }

    public function map(string $key, ?array $bits = []): string
    {
        if (array_key_exists($key, $this->map)) {
            $url = $this->map[$key];
        } else {
            throw new EndpointCouldNotBeMappedException(sprintf('key \'%s\' could not be mapped to an URL', $key));
        }

        return sprintf($url, ...$bits);
    }
}
