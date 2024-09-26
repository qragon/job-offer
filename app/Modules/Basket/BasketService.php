<?php
namespace App\Modules\Basket;

use Illuminate\Support\Collection;

class BasketService
{
    public function __construct(private readonly BasketRepository $basketRepository)
    {
    }

    public function get($productId, $sessionId)
    {
        return $this->basketRepository->get($productId, $sessionId);
    }

    public function getList($sessionId): Collection
    {
        return $this->basketRepository
            ->getList($sessionId)
            ->mapInto(BasketStd::class);
    }

    public function add($sessionId, $productId, $quantity)
    {
        return $this->basketRepository->insertOrUpdate(
            [
                'session_id' => $sessionId,
                'product_id' => $productId
            ],
            [
                'quantity' => $quantity,
            ]
        );
    }

    public function delete($sessionId, $productId)
    {
        return $this->basketRepository->delete(
            [
                'session_id' => $sessionId,
                'product_id' => $productId
            ]
        );
    }

    public function countUpdate($productId, $sessionId, $action)
    {
        $count = $this->get($productId, $sessionId);

        $action == 'plus' ? $count++ : $count--;

        if($count <= 0) {
            $this->delete($sessionId, $productId);

            return 0;
        }

        $this->basketRepository->updateQuantity($sessionId, $productId, $count);

        return $count;
    }
}
