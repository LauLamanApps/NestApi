<?php

namespace LauLamanApps\NestApi\Http;

use LauLamanApps\NestApi\Http\Exception\ApiCallException;
use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    /**
     * @throws ApiCallException
     */
    public function getEndpoint(string $endpoint, ?array $urlBits = []): ResponseInterface;

    /**
     * @throws ApiCallException
     */
    public function getUrl(string $url): ResponseInterface;

    /**
     * @throws ApiCallException
     */
    public function putEndpoint(string $endpoint, ?array $urlBits = [], array $param);

    public function getJson(ResponseInterface $response): string;
}
