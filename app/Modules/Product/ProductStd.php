<?php
namespace App\Modules\Product;

use App\Core\StdCommon;

class ProductStd extends StdCommon
{
    public function getId(): int
    {
        return $this->id ?? 0;
    }

    public function getName(): string
    {
        return $this->name ?? '';
    }

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function getPrice(): float
    {
        return $this->price ?? 0;
    }

    public function getImage(): ?string
    {
        return $this->image ?? null;
    }
}
