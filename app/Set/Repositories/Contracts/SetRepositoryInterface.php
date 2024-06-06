<?php

namespace App\Set\Repositories\Contracts;

use App\Set\Models\Set;

interface SetRepositoryInterface
{
    public function find(int $id): ?Set;
    public function create(array $attributes): Set;
    public function delete(Set $set): bool;
}
