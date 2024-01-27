<?php

namespace App\Infrastructure\Queries;

// TODO: Add tests
class QueryParameters {
    
    private array $parameters = [];

    public function add(string $name, mixed $value): self
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    public function has(string $name): bool
    {
        return isset($this->parameters[$name]);
    }

    public function get(string $name): mixed
    {
        // TODO: Handle case where key is not defined in array
        return $this->parameters[$name];
    }
}