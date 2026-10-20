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
            $table->string('employee_id')->nullable()->after('email');
            $table->string('department')->nullable()->after('employee_id');
            $table->string('job_level')->default('Senior Specialist')->after('department');
            $table->string('phone')->nullable()->after('job_level');
            $table->string('bank_name')->default('BCA')->after('phone');
            $table->string('bank_account_number')->nullable()->after('bank_name');
            $table->string('bank_account_holder')->nullable()->after('bank_account_number');
            $table->foreignId('manager_id')->nullable()->after('bank_account_holder')->constrained('users')->nullOnDelete();
            $table->string('last_checkin_city')->nullable()->after('manager_id');
            $table->string('last_checkin_location')->nullable()->after('last_checkin_city');
            $table->timestamp('last_checkin_at')->nullable()->after('last_checkin_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['manager_id']);
            $table->dropColumn([
                'employee_id',
                'department',
                'job_level',
                'phone',
                'bank_name',
                'bank_account_number',
                'bank_account_holder',
                'manager_id',
                'last_checkin_city',
                'last_checkin_location',
                'last_checkin_at',
            ]);
        });
    }
};
