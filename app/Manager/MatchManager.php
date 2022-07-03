<?php

namespace App\Manager;

use App\Models\Matche;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MatchManager implements MatchManagerInterface
{
    public function getAll(?int $paginate = null): Collection|LengthAwarePaginator|array
    {
        return null !== $paginate
            ? Matche::query()->paginate($paginate)
            : Matche::query()->get();
    }

    public function create(array $condition, array $data): ?Matche
    {
        /** @var Matche $match */
        $match = Matche::query()->firstOrCreate($condition, $data);

        return $match;
    }

    public function createMultiple(array $data): int
    {
        return Matche::query()->upsert(
            $data,
            ['id'],
            ['area', 'competition', 'season', 'homeTeam', 'awayTeam', 'score', 'status']);
    }
}
