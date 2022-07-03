<?php

namespace App\ThirdParty\Factory;

use Illuminate\Http\Client\PendingRequest;

interface HttpClientFactoryInterface
{
    public function createClient(array $parameters): PendingRequest;
}
