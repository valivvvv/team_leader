<?php

require_once __DIR__ . '/entity/Customer.php';
require_once __DIR__ . '/entity/Product.php';
require_once __DIR__ . '/entity/Order.php';
require_once __DIR__ . '/entity/OrderItem.php';
require_once __DIR__ . '/entity/DiscountedOrder.php';
require_once __DIR__ . '/repository/CustomerRepository.php';
require_once __DIR__ . '/repository/ProductRepository.php';
require_once __DIR__ . '/service/DiscountsService.php';
require_once __DIR__ . '/service/Discounts/WholeOrderDiscount.php';

use entity\Order;
use service\DiscountsService;

// takes raw data from the request
$jsonRequest = file_get_contents('php://input');
// Converts it into a PHP object
$request = json_decode($jsonRequest, true);

// TODO: validate request; validate all entities
print_r(DiscountsService::getDiscounts(new Order(
    $request['id'],
    $request['customer-id'],
    $request['items'],
    $request['total']
)));

