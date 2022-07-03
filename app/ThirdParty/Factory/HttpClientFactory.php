<?php

namespace App\ThirdParty\Factory;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class HttpClientFactory implements HttpClientFactoryInterface
{
    public function createClient(array $parameters): PendingRequest
    {
        $http = Http::withHeaders($parameters['headers'] ?? [])
            ->retry($parameters['retry'])
            ->timeout($parameters['timeout']);

        if (count($parameters['auth']) > 0) {
            return $http->withBasicAuth($parameters['auth']['username'], $parameters['auth']['password']);
        }

        return $http;
    }
}
