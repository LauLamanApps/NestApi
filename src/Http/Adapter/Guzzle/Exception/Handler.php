<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Adapter\Guzzle\Exception;

use GuzzleHttp\Exception\RequestException;
use LauLamanApps\NestApi\Exception\NestApiException;

final class Handler
{
    /**
     * @throws NestApiException
     * @throws NotFoundException
     */
    public static function handleRequestException(RequestException $exception): void
    {
        switch ($exception->getCode()) {
            case 404:
                throw new NotFoundException();
        }

        throw new NestApiException($exception->getMessage());
    }
}
