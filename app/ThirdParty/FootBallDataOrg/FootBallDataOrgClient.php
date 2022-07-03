<?php

namespace App\ThirdParty\FootBallDataOrg;

use App\Exceptions\FeedConfigException;
use App\ThirdParty\FootBallDataOrg\Config\FootBallDataOrgConfig;
use App\ThirdParty\RestFulInterface;

class FootBallDataOrgClient implements FootBallDataOrgClientInterface
{
    private RestFulInterface $restFull;

    public function __construct(RestFulInterface $restFull)
    {
        $this->restFull = $restFull;
    }

    /**
     * @throws FeedConfigException
     */
    public function matches(): array
    {
        $version = FootBallDataOrgConfig::getVersion();
        $matchesMethod = FootBallDataOrgConfig::getMatches();
        $path = $version . '/' . $matchesMethod;
        $response = $this->restFull->send($path, 'GET');

        return json_decode($response, true) ?? [];
    }
}
