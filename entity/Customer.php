<?php

namespace entity;

class Customer {
    public string $id;
    public string $name;
    public string $since;
    public string $revenue;

    public function __construct(string $id, string $name, string $since, string $revenue) {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
    }

}
