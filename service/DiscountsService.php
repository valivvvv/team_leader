<?php

declare(strict_types=1);

namespace service;

use entity\DiscountedOrder;
use entity\Order;
use service\Discounts\SwitchesDiscount;
use service\Discounts\ToolsDiscount;
use service\Discounts\WholeOrderDiscount;

class DiscountsService
{

    public static function getDiscounts(Order $order): DiscountedOrder
    {
        $discountedOrder = DiscountedOrder::fromOrder($order);

        $discountedOrder = SwitchesDiscount::applyDiscount($discountedOrder);
        $discountedOrder = ToolsDiscount::applyDiscount($discountedOrder);
        $discountedOrder = WholeOrderDiscount::applyDiscount($discountedOrder);

        return $discountedOrder;
    }
}
