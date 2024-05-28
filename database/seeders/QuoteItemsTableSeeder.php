<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;
use Carbon\Carbon;

class QuoteSeeder extends Seeder
{
    public function run()
    {
        $quotes = [
            [
                'subtotal' => 1000,
                'discount' => 100,
                'total' => 900,
                'due_date' => Carbon::now()->addDays(30)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subtotal' => 2000,
                'discount' => 200,
                'total' => 1800,
                'due_date' => Carbon::now()->addDays(30)->toDateString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more quotes as needed
        ];

        foreach ($quotes as $quote) {
            Quote::create($quote);
        }
    }
}
