<?php

namespace Database\Factories;
use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
     
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'contact_first_name' => $this->faker->firstName,
            'contact_last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            // Add more fields as needed
        ];
    }
}
