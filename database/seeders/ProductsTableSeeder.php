<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Product #1 | CUP',
                'description' => 'Description of the first product',
                'price' => 100.50,
                'image' => 'product1.jpg',
            ],
            [
                'name' => 'Product #121 | Apple',
                'description' => 'Description of the second product',
                'price' => 200.00,
                'image' => 'product2.jpg',
            ],
            [
                'name' => 'Product #12 | Phone',
                'description' => 'Description of the third product',
                'price' => 300.25,
                'image' => 'product3.jpg',
            ],
            [
                'name' => 'Product #2 | Tablet',
                'description' => 'Description of the fourth product',
                'price' => 400.75,
                'image' => null,
            ],
            [
                'name' => 'Product #1222 | Dress',
                'description' => 'Description of the fifth product',
                'price' => 500.99,
                'image' => 'product5.jpg',
            ],
        ]);
    }
}
