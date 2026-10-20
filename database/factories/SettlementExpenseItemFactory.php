<?php

namespace Database\Factories;

use App\Models\Settlement;
use App\Models\SettlementExpenseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SettlementExpenseItem>
 */
class SettlementExpenseItemFactory extends Factory
{
    protected $model = SettlementExpenseItem::class;

    public function definition(): array
    {
        return [
            'settlement_id' => Settlement::factory(),
            'expense_date' => fake()->date(),
            'category' => fake()->randomElement(['BBM/Tol', 'Akomodasi', 'Konsumsi', 'Transport Lokal', 'Parkir/Lainnya']),
            'merchant_name' => fake()->company(),
            'amount' => fake()->numberBetween(50000, 500000),
            'description' => fake()->sentence(4),
            'receipt_path' => null,
            'is_verified' => true,
        ];
    }
}
