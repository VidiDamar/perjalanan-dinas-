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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik_ktp')->nullable()->after('employee_id');
            $table->date('birth_date')->nullable()->after('nik_ktp');
            $table->foreignId('second_approver_id')->nullable()->after('manager_id')->constrained('users')->nullOnDelete();
            $table->boolean('is_active')->default(true)->after('last_checkin_at');
        });

        Schema::table('travel_requests', function (Blueprint $table) {
            $table->string('cost_center')->default('CC-101')->after('user_id');
            $table->string('operator_name')->nullable()->after('transport_mode');
            $table->text('out_of_policy_reason')->nullable()->after('policy_notes');
            $table->text('approval_notes')->nullable()->after('rejection_reason');
            $table->integer('current_approval_level')->default(1)->after('approver_id');
            $table->integer('required_approval_level')->default(1)->after('current_approval_level');
            $table->string('cash_advance_method')->nullable()->after('cash_advance_ref');
            $table->string('cash_advance_proof')->nullable()->after('cash_advance_method');
        });

        Schema::table('settlements', function (Blueprint $table) {
            $table->string('payment_ref')->nullable()->after('finance_notes');
            $table->timestamp('paid_at')->nullable()->after('verified_at');
        });

        Schema::create('travel_policies', function (Blueprint $table) {
            $table->id();
            $table->string('job_level')->unique();
            $table->string('grade_label');
            $table->decimal('hotel_limit', 14, 2)->default(750000);
            $table->decimal('per_diem_limit', 14, 2)->default(300000);
            $table->string('flight_class')->default('Ekonomi');
            $table->string('train_class')->default('Eksekutif');
            $table->decimal('director_threshold', 14, 2)->default(10000000);
            $table->integer('sla_hours')->default(48);
            $table->string('enforcement_mode')->default('warn_justify');
            $table->timestamps();
        });

        Schema::create('approval_delegations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('delegate_id')->constrained('users')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->boolean('notify_hr')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('processed_count')->default(0);
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('actor_name');
            $table->string('actor_role');
            $table->string('action')->index();
            $table->string('target_ref')->nullable()->index();
            $table->text('description');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('status')->default('Success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('approval_delegations');
        Schema::dropIfExists('travel_policies');

        Schema::table('settlements', function (Blueprint $table) {
            $table->dropColumn(['payment_ref', 'paid_at']);
        });

        Schema::table('travel_requests', function (Blueprint $table) {
            $table->dropColumn([
                'cost_center',
                'operator_name',
                'out_of_policy_reason',
                'approval_notes',
                'current_approval_level',
                'required_approval_level',
                'cash_advance_method',
                'cash_advance_proof',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['second_approver_id']);
            $table->dropColumn(['nik_ktp', 'birth_date', 'second_approver_id', 'is_active']);
        });
    }
};
