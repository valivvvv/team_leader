<?php

class Customer {
    public int $id;
    public string $name;
    public string $since;
    public float $revenue;

    public function __construct(int $id, string $name, string $since, float $revenue) {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
    }

}
