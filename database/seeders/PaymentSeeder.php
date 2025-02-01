<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $payments = [
            ['name' => 'Taylor', 'surname' => 'Otwell', 'amount' => 500, 'date' => '2025-01-01 17:25:52'],
            ['name' => 'Taylor', 'surname' => 'Taylor', 'amount' => 1000, 'date' => '2025-01-02 17:25:52'],
            ['name' => 'Jeffrey', 'surname' => 'Way', 'amount' => 1500, 'date' => '2025-02-01 17:25:52'],
            ['name' => 'Jeffrey', 'surname' => 'Way', 'amount' => 2000, 'date' => '2025-02-02 17:25:52'],
            ['name' => 'Phill', 'surname' => 'Sparks', 'amount' => 2500, 'date' => '2025-03-01 17:25:52'],
            ['name' => 'Phill', 'surname' => 'Sparks', 'amount' => 3000, 'date' => '2025-03-02 17:25:52'],
        ];

        foreach ($payments as $payment) {
            $client = Client::where('name', $payment['name'])
                ->where('surname', $payment['surname'])
                ->first();

            if ($client) {
                Payment::create([
                    'client_id' => $client->id, // Assuming we're using client_id as discussed
                    'amount' => $payment['amount'],
                    'created_at' => $payment['date'],
                    'updated_at' => $payment['date'],
                ]);
            }
        }
    }
}
