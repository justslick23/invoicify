<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           // Create dummy product data
           Product::create([
            'name' => 'Product 1',
            'description' => 'Description for Product 1',
            'price' => 10.99,
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description for Product 2',
            'price' => 19.99,
        ]);

        Product::create([
            'name' => 'Product 3',
            'description' => 'Description for Product 3',
            'price' => 15.99,
        ]);

        // Add more products
        Product::create([
            'name' => 'Product 4',
            'description' => 'Description for Product 4',
            'price' => 12.99,
        ]);

        Product::create([
            'name' => 'Product 5',
            'description' => 'Description for Product 5',
            'price' => 24.99,
        ]);

    }
}
