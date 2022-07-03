<?php

namespace App\Config;

use App\Exceptions\HttpClientConfigException;

class HTTPClientConfig
{
    /**
     * @return int
     * @throws HttpClientConfigException
     */
    public static function getTimeOut(): int
    {
        $timeOut = config('http-client.timeout');

        if (null === $timeOut) {
            throw new HttpClientConfigException('HttpClient - timeout not found');
        }

        return $timeOut;
    }

    /**
     * @return int
     * @throws HttpClientConfigException
     */
    public static function getRetry(): int
    {
        $retry = config('http-client.retry');

        if (null === $retry) {
            throw new HttpClientConfigException('HttpClient - retry not found');
        }

        return $retry;
    }

}
