<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Adapter\Guzzle\Exception;

use LauLamanApps\NestApi\Exception\NestApiException;

final class RedirectException extends NestApiException
{
    /**
     * @var string
     */
    private $location;

    public function __construct(string $location)
    {
        parent::__construct();
        $this->location = $location;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}
