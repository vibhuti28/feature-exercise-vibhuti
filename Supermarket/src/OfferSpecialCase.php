<?php

namespace Supermarket;

class OfferSpecialCase implements Offer
{
    private $multiDiscountOffer;

    /**
     * OfferSpecialCase constructor
     * @param array $multiDiscountOffer
     */
    public function __construct(array $multiDiscountOffer)
    {
        $this->multiDiscountOffer = $multiDiscountOffer;
    }

    /**
     * Get discount
     * @param float $unitPrice
     * @param float $quantity
     */
    public function getDiscount(float $unitPrice, float $quantity): float
    {
        $discount = 0.0;
        foreach ($this->multiDiscountOffer as $amt => $discountData) {
            $this->amount = $amt;
            $this->price =  $discountData;
            if ($quantity >= $this->amount) {
                $discount += intdiv($quantity, $this->amount) *
                    ($this->price - $this->amount * $unitPrice);
            }
        }
        return $discount;
    }
}
