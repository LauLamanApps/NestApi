<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit;

use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Factory\Device\CameraFactoryInterface;
use LauLamanApps\NestApi\Client\Factory\Device\ProtectFactoryInterface;
use LauLamanApps\NestApi\Client\Factory\Device\ThermostatFactoryInterface;
use LauLamanApps\NestApi\Client\Factory\StructureFactoryInterface;
use LauLamanApps\NestApi\Http\ClientInterface;
use LauLamanApps\NestApi\Http\Command\ThermostatCommand;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;
use LauLamanApps\NestApi\NestClient;
use LauLamanApps\NestApi\Tests\Unit\_helpers\CameraHelperTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\ProtectHelperTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\StructureHelperTrait;
use LauLamanApps\NestApi\Tests\Unit\_helpers\ThermostatHelperTrait;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

final class NestClientTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    use CameraHelperTrait;
    use ProtectHelperTrait;
    use StructureHelperTrait;
    use ThermostatHelperTrait;

    /**
     * @test
     */
    public function getThermostats(): void
    {
        $response = $this->getResponse();
        $data = [['thermostat1'], ['thermostat2'], ['thermostat3']];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::THERMOSTATS)->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        foreach ($data as $subData) {
            $thermostatFactory->shouldReceive('fromData')->with($subData, $client)->once()
                ->andReturn($this->getThermostatObject($client, $subData[0]));
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
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::THERMOSTAT, [$id])->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        $thermostatFactory->shouldReceive('fromData')->with($data, $client)->once()
            ->andReturn($this->getThermostatObject($client, $data[0]));

        $thermostat = $client->getThermostat($id);

        self::assertTrue($this->in_array_r($thermostat->getName(), $data));
    }

    /**
     * @test
     */
    public function getProtects(): void
    {
        $response = $this->getResponse();
        $data = [['protect1'], ['protect2'], ['protect3']];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::PROTECTS)->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        foreach ($data as $subData) {
            $protectFactory->shouldReceive('fromData')->with($subData, $client)->once()
                ->andReturn($this->getProtectObject($subData[0]));
        }

        $protects = $client->getProtects();

        foreach ($protects as $protect) {
            self::assertTrue($this->in_array_r($protect->getName(), $data));
        }
    }

    /**
     * @test
     */
    public function getProtect(): void
    {
        $response = $this->getResponse();
        $id = 'protectId';
        $data = ['protect1'];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::PROTECT, [$id])->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        $protectFactory->shouldReceive('fromData')->with($data, $client)->once()
            ->andReturn($this->getProtectObject($data[0]));

        $protect = $client->getProtect($id);

        self::assertTrue($this->in_array_r($protect->getName(), $data));
    }

    /**
     * @test
     */
    public function getCameras(): void
    {
        $response = $this->getResponse();
        $data = [['camera1'], ['camera2'], ['camera3']];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::CAMERAS)->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        foreach ($data as $subData) {
            $cameraFactory->shouldReceive('fromData')->with($subData, $client)->once()
                ->andReturn($this->getCameraObject($subData[0]));
        }

        $cameras = $client->getCameras();

        foreach ($cameras as $camera) {
            self::assertTrue($this->in_array_r($camera->getName(), $data));
        }
    }

    /**
     * @test
     */
    public function getCamera(): void
    {
        $response = $this->getResponse();
        $id = 'cameraId';
        $data = ['camera1'];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::CAMERA, [$id])->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        $cameraFactory->shouldReceive('fromData')->with($data, $client)->once()
            ->andReturn($this->getCameraObject($data[0]));

        $camera = $client->getCamera($id);

        self::assertTrue($this->in_array_r($camera->getName(), $data));
    }

    /**
     * @test
     */
    public function getStructures(): void
    {
        $response = $this->getResponse();
        $data = [['structure1'], ['structure2'], ['structure3']];
        $json = json_encode($data);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::STRUCTURES)->once()
            ->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()
            ->andReturn($json);
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        foreach ($data as $subData) {
            $structureFactory->shouldReceive('fromData')->with($subData, $client)->once()
                ->andReturn($this->getStructureObject($subData[0]));
        }

        $structures = $client->getStructures();

        foreach ($structures as $structure) {
            self::assertTrue($this->in_array_r($structure->getName(), $data));
        }
    }

    /**
     * @test
     */
    public function sendCommand(): void
    {
        $id = 'thermostatId';
        $adapter = $this->getAdapter();
        $thermostatFactory = $this->getThermostatFactory();
        $protectFactory = $this->getProtectFactory();
        $cameraFactory = $this->getCameraFactory();
        $structureFactory = $this->getStructureFactory();

        $client = new NestClient($adapter, $thermostatFactory, $protectFactory, $cameraFactory, $structureFactory);

        $command = new ThermostatCommand($id);
        $command->setTargetTemperature(Thermostat\Temperature::celsius(10));

        $adapter->shouldReceive('putEndpoint')
            ->with(MapperInterface::THERMOSTAT_PUT, [$command->getDeviceId()], $command->getCommands())->once();

        $client->sendCommand($command);
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

    private function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}
