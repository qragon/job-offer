<?php
namespace App\Modules\Basket;

use Illuminate\Support\Facades\DB;

class BasketRepository
{
    public function get($productId, $sessionId)
    {
        return DB::table('basket')
            ->select('quantity')
            ->where('product_id', $productId)
            ->where('session_id', $sessionId)
            ->first()
            ->quantity;
    }
    public function getList($sessionId)
    {
        return DB::table('basket', 'b')
            ->join('products as p', 'b.product_id', '=', 'p.id')
            ->select([
                'b.id',
                'b.product_id',
                'b.quantity',
                'p.price as product_price',
                'p.name as product_name'
            ])
            ->where('session_id', $sessionId)
            ->get();
    }

    public function insertOrUpdate($where = [], $data = [])
    {
        $item = DB::table('basket')->where($where)->first();
        if($item) {
            $data['quantity'] += $item->quantity;
        }

        DB::table('basket')->updateOrInsert($where, $data);

        return $data['quantity'];
    }

    public function updateQuantity($sessionId, $productId, $quantity)
    {
        return DB::table('basket')
            ->where('session_id', $sessionId)
            ->where('product_id', $productId)
            ->update(['quantity' => $quantity]);
    }

    public function delete($where = [])
    {
        return DB::table('basket')->where($where)->delete();
    }
}
