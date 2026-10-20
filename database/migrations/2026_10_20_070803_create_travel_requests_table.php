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
        Schema::create('travel_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique()->index();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Trip Details
            $table->string('purpose');
            $table->string('origin_city')->default('Jakarta (CGK)');
            $table->string('destination_city');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration_days')->default(1);
            $table->string('transport_mode')->default('Flight');
            $table->text('flight_hotel_preference')->nullable();

            // Budgets & Estimates
            $table->decimal('estimated_transport', 14, 2)->default(0);
            $table->decimal('estimated_hotel', 14, 2)->default(0);
            $table->decimal('estimated_per_diem', 14, 2)->default(0);
            $table->decimal('estimated_other', 14, 2)->default(0);
            $table->decimal('total_estimated_budget', 14, 2)->default(0);
            $table->decimal('cash_advance_requested', 14, 2)->default(0);

            // Supporting documents
            $table->string('document_path')->nullable();
            $table->string('document_name')->nullable();

            // Policy & Workflow Status
            $table->string('policy_status')->default('in_policy'); // in_policy, out_of_policy
            $table->text('policy_notes')->nullable();
            $table->string('status')->default('pending_approval'); // draft, pending_approval, approved, revision_required, rejected, ticket_issued, completed
            $table->text('revision_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->foreignId('approver_id')->nullable()->constrained('users')->nullOnDelete();

            // Travel Fulfillment (Ticket & Hotel)
            $table->string('pnr_code')->nullable();
            $table->string('e_ticket_number')->nullable();
            $table->string('flight_departure_info')->nullable();
            $table->string('flight_return_info')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('hotel_room_type')->nullable();
            $table->string('hotel_confirmation_code')->nullable();
            $table->string('ticket_file_path')->nullable();
            $table->string('voucher_file_path')->nullable();
            $table->decimal('actual_ticket_cost', 14, 2)->nullable();
            $table->decimal('actual_hotel_cost', 14, 2)->nullable();

            // Cash Advance Disbursal
            $table->string('cash_advance_status')->default('pending'); // pending, disbursed
            $table->timestamp('cash_advance_disbursed_at')->nullable();
            $table->string('cash_advance_ref')->nullable();

            // Check-in Status
            $table->boolean('checked_in')->default(false);
            $table->string('checkin_location')->nullable();
            $table->timestamp('checkin_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_requests');
    }
};
