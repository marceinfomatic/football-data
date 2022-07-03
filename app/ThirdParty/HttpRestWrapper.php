<?php

namespace App\ThirdParty;

use App\Config\HTTPClientConfig;
use App\Exceptions\FetchException;
use App\Exceptions\HttpClientConfigException;
use App\ThirdParty\Factory\HttpClientFactoryInterface;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Throwable;

class HttpRestWrapper implements RestFulInterface
{
    private HttpClientFactoryInterface $clientFactory;
    private ?PendingRequest $client = null;
    private ?int $timeoutSeconds;
    private ?int $retry;
    private string $url;
    private array $auth;
    private array $headers;

    public function __construct(
        HttpClientFactoryInterface $clientFactory,
        ?int $timeoutSeconds,
        ?int $retry,
        string $url,
        array $auth = [],
        array $headers = []
    ) {
        $this->clientFactory = $clientFactory;
        $this->timeoutSeconds = $timeoutSeconds;
        $this->retry = $retry;
        $this->url = $url;
        $this->auth = $auth;
        $this->headers = $headers;
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $requestParams
     * @return string
     * @throws FetchException
     */
    public function send(string $path, string $method, array $requestParams = []): string
    {
        try {
            $this->constructClient();
            $response = $this->sendRequest($path, $method, $requestParams);

            return $response->body();
        } catch (Throwable $e) {
            throw new FetchException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $requestParams
     * @return Response
     * @throws Exception
     */
    private function sendRequest(string $path, string $method, array $requestParams): Response
    {
        return $this->client->send(
            $method,
            $this->buildUrl($path),
            [
                'json' => $requestParams,
            ]
        );
    }

    /**
     * @throws HttpClientConfigException
     */
    private function constructClient(): void
    {
        if (null !== $this->client) {
            return;
        }

        $parameters = [
            'timeout' => $this->timeoutSeconds ?? HTTPClientConfig::getTimeOut(),
            'retry' => $this->retry ?? HTTPClientConfig::getRetry(),
            'auth' => $this->auth,
            'headers' => $this->headers,
        ];

        $this->client = $this->clientFactory->createClient($parameters);
    }

    /**
     * @param string $path
     * @return string
     */
    private function buildUrl(string $path): string
    {
        return trim($this->url, '/') . '/' . $path;
    }
}
