<?php
namespace App\Modules\Basket;

use App\Core\StdCommon;

class BasketStd extends StdCommon
{
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getProductId(): int
    {
        return $this->product_id ?? 0;
    }

    public function getQuantity(): int
    {
        return $this->quantity ?? 0;
    }

    public function getProductPrice(): ?float
    {
        return $this->product_price ?? null;
    }

    public function getProductName()
    {
        return $this->product_name ?? null;
    }
}
