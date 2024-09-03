<?php

namespace repository;

use entity\Customer;

class CustomerRepository
{
    public static function findById(string $id): Customer
    {
        $json = file_get_contents(__DIR__ . '/../data/customers.json');
        $customers = json_decode($json, true);

        $customer = array_filter($customers, static function (array $customer) use ($id) {
            return $customer['id'] === $id;
        })[0]; // TODO: handle not found

        return new Customer(
            $customer['id'],
            $customer['name'],
            $customer['since'],
            $customer['revenue']
        );
    }
}
