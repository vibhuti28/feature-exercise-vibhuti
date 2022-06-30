<?php

namespace Supermarket;

class Checkout
{
    private $items = [];
    private $catalog;
    private $offers;

    /**
     * Checkout constructor.
     *
     * @param Catalog $catalog
     * @param array $offers
     */
    public function __construct(Catalog $catalog, array $offers)
    {
        $this->catalog = $catalog;
        $this->offers = $offers;
    }

    /**
     * Calculates the total price for the checkout items
     * 
     * return float
     */
    public function getTotalPrice()
    {
        $total = 0.0;
        foreach ($this->items as $sku => $quantity) {
            $total += $this->catalog->getUnitPrice($sku) * $quantity;
            if ($this->hasOffer($sku)) {
                /** @var OfferXForY $offer */
                $offer = $this->offers[$sku];
                $total += $offer->getDiscount($this->catalog->getUnitPrice($sku), $quantity);
            }
        }
        return $total;
    }

    /**
     * Scans the items and add their quantity 
     * 
     * @param string $sku
     */
    public function scanItems(string $sku)
    {
        if (!isset($this->items[$sku])) {
            $this->items[$sku] = 0;
        }
        $this->items[$sku]++;
    }

    /**
     * To check if offer is available for given sku
     * 
     * @param $sku
     * @return bool
     */
    private function hasOffer($sku): bool
    {
        return isset($this->offers[$sku]);
    }
}
