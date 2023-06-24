<?php

namespace App\Shared\Infrastructure;

use App\Shared\Domain\Entity;
use Illuminate\Support\Collection;

interface HydratesEntity {

    /**
     * Hydrates a database record into an Entity
     */
    public function hydrate(array|Collection $record): Entity;
}