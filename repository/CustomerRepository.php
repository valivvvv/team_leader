<?php

declare(strict_types=1);

namespace repository;

use entity\Customer;

class CustomerRepository
{
    /**
     * @throws \Exception
     */
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

        if ($foundCustomer === null) {
            throw new \Exception('Customer not found', 404);
        }

        return Customer::make(
            $foundCustomer['id'],
            $foundCustomer['name'],
            $foundCustomer['since'],
            (float)$foundCustomer['revenue']
        );
    }
}
