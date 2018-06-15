<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit;

use LauLamanApps\NestApi\Client\Device\Factory\CameraFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Factory\ProtectFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Factory\ThermostatFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Factory\StructureFactoryInterface;
use LauLamanApps\NestApi\Http\ClientInterface;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;
use LauLamanApps\NestApi\NestClient;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

final class NestClientTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function getThermostats(): void
    {
        $response = $this->getResponse();
        $data = [['thermostat1'], ['thermostat2'], ['thermostat3']];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::THERMOSTATS)->once()->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        foreach ($data as $subData) {
            $thermostatFactory->shouldReceive('fromData')->with($subData, $client)->once()->andReturn($this->getThermostatObject($client, $subData[0]));
        }

        $thermostats = $client->getThermostats();

        foreach ($thermostats as $thermostat) {
            self::assertTrue($this->in_array_r($thermostat->getName(), $data));
        }
    }

    /**
     * @test
     */
    public function getThermostat(): void
    {
        $response = $this->getResponse();
        $id = 'thermostatId';
        $data = ['thermostat1'];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::THERMOSTAT, [$id])->once()->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        $thermostatFactory->shouldReceive('fromData')->with($data, $client)->once()->andReturn($this->getThermostatObject($client, $data[0]));

        $thermostat = $client->getThermostat($id);

        self::assertTrue($this->in_array_r($thermostat->getName(), $data));
    }

    /**
     * @return MockInterface|ResponseInterface
     */
    private function getResponse()
    {
        return Mockery::mock(ResponseInterface::class);
    }

    /**
     * @return MockInterface|ClientInterface
     */
    private function getAdapter()
    {
        return Mockery::mock(ClientInterface::class);
    }

    /**
     * @return MockInterface|ThermostatFactoryInterface
     */
    private function getThermostatFactory()
    {
        return Mockery::mock(ThermostatFactoryInterface::class);
    }

    /**
     * @return MockInterface|ProtectFactoryInterface
     */
    private function getProtectFactory()
    {
        return Mockery::mock(ProtectFactoryInterface::class);
    }

    /**
     * @return MockInterface|CameraFactoryInterface
     */
    private function getCameraFactory()
    {
        return Mockery::mock(CameraFactoryInterface::class);
    }

    /**
     * @return MockInterface|StructureFactoryInterface
     */
    private function getStructureFactory()
    {
        return Mockery::mock(StructureFactoryInterface::class);
    }

    private function getThermostatObject(NestClient $client, string $name): Thermostat
    {
        return new Thermostat(
            $client,
            '',
            '',
            '',
            $name,
            '',
            Thermostat\Temperature\Scale::celsius(),
            '',
            '',
            true,
            true,
            true,
            Thermostat\Temperature::celsius(20.5),
            Thermostat\Temperature::celsius(20.5),
            Thermostat\Temperature::celsius(20.5),
            Thermostat\Temperature::celsius(20.5),
            Thermostat\Temperature::celsius(20.5),
            Thermostat\Temperature::celsius(20.5),
            false,
            40,
            Thermostat\HvacMode::off(),
            Thermostat\HvacState::off(),
            false,
            false,
            false,
            null,
            false,
            new \DateTimeImmutable()
        );
    }

    private function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

}
