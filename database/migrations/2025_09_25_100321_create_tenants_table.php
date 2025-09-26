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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->foreignId('house_owner_id')->constrained()->onDelete('cascade');
            $table->foreignId('flat_id')->nullable()->constrained()->onDelete('set null');
            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['house_owner_id', 'is_active']);
            $table->index('flat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
