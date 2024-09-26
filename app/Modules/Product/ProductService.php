<?php
namespace App\Modules\Product;

use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function getList(): Collection
    {
        return $this->productRepository
            ->getList()
            ->mapInto(ProductStd::class);
    }

    public function check(int $id): bool
    {
        return $this->productRepository->check($id);
    }
}
