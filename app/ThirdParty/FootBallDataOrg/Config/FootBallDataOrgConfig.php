<?php

namespace App\ThirdParty\FootBallDataOrg\Config;

use App\Exceptions\FeedConfigException;

class FootBallDataOrgConfig
{
    /**
     * @return string
     * @throws FeedConfigException
     */
    public static function getTimeout(): string
    {
        $timeOut = config('feeds.football_data_org.timeout');

        if (null === $timeOut) {
            throw new FeedConfigException('FootBallDataOrg - timeout not found');
        }

        return $timeOut;
    }

    /**
     * @return string
     * @throws FeedConfigException
     */
    public static function getRetry(): string
    {
        $retry = config('feeds.football_data_org.retry');

        if (null === $retry) {
            throw new FeedConfigException('FootBallDataOrg - retry not found');
        }

        return $retry;
    }

    /**
     * @return string
     * @throws FeedConfigException
     */
    public static function getApiUrl(): string
    {
        $apiUrl = config('feeds.football_data_org.apiUrl');

        if (null === $apiUrl) {
            throw new FeedConfigException('FootBallDataOrg - apiUrl not found');
        }

        return $apiUrl;
    }

    /**
     * @return string
     * @throws FeedConfigException
     */
    public static function getVersion(): string
    {
        $version = config('feeds.football_data_org.version');

        if (null === $version) {
            throw new FeedConfigException('FootBallDataOrg - version not found');
        }

        return $version;
    }

    /**
     * @return array
     * @throws FeedConfigException
     */
    public static function getCredentials(): array
    {
        $version = config('feeds.football_data_org.credentials');

        if (null === $version) {
            throw new FeedConfigException('FootBallDataOrg - credentials not found');
        }

        return $version;
    }

    /**
     * @return string
     * @throws FeedConfigException
     */
    public static function getMatches(): string
    {
        $matches = config('feeds.football_data_org.methods.getMatches');

        if (null === $matches) {
            throw new FeedConfigException('FootBallDataOrg - getMatches not found');
        }

        return $matches;
    }
}
