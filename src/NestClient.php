<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi;

use LauLamanApps\NestApi\Client\Device\Camera;
use LauLamanApps\NestApi\Client\Device\Factory\CameraFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Factory\ProtectFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Factory\ThermostatFactoryInterface;
use LauLamanApps\NestApi\Client\Device\Protect;
use LauLamanApps\NestApi\Client\Device\Thermostat;
use LauLamanApps\NestApi\Client\Factory\StructureFactoryInterface;
use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\Http\ClientInterface;
use LauLamanApps\NestApi\Http\Command\Command;
use LauLamanApps\NestApi\Http\Command\ThermostatCommand;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;

final class NestClient
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var ThermostatFactoryInterface
     */
    private $thermostatFactory;

    /**
     * @var ProtectFactoryInterface
     */
    private $protectFactory;

    /**
     * @var CameraFactoryInterface
     */
    private $cameraFactory;

    /**
     * @var StructureFactoryInterface
     */
    private $structureFactory;

    public function __construct(
        ClientInterface $httpClient,
        ThermostatFactoryInterface $thermostatFactory,
        ProtectFactoryInterface $protectFactory,
        CameraFactoryInterface $cameraFactory,
        StructureFactoryInterface $structureFactory
    ) {
        $this->httpClient = $httpClient;
        $this->thermostatFactory = $thermostatFactory;
        $this->protectFactory = $protectFactory;
        $this->cameraFactory = $cameraFactory;
        $this->structureFactory = $structureFactory;
    }

    /**
     * @return Thermostat[]
     */
    public function getThermostats(): array
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::THERMOSTATS));
        $data = $this->decodeJsonToArray($json);

        $thermostats = [];
        foreach ($data as $id => $thermostatData) {
            $thermostats[] = $this->thermostatFactory->fromData($thermostatData, $this);
        }

        return $thermostats;
    }

    public function getThermostat(string $id): Thermostat
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::THERMOSTAT, [$id]));
        $data = $this->decodeJsonToArray($json);

        return $this->thermostatFactory->fromData($data, $this);
    }

    /**
     * @return Protect[]
     */
    public function getProtects(): array
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::PROTECTS));
        $data = $this->decodeJsonToArray($json);

        $protects = [];

        foreach ($data as $id => $protectData) {
            $protects[] = $this->protectFactory->fromData($protectData, $this);
        }

        return $protects;
    }

    public function getProtect(string $id): Protect
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::PROTECT, [$id]));
        $data = $this->decodeJsonToArray($json);

        return $this->protectFactory->fromData($data, $this);
    }

    /**
     * @return Camera[]
     */
    public function getCameras(): array
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::CAMERAS));
        $data = $this->decodeJsonToArray($json);

        $cameras = [];
        foreach ($data as $id => $cameraData) {
            $cameras[] = $this->cameraFactory->fromData($cameraData, $this);
        }

        return $cameras;
    }

    public function getCamera(string $id): Camera
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::CAMERA, [$id]));
        $data = $this->decodeJsonToArray($json);

        return $this->cameraFactory->fromData($data, $this);
    }

    private function decodeJsonToArray(string $json): array
    {
        return json_decode($json, true);
    }

    /**
     * @return Structure[]
     */
    public function getStructures(): array
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::STRUCTURES));
        $data = $this->decodeJsonToArray($json);

        $structures = [];
        foreach ($data as $structureData) {
            $structures[] = $this->structureFactory->fromData($structureData, $this);
        }

        return $structures;
    }

    public function sendCommand(Command $command): void
    {
        if ($command instanceof ThermostatCommand) {
            $this->httpClient->putEndpoint(
                MapperInterface::THERMOSTAT_PUT,
                [$command->getId()],
                $command->getCommands()
            );
        }
    }
}
