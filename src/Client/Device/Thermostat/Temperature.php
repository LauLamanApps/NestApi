<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Client\Device\Thermostat;

use LauLamanApps\NestApi\Client\Device\Thermostat\Temperature\Scale;

final class Temperature
{
    /**
     * @var Scale
     */
    private $scale;

    /**
     * @var float
     */
    private $degrees;

    public function __construct(Scale $scale, float $degrees)
    {
        $this->scale = $scale;
        $this->degrees = $degrees;
    }

    public static function celsius(float $degrees): self
    {
        return new self(Scale::celsius(), self::roundCelsius($degrees));
    }

    public static function fahrenheit(int $degrees): self
    {
        return new self(Scale::fahrenheit(), (float)$degrees);
    }

    public function getScale(): Scale
    {
        return $this->scale;
    }

    /**
     * @return float|int
     */
    public function getDegrees()
    {
        if ($this->scale->isFahrenheit()) {
            return (int) $this->degrees;
        }

        if ($this->scale->isCelsius()) {
            return self::roundCelsius($this->degrees);
        }
    }

    private static function roundCelsius(float $degrees): float
    {
        return round($degrees * 2) / 2;
    }

    public function __toString(): string
    {
        return sprintf(
            '%d°%s',
            $this->getDegrees(),
            strtoupper($this->scale->getValue())
        );
    }
}
