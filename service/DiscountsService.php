<?php

namespace service;

use entity\DiscountedOrder;
use entity\Order;
use service\Discounts\WholeOrderDiscount;

class DiscountsService
{

    public static function getDiscounts(Order $order): DiscountedOrder
    {
        $discountedOrder = new DiscountedOrder($order);

        $discountedOrder = WholeOrderDiscount::applyDiscount($discountedOrder);

        return $discountedOrder;
    }
}
