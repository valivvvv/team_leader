<?php

namespace repository;

use entity\Customer;

class CustomerRepository
{
    public static function findById(string $id): Customer
    {
        $json = file_get_contents(__DIR__ . '/../data/customers.json');
        $customers = json_decode($json, true);

        $foundCustomer = null;

        foreach ($customers as $customer) {
            if ($customer['id'] === $id) {
                $foundCustomer = $customer;
                break;
            }
        }

        // TODO: handle not found customer

        return Customer::make(
            $foundCustomer['id'],
            $foundCustomer['name'],
            $foundCustomer['since'],
            $foundCustomer['revenue']
        );
    }
}
