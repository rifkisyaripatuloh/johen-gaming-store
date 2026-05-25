<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('invoice')->unique();

            $table->decimal('total_price', 12, 2);

            $table->string('voucher_code')->nullable();

            $table->decimal('discount', 12, 2)->default(0);

            $table->decimal('final_price', 12, 2);

            $table->string('customer_name');

            $table->string('customer_phone');

            $table->string('game_user_id')->nullable();

            $table->string('server_id')->nullable();

            $table->text('notes')->nullable();

            $table->enum('status', [
                'pending',
                'paid',
                'success',
                'cancelled'
            ])->default('pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};