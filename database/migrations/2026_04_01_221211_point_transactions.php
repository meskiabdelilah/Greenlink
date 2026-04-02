<?php

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
        Schema::create('point_transactions', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('deposit_id')
                ->nullable()
                ->constrained('deposits')
                ->nullOnDelete();
            $table->text('description')->nullable();
            $table->decimal('points',8,2);
            $table->enum('type', ['earned', 'spent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_transactions');
    }
};
