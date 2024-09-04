<?php

namespace service;

use entity\Order;
use repository\CustomerRepository;
use repository\ProductRepository;

class DiscountsService
{
    public static function getDiscounts(array $order)
    {
        print_r(new Order(
            $order['id'],
            $order['customer-id'],
            $order['items'],
            $order['total']
        ));

        print_r(CustomerRepository::findById('1'));
        print_r(ProductRepository::findById('A101'));
    }
}
