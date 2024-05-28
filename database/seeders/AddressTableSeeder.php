<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientIds = \App\Models\Client::pluck('id')->toArray();

        // Create 10 dummy records
        for ($i = 0; $i < 10; $i++) {
            Address::create([
                'client_id' => $clientIds[array_rand($clientIds)], // Randomly select a client ID
                'postal_code' => '12345',
                'country' => 'Your Country',
                'city' => 'Your City',
                'district' => 'Your District',
                // Add other fields as needed
            ]);
        }
    
    }
}
