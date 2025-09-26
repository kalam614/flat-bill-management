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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_owner_id')->constrained()->onDelete('cascade');
            $table->foreignId('flat_id')->constrained()->onDelete('cascade');
            $table->foreignId('bill_category_id')->constrained()->onDelete('cascade');
            $table->string('bill_month');
            $table->decimal('amount', 10, 2);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['flat_id', 'bill_category_id', 'bill_month']);
            $table->index(['house_owner_id', 'status']);
            $table->index(['flat_id', 'status']);
            $table->index('bill_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
