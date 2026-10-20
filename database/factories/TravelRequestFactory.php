<?php

namespace Database\Factories;

use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TravelRequest>
 */
class TravelRequestFactory extends Factory
{
    protected $model = TravelRequest::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('+1 days', '+30 days');
        $duration = fake()->numberBetween(2, 5);
        $endDate = (clone $startDate)->modify("+{$duration} days");

        $transport = fake()->numberBetween(1500000, 3000000);
        $hotel = fake()->numberBetween(500000, 750000) * ($duration - 1);
        $perDiem = 300000 * $duration;
        $other = fake()->numberBetween(100000, 300000);
        $total = $transport + $hotel + $perDiem + $other;

        return [
            'request_number' => 'TRQ-'.fake()->year().'-'.fake()->unique()->numerify('####'),
            'user_id' => User::factory(),
            'purpose' => fake()->randomElement([
                'Client Meeting & System Delivery',
                'Technical Coordination & Server Maintenance',
                'Workshop & IT Certification',
                'Branch Office Infrastructure Audit',
            ]),
            'origin_city' => 'Jakarta (CGK)',
            'destination_city' => fake()->randomElement(['Surabaya (SUB)', 'Bali (DPS)', 'Semarang (SRG)', 'Medan (KNO)', 'Balikpapan (BPN)']),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'duration_days' => $duration,
            'transport_mode' => 'Flight',
            'flight_hotel_preference' => 'Penerbangan pagi Garuda Indonesia / Batik Air, Hotel dekat area tugas.',
            'estimated_transport' => $transport,
            'estimated_hotel' => $hotel,
            'estimated_per_diem' => $perDiem,
            'estimated_other' => $other,
            'total_estimated_budget' => $total,
            'cash_advance_requested' => $perDiem,
            'document_path' => null,
            'document_name' => 'Surat_Tugas_Dinas.pdf',
            'policy_status' => 'in_policy',
            'policy_notes' => 'Sesuai dengan standar plafon Senior Specialist.',
            'status' => 'pending_approval',
            'cash_advance_status' => 'pending',
            'checked_in' => false,
        ];
    }
}
