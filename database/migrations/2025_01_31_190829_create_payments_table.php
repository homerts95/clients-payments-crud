<?php

use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Payment::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Payment::CLIENT_ID)->constrained('clients')->onDelete('cascade');
            $table->decimal(Payment::AMOUNT, 10);
            $table->timestamps();

            // index for client payments by date
            $table->index([Payment::CLIENT_ID, 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
