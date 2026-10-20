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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('settlement_number')->unique()->index();
            $table->foreignId('travel_request_id')->constrained('travel_requests')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->decimal('cash_advance_amount', 14, 2)->default(0);
            $table->decimal('total_actual_expense', 14, 2)->default(0);
            $table->decimal('difference_amount', 14, 2)->default(0);
            $table->string('settlement_type')->default('reimbursement'); // reimbursement, refund, balanced
            $table->string('refund_transfer_proof')->nullable();
            $table->text('notes')->nullable();

            $table->string('status')->default('submitted'); // draft, submitted, verified, paid, rejected
            $table->text('finance_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settlements');
    }
};
