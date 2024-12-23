<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // Seed invoices.
        Invoice::factory(15)->create();

        // Seed statuses.
        $statuses = array(
            0 => array(
                'id' => 1,
                'name' => 'Pending'
            ),
            1 => array(
                'id' => 2,
                'name' => 'Paid'
            ),
            3 => array(
                'id' => 3,
                'name' => 'Discarded'
            ),
        );

        foreach ($statuses as $key => $status) {
            Status::create([
                "id" => $status['id'],
                "name" => $status['name'],
            ]);
        }
    }
}
