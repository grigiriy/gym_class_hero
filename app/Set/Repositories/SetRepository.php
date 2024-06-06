<?php

namespace App\Set\Repositories;

use App\Set\Models\Set;
use App\Set\Repositories\Contracts\SetRepositoryInterface;

class SetRepository implements SetRepositoryInterface
{
    public function find(int $id): ?Set
    {
        return Set::find($id);
    }

    public function create(array $attributes): Set
    {
        return Set::create($attributes);
    }

    public function delete(Set $set): bool
    {
        return $set->delete();
    }
}
