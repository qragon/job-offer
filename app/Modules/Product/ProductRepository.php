<?php
namespace App\Modules\Product;

use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getList()
    {
        return DB::table('products')
            ->select(['*'])
            ->get();
    }

    public function check($id)
    {
        return DB::table('products')
            ->where('id', $id)
            ->exists();
    }
}
