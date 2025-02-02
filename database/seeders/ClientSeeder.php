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
                'created_at' =>'2025-01-01 17:25:52',
                'updated_at' =>'2025-01-01 17:25:52',
            ],
            [
                'name' => 'Taylor',
                'surname' => 'Taylor',
                'created_at' => '2025-01-02 17:25:52',
                'updated_at' => '2025-01-02 17:25:52',
            ],
            [
                'name' => 'Jeffrey',
                'surname' => 'Way',
                'created_at' =>'2025-02-01 17:25:52',
                'updated_at' =>'2025-02-01 17:25:52',
            ],
            [
                'name' => 'Jeffrey',
                'surname' => 'Way',
                'created_at' =>'2025-02-02 17:25:52',
                'updated_at' =>'2025-02-02 17:25:52',
            ],
            [
                'name' => 'Phill',
                'surname' => 'Sparks',
                'created_at' =>'2025-03-01 17:25:52',
                'updated_at' =>'2025-03-02 17:25:52',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
