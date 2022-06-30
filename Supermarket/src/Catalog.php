<?php

namespace Supermarket;

class Catalog
{
    private $itemsPrices;

    /**
     * Catalog constructor
     * @param array $itemsPrices
     */
    public function __construct(array $itemsPrices)
    {
        // Sets item's default price
        $this->itemsPrices = $itemsPrices;
    }
    
    /**
     * Gets the unit/basic price for the sku
     * @param string $sku
     */
    public function getUnitPrice(string $sku): float
    {
        return ($this->itemsPrices[$sku] ?? 0);
    }
}
