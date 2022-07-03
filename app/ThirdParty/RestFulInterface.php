<?php

namespace App\ThirdParty;

interface RestFulInterface
{
    public function send(string $path, string $method, array $requestParams = []): string;
}
