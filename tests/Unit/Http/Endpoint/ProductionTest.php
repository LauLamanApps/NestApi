<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Test\Http\Endpoint;

use LauLamanApps\NestApi\Http\Endpoint\Exception\EndpointCouldNotBeMappedException;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;
use LauLamanApps\NestApi\Http\Endpoint\Production;
use PHPUnit\Framework\TestCase;

/**
 * @small
 */
final class ProductionTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function canMapAllKeys(string $endpointKey, ?array $bits = []):void
    {
        $endpoint = new Production();
        $endpoint = $endpoint->map($endpointKey, $bits);

        self::assertNotNull($endpoint);
        self::assertContains(Production::BASE_URL, $endpoint);

        foreach ($bits as $bit) {
            self::assertContains($bit, $endpoint);
        }
    }

    /**
     * @test
     */
    public function mappingInvalidKeyThrowsException():void
    {
        $this->expectException(EndpointCouldNotBeMappedException::class);

        $endpoint = new Production();
        $endpoint->map('invalid');
    }

    public function getEndpoints(): array
    {
        return [
            MapperInterface::THERMOSTATS => [MapperInterface::THERMOSTATS],
            MapperInterface::THERMOSTAT => [MapperInterface::THERMOSTAT, ['id']],
            MapperInterface::THERMOSTAT_PUT => [MapperInterface::THERMOSTAT_PUT, ['id']],
            MapperInterface::PROTECTS => [MapperInterface::PROTECTS,],
            MapperInterface::PROTECT => [MapperInterface::PROTECT, ['id']],
            MapperInterface::CAMERAS => [MapperInterface::CAMERAS,],
            MapperInterface::CAMERA => [MapperInterface::CAMERA, ['id']],
            MapperInterface::STRUCTURES => [MapperInterface::STRUCTURES,],
            MapperInterface::STRUCTURE => [MapperInterface::STRUCTURE, ['id']],
        ];
    }
}
