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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_owner_id')->constrained()->onDelete('cascade');
            $table->string('flat_number');
            $table->string('flat_owner_name');
            $table->string('flat_owner_phone')->nullable();
            $table->string('flat_owner_email')->nullable();
            $table->decimal('monthly_rent', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();
            $table->unique(['house_owner_id', 'flat_number']);
            $table->index(['house_owner_id', 'is_occupied']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
