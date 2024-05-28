<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $numberOfRecords = 10;

        // Generate and insert dummy data
        for ($i = 0; $i < 10; $i++) {
            Client::create([
               
                'company_name' => 'Company ' . ($i + 1),
                'contact_first_name' => 'John',
                'contact_last_name' => 'Doe',
                'email' => 'email' . $i . '@example.com', // Unique email
                'contact_number' => '1234567890',
            ]);
    }
}
}
