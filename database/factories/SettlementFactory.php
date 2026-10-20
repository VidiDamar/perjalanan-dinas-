<?php

namespace Database\Factories;

use App\Models\Settlement;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Settlement>
 */
class SettlementFactory extends Factory
{
    protected $model = Settlement::class;

    public function definition(): array
    {
        $cashAdvance = 1000000;
        $totalExpense = fake()->numberBetween(900000, 1500000);
        $diff = $totalExpense - $cashAdvance;

        return [
            'settlement_number' => 'SET-'.fake()->year().'-'.fake()->unique()->numerify('####'),
            'travel_request_id' => TravelRequest::factory(),
            'user_id' => User::factory(),
            'cash_advance_amount' => $cashAdvance,
            'total_actual_expense' => $totalExpense,
            'difference_amount' => abs($diff),
            'settlement_type' => $diff >= 0 ? 'reimbursement' : 'refund',
            'notes' => 'Laporan pertanggungjawaban dinas selesai.',
            'status' => 'submitted',
        ];
    }
}
