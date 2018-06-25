<?php

declare(strict_types=1);

namespace LauLamanApps\NestApi\Tests\Unit\Http\Adapter\Guzzle;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use LauLamanApps\NestApi\Exception\NestApiException;
use LauLamanApps\NestApi\Http\Adapter\Guzzle\Client;
use LauLamanApps\NestApi\Http\Endpoint\MapperInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

final class ClientTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @test
     */
    public function getEndpoint(): void
    {
        $endpoint = MapperInterface::STRUCTURES;
        $url = 'http://example.com';

        $urlMapper = $this->getMapper();
        $urlMapper->shouldReceive('map')->once()->with($endpoint, [])->andReturn($url);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andReturn($this->getResponse());

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getEndpoint($endpoint);
    }

    /**
     * @test
     */
    public function getEndpoint_307ShouldRedirect(): void
    {
        $endpoint = MapperInterface::STRUCTURES;
        $url = 'http://example.com';
        $redirectUrl = 'https://www.example.com/redirect';

        $urlMapper = $this->getMapper();

        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->twice()->andReturn(307, 200);
        $response->shouldReceive('getHeader')->with('Location')->once()->andReturn([$redirectUrl]);

        $urlMapper->shouldReceive('map')->once()->with($endpoint, [])->andReturn($url);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andReturn($response);
        $guzzleClient->shouldReceive('get')->once()->with($redirectUrl, [])->andReturn($response);

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getEndpoint($endpoint);
    }

    /**
     * @test
     */
    public function getUrl(): void
    {
        $url = 'http://example.com';
        $urlMapper = $this->getMapper();

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andReturn($this->getResponse());

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getUrl($url);
    }

    /**
     * @test
     */
    public function getUrl_shouldThrowException(): void
    {
        $url = 'http://example.com';
        $urlMapper = $this->getMapper();

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andThrow(Mockery::Mock(RequestException::class));

        $this->expectException(NestApiException::class);

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getUrl($url);
    }

    /**
     * @test
     */
    public function putEndpoint(): void
    {
        $endpoint = MapperInterface::STRUCTURES;
        $url = 'http://example.com';
        $data = ['putData'];

        $urlMapper = $this->getMapper();
        $urlMapper->shouldReceive('map')->once()->with($endpoint, [])->andReturn($url);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('put')->once()->with($url, ['json' => $data])->andReturn($this->getResponse());

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->putEndpoint($endpoint, [], $data);
    }

    /**
     * @test
     */
    public function putEndpoint_307ShouldRedirect(): void
    {
        $endpoint = MapperInterface::STRUCTURES;
        $url = 'http://example.com';
        $redirectUrl = 'https://www.example.com/redirect';
        $data = ['data'];

        $urlMapper = $this->getMapper();

        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->twice()->andReturn(307, 200);
        $response->shouldReceive('getHeader')->with('Location')->once()->andReturn([$redirectUrl]);

        $urlMapper->shouldReceive('map')->once()->with($endpoint, [])->andReturn($url);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('put')->once()->with($url, ['json' => $data])->andReturn($response);
        $guzzleClient->shouldReceive('put')->once()->with($redirectUrl, ['json' => $data])->andReturn($response);

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->putEndpoint($endpoint, [], $data);
    }

    /**
     * @test
     */
    public function putEndpoint_shouldThrowException(): void
    {
        $endpoint = MapperInterface::STRUCTURES;
        $data = ['data'];
        $url = 'http://example.com';

        $urlMapper = $this->getMapper();
        $urlMapper->shouldReceive('map')->once()->with($endpoint, [])->andReturn($url);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('put')->once()->with($url, ['json' => $data])->andThrow(Mockery::Mock(RequestException::class));

        $this->expectException(NestApiException::class);

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->putEndpoint($endpoint, [], $data);
    }

    /**
     * @test
     */
    public function getJson(): void
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getBody')->once()->andReturnSelf();

        $adapter = new Client($this->getGuzzleClient(), $this->getMapper());
        $adapter->getJson($response);
    }

    /**
     * @return MockInterface|GuzzleClientInterface
     */
    private function getGuzzleClient()
    {
        return $guzzleClient = Mockery::mock(GuzzleClientInterface::class);
    }

    /**
     * @return MockInterface|MapperInterface
     */
    private function getMapper()
    {
        return $urlMapper = Mockery::mock(MapperInterface::class);
    }


    /**
     * @return MockInterface|ResponseInterface
     */
    private function getResponse()
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->once()->andReturn(200);

        return $response;
    }
}
