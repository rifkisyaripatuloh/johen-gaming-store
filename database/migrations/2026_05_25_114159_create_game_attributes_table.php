<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_attributes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // Nama field
            $table->string('field_name');

            // Jenis input
            $table->enum('field_type', [
                'text',
                'number',
                'select',
                'textarea'
            ])->default('text');

            // Untuk select
            $table->json('options')
                ->nullable();

            // Urutan tampil
            $table->integer('sort_order')
                ->default(0);

            $table->boolean('is_required')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_attributes');
    }
};