<?php

namespace App\Manager;

use App\Models\Matche;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface MatchManagerInterface
{
    public function create(array $condition, array $data): ?Matche;
    public function createMultiple(array $data): int;
    public function getAll(?int $paginate = null): Collection|LengthAwarePaginator|array;
}
