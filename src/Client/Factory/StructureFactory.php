<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Factory;

use DateTimeZone;
use LauLamanApps\NestApi\Client\__shared\AbstractFactory;
use LauLamanApps\NestApi\Client\Structure;
use LauLamanApps\NestApi\Client\Structure\Away;
use LauLamanApps\NestApi\NestClientInterface;

final class StructureFactory extends AbstractFactory implements StructureFactoryInterface
{
    public function fromData(array $data, NestClientInterface $client): Structure
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

    private function extractThermostats(NestClientInterface $client, ?array $thermostatsData): array
    {
        $thermostatsData = $thermostatsData ?? [];
        $thermostats = [];
        foreach ($thermostatsData as $thermostat) {
            $thermostats[$thermostat] = new Structure\ThermostatProxy($client, $thermostat);
        }

        return $thermostats;
    }

    private function extractProtects(NestClientInterface $client, ?array $protectsData): array
    {
        $protectsData = $protectsData ?? [];
        $protects = [];
        foreach ($protectsData as $protect) {
            $protects[$protect] = new Structure\ProtectProxy($client, $protect);
        }

        return $protects;
    }

    private function extractCameras(NestClientInterface $client, ?array $camerasData): array
    {
        $camerasData = $camerasData ?? [];
        $cameras = [];
        foreach ($camerasData as $camera) {
            $cameras[$camera] = new Structure\CameraProxy($client, $camera);
        }

        return $cameras;
    }
}
