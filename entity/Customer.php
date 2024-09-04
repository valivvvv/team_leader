<?php

namespace entity;

class Customer {
    private string $id;
    private string $name;
    private string $since;
    private string $revenue;

    public function __construct(string $id, string $name, string $since, string $revenue) {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
    }

    public function getRevenue(): string
    {
        return $this->revenue;
    }
}
