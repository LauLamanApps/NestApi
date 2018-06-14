<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory;

use DateTimeZone;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\Client\Structure\Away;
use LauLamanApps\NestApi\NestClient;

final class StructureFactory extends AbstractFactory implements StructureFactoryInterface
{
    public function fromData(array $data, NestClient $client): Structure
    {
        return new Structure(
            $this->extractString('structure_id', $data),
            $this->extractString('name', $data),
            $this->extractThermostats($client, $this->extractArrayOrNull('thermostats', $data)),
            $this->extractProtects($client, $this->extractArrayOrNull('smoke_co_alarms', $data)),
            $this->extractCameras($client, $this->extractArrayOrNull('cameras', $data)),
            $this->extractString('country_code', $data),
            new DateTimeZone($this->extractString('time_zone', $data)),
            Away::get($this->extractString('away', $data)),
            $this->extractBoolean('rhr_enrollment', $data)
        );
    }

    private function extractThermostats(NestClient $client, ?array $thermostatsData): array
    {
        $thermostatsData = $thermostatsData ?? [];
        $thermostats = [];
        foreach ($thermostatsData as $thermostat) {
            $thermostats[] = new Structure\ThermostatProxy($client, $thermostat);
        }

        return $thermostats;
    }

    private function extractProtects(NestClient $client, ?array $protectsData): array
    {
        $protectsData = $protectsData ?? [];
        $protects = [];
        foreach ($protectsData as $protect) {
            $protects[] = new Structure\ProtectProxy($client, $protect);
        }

        return $protects;
    }

    private function extractCameras(NestClient $client, ?array $camerasData): array
    {
        $camerasData = $camerasData ?? [];
        $cameras = [];
        foreach ($camerasData as $camera) {
            $cameras[] = new Structure\CameraProxy($client, $camera);
        }

        return $cameras;
    }
}
