<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Taylor',
                'surname' => 'Otwell',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taylor',
                'surname' => 'Taylor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jeffrey',
                'surname' => 'Way',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phill',
                'surname' => 'Sparks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
