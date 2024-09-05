<?php

namespace service;

use entity\DiscountedOrder;
use entity\Order;
use service\Discounts\SwitchesDiscount;
use service\Discounts\WholeOrderDiscount;

class DiscountsService
{

    public static function getDiscounts(Order $order): DiscountedOrder
    {
        $discountedOrder = new DiscountedOrder($order);

        $discountedOrder = SwitchesDiscount::applyDiscount($discountedOrder);
        $discountedOrder = WholeOrderDiscount::applyDiscount($discountedOrder);

        return $discountedOrder;
    }
}
