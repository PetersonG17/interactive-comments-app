<?php

namespace App\Infrastructure\Queries;

use App\Infrastructure\Queries\DataTransferObjects\DataTransferObject;
use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Query {

    protected Capsule $database;

    public function __construct(Capsule $database)
    {
        $this->database = $database;
    }

    abstract public function execute(QueryParameters $parameters): mixed;
}