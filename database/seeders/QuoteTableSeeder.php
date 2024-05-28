<?php

// database/seeders/QuoteItemSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuoteItem;
use Carbon\Carbon;

class QuoteItemSeeder extends Seeder
{
    public function run()
    {
        $quoteItems = [
            [
                'quote_id' => 1,
                'product_name' => 'Product 1',
                'quantity' => 2,
                'price' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'quote_id' => 1,
                'product_name' => 'Product 2',
                'quantity' => 1,
                'price' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'quote_id' => 2,
                'product_name' => 'Product 3',
                'quantity' => 4,
                'price' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more quote items as needed
        ];

        foreach ($quoteItems as $item) {
            QuoteItem::create($item);
        }
    }
}
