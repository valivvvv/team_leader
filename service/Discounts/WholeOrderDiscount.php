<?php

namespace service\Discounts;

use entity\DiscountedOrder;
use repository\CustomerRepository;

class WholeOrderDiscount
{
    private const REVENUE_THRESHOLD = '1000';

    public static function applyDiscount(DiscountedOrder $discountedOrder): DiscountedOrder
    {
        $customer = CustomerRepository::findById($discountedOrder->order->customerId);

        if ((float)$customer->revenue > (float)self::REVENUE_THRESHOLD) {
            $discountedOrder->applyDiscount(
                $discountedOrder->discountedTotal * 0.9,
                'A customer who has already bought for over € 1000, gets a discount of 10% on the whole order.'
            );
        }

        return $discountedOrder;
    }
}
