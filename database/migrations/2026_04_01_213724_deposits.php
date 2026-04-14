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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('citizen_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('agent_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('category_id')
                ->constrained('waste_categories')
                ->cascadeOnDelete();

            $table->text('address');
            $table->string('city');
            
            $table->decimal('estimated_weight', 10, 2)
                ->nullable();
            $table->decimal('actual_weight', 10, 2)
                ->nullable();
            $table->string('photo_path')
                ->nullable();
            $table->enum('status', ['pending', 'assigned', 'collected', 'validated'])->default('pending');


            $table->timestamp('collected_at')
                ->nullable();
            $table->timestamp('validated_at')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
