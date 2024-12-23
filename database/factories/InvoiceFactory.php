<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'invoice_date' => fake()->date(),
            'due_date' => fake()->date(),
            'company_name' => fake()->company(),
            'company_address_line_1' => fake()->streetAddress(),
            'company_city' => fake()->city(),
            'company_postcode' => fake()->postcode(),
            'company_vat_number' => 123456,
            'client_name' => fake()->name(),
            'client_address_line_1' => fake()->streetAddress(),
            'client_city' => fake()->city(),
            'client_postcode' => fake()->postcode(),
            'sub_total' => 0,
            'vat_percentage' => 20,
            'total' => 0,
            'user_id'  => 1
        ];
    }
}
