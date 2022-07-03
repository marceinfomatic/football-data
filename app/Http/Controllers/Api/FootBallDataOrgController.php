<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\FeedConfigException;
use App\Http\Controllers\Controller;
use App\Manager\MatchManagerInterface;
use App\Models\Matche;
use App\ThirdParty\FootBallDataOrg\FootBallDataOrgClient;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FootBallDataOrgController extends Controller
{
    private MatchManagerInterface $matchManager;
    private FootBallDataOrgClient $footBallDataOrgClient;

    public function __construct(MatchManagerInterface $matchManager, FootBallDataOrgClient $footBallDataOrgClient)
    {
        $this->footBallDataOrgClient = $footBallDataOrgClient;
        $this->matchManager = $matchManager;
    }

    /**
     * @throws FeedConfigException
     */
    public function getMatches(): JsonResponse
    {
        $response = $this->footBallDataOrgClient->matches();

        /** @var array $matches */
        $matches = $response['matches'];

        if (!empty($matches)) {
            $data = [];

            foreach ($matches as $match) {
                $data[] = [
                    'id' => $match['id'],
                    'utcDate' => Carbon::parse($match['utcDate'])->setTimezone('utc')->toDateTime(),
                    'status' => $match['status'],
                    'area' => json_encode($match['area']),
                    'competition' => json_encode($match['competition']),
                    'season' => json_encode($match['season']),
                    'homeTeam' => json_encode($match['homeTeam']),
                    'awayTeam' => json_encode($match['awayTeam']),
                    'score' => json_encode($match['score']),
                ];
            }

            $this->matchManager->createMultiple($data);
        }

        $matches = $this->matchManager->getAll(15);

        return response()->json($matches, Response::HTTP_OK);
    }
}
