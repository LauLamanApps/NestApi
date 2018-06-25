<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Http\Adapter\Guzzle;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use LauLamanApps\NestApi\Exception\NestApiException;
use LauLamanApps\NestApi\Http\Adapter\Guzzle\Exception\Handler;
use LauLamanApps\NestApi\Http\Adapter\Guzzle\Exception\NotFoundException;
use LauLamanApps\NestApi\Http\Adapter\Guzzle\Exception\RedirectException;
use LauLamanApps\NestApi\Http\ClientInterface;
use LauLamanApps\NestApi\Http\Endpoint\Exception\EndpointCouldNotBeMappedException;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;
use LauLamanApps\NestApi\Http\Exception\ApiCallException;
use Psr\Http\Message\ResponseInterface;

final class Client implements ClientInterface
{
    /**
     * @var GuzzleClientInterface
     */
    private $guzzleClient;

    /**
     * @var MapperInterface
     */
    private $endpointMapper;

    public function __construct(
        GuzzleClientInterface $guzzleClient,
        MapperInterface $urlMapper
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->endpointMapper = $urlMapper;
    }

    /**
     * @throws EndpointCouldNotBeMappedException
     * @throws NestApiException
     * @throws NotFoundException
     */
    public function getEndpoint(string $endpoint, ?array $urlBits = []): ResponseInterface
    {
        return $this->get(
            $this->endpointMapper->map($endpoint, $urlBits)
        );
    }

    /**
     * @throws NestApiException
     * @throws NotFoundException
     * @return ResponseInterface
     */
    public function getUrl(string $url): ResponseInterface
    {
        return $this->get($url);
    }

    public function getJson(ResponseInterface $response): string
    {
        return (string) $response->getBody();
    }

    /**
     * @throws NotFoundException
     * @throws NestApiException
     */
    private function get(string $url, ?array $options = []): ResponseInterface
    {
        try {
            $response = $this->guzzleClient->get($url, $options);

            $this->wasSuccessfulRequest($response);

            return $response;
        } catch (RedirectException $exception) {
            return $this->get($exception->getLocation(), $options);
        } catch (RequestException $exception) {
            Handler::handleRequestException($exception);
        }
    }

    /**
     * @throws NestApiException
     */
    public function putEndpoint(string $endpoint, array $urlBits = null, array $data): ResponseInterface
    {
        return $this->put(
            $this->endpointMapper->map($endpoint, $urlBits),
            ['json' => $data]
        );
    }

    /**
     * @throws ApiCallException
     * @throws NestApiException
     * @throws NotFoundException
     */
    private function put(string $url, ?array $options = []): ResponseInterface
    {
        try {
            $response = $this->guzzleClient->put($url, $options);
            $this->wasSuccessfulRequest($response);

            return $response;
        } catch (RedirectException $exception) {
            return $this->put($exception->getLocation(), $options);
        } catch (RequestException $exception) {
            Handler::handleRequestException($exception);
        }
    }

    /**
     * @throws RedirectException
     * @throws ApiCallException
     */
    private function wasSuccessfulRequest(ResponseInterface $response): void
    {
        switch ($response->getStatusCode()) {
            case 307:
                throw new RedirectException($response->getHeader('Location')[0]);

                break;
            case 200:
                return;

                break;
            default:
                throw new ApiCallException($response-> getStatusCode() . ' ' . $response->getReasonPhrase());
        }
    }
}
