<?php

declare(strict_types=1);

require_once __DIR__ . '/entity/Category.php';
require_once __DIR__ . '/entity/Customer.php';
require_once __DIR__ . '/entity/Product.php';
require_once __DIR__ . '/entity/Order.php';
require_once __DIR__ . '/entity/OrderItem.php';
require_once __DIR__ . '/entity/DiscountedOrder.php';
require_once __DIR__ . '/entity/ValueObjects/Money.php';
require_once __DIR__ . '/entity/ValueObjects/Quantity.php';
require_once __DIR__ . '/repository/CustomerRepository.php';
require_once __DIR__ . '/repository/ProductRepository.php';
require_once __DIR__ . '/service/DiscountsService.php';
require_once __DIR__ . '/service/Discounts/SwitchesDiscount.php';
require_once __DIR__ . '/service/Discounts/ToolsDiscount.php';
require_once __DIR__ . '/service/Discounts/WholeOrderDiscount.php';
require_once __DIR__ . '/validation/OrderValidation.php';
require_once __DIR__ . '/validation/OrderItemValidation.php';

use entity\Order;
use service\DiscountsService;
use validation\OrderValidation;

$jsonRequest = file_get_contents('php://input');
$request = json_decode($jsonRequest, true);

try {
    $request = OrderValidation::validate($request);

    $order = Order::make(
        $request['id'],
        $request['customer-id'],
        $request['items'],
        $request['total']
    );

    $discountedOrder = DiscountsService::getDiscounts($order);
} catch (Exception $exception) {
    header('Content-Type: application/json');
    http_response_code($exception->getCode());
    echo(json_encode(['error' => $exception->getMessage()]));
    exit;
}

header('Content-Type: application/json');
echo(json_encode($discountedOrder->toArray()));


