<?php

namespace Tests\Feature;

use App\Models\Settlement;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFeaturesTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $manager;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a manager (approver) first
        $this->manager = User::factory()->create([
            'name' => 'Budi Manager',
            'email' => 'atasan@test.com',
            'role' => 'atasan',
            'job_level' => 'Manager',
        ]);

        // Create the traveler user
        $this->user = User::factory()->create([
            'name' => 'Ahmad Karyawan',
            'email' => 'user@test.com',
            'role' => 'user',
            'employee_id' => 'EMP-0001',
            'department' => 'Engineering',
            'job_level' => 'Senior Specialist',
            'phone' => '+62 812-0000-0001',
            'bank_name' => 'BCA',
            'bank_account_number' => '1234567890',
            'bank_account_holder' => 'Ahmad Karyawan',
            'manager_id' => $this->manager->id,
        ]);
    }

    // =========================================================================
    // Dashboard
    // =========================================================================

    public function test_dashboard_renders_with_real_user_data(): void
    {
        $response = $this->actingAs($this->user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
    }

    public function test_dashboard_shows_trip_stats_from_database(): void
    {
        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
        ]);

        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending_approval',
        ]);

        $response = $this->actingAs($this->user)->get(route('dashboard'));

        $response->assertStatus(200);
        // Stats card with at least 1 approved trip visible
        $response->assertSee('1');
    }

    // =========================================================================
    // Travel Request — List
    // =========================================================================

    public function test_requests_index_returns_only_user_requests(): void
    {
        $ownTrip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'purpose' => 'Business Trip to Surabaya',
        ]);

        // Another user's trip should not appear
        $otherUser = User::factory()->create(['role' => 'user']);
        TravelRequest::factory()->create([
            'user_id' => $otherUser->id,
            'purpose' => 'Hidden Other User Trip',
        ]);

        $response = $this->actingAs($this->user)->get(route('requests.index'));

        $response->assertStatus(200);
        $response->assertSee('Business Trip to Surabaya');
        $response->assertDontSee('Hidden Other User Trip');
    }

    public function test_requests_index_filters_by_status(): void
    {
        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
            'purpose' => 'Approved Trip Only',
        ]);

        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending_approval',
            'purpose' => 'Pending Trip Hidden',
        ]);

        $response = $this->actingAs($this->user)->get(route('requests.index', ['status' => 'Disetujui']));

        $response->assertStatus(200);
        $response->assertSee('Approved Trip Only');
        $response->assertDontSee('Pending Trip Hidden');
    }

    public function test_requests_index_searches_by_keyword(): void
    {
        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'purpose' => 'Server Migration Bandung',
            'destination_city' => 'Bandung',
        ]);

        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'purpose' => 'Client Meeting Jakarta',
            'destination_city' => 'Jakarta',
        ]);

        $response = $this->actingAs($this->user)->get(route('requests.index', ['search' => 'Bandung']));

        $response->assertStatus(200);
        $response->assertSee('Server Migration Bandung');
        $response->assertDontSee('Client Meeting Jakarta');
    }

    // =========================================================================
    // Travel Request — Create & Store
    // =========================================================================

    public function test_create_travel_request_page_renders(): void
    {
        $response = $this->actingAs($this->user)->get(route('requests.create'));

        $response->assertStatus(200);
        $response->assertSee('Ajukan Perjalanan Dinas');
    }

    public function test_store_travel_request_creates_record_in_database(): void
    {
        $response = $this->actingAs($this->user)->post(route('requests.store'), [
            'purpose' => 'Technical Training Yogyakarta',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Yogyakarta',
            'start_date' => now()->addDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(7)->format('Y-m-d'),
            'transport_mode' => 'Flight',
            'flight_hotel_preference' => 'GA-101 pagi, Hotel Melia',
            'estimated_transport' => 1500000,
            'estimated_hotel' => 900000,
            'estimated_per_diem' => 900000,
            'estimated_other' => 0,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('travel_requests', [
            'user_id' => $this->user->id,
            'purpose' => 'Technical Training Yogyakarta',
            'destination_city' => 'Yogyakarta',
            'status' => 'pending_approval',
        ]);
    }

    public function test_store_travel_request_generates_unique_request_number(): void
    {
        $this->actingAs($this->user)->post(route('requests.store'), [
            'purpose' => 'Test Trip',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Bali',
            'start_date' => now()->addDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(8)->format('Y-m-d'),
            'transport_mode' => 'Flight',
            'estimated_transport' => 2000000,
            'estimated_hotel' => 1000000,
            'estimated_per_diem' => 800000,
            'estimated_other' => 0,
        ]);

        $trip = TravelRequest::where('user_id', $this->user->id)->first();

        $this->assertNotNull($trip);
        $this->assertStringStartsWith('TRQ-', $trip->request_number);
        $this->assertStringContainsString((string) date('Y'), $trip->request_number);
    }

    public function test_store_travel_request_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('requests.store'), []);

        $response->assertSessionHasErrors(['purpose', 'origin_city', 'destination_city', 'start_date', 'end_date', 'transport_mode']);
    }

    public function test_store_travel_request_validates_end_date_after_start_date(): void
    {
        $response = $this->actingAs($this->user)->post(route('requests.store'), [
            'purpose' => 'Test Trip',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Bali',
            'start_date' => now()->addDays(10)->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'), // before start date
            'transport_mode' => 'Flight',
        ]);

        $response->assertSessionHasErrors(['end_date']);
    }

    public function test_store_travel_request_calculates_correct_duration_days(): void
    {
        $this->actingAs($this->user)->post(route('requests.store'), [
            'purpose' => 'Duration Test Trip',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Medan',
            'start_date' => now()->addDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(8)->format('Y-m-d'), // 4 days
            'transport_mode' => 'Flight',
            'estimated_transport' => 2000000,
            'estimated_hotel' => 1000000,
            'estimated_per_diem' => 1200000,
            'estimated_other' => 0,
        ]);

        $trip = TravelRequest::where('purpose', 'Duration Test Trip')->first();

        $this->assertNotNull($trip);
        $this->assertEquals(4, $trip->duration_days);
    }

    // =========================================================================
    // Travel Request — Show
    // =========================================================================

    public function test_show_travel_request_renders_real_record(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'purpose' => 'Infrastructure Audit Surabaya',
            'destination_city' => 'Surabaya',
        ]);

        $response = $this->actingAs($this->user)->get(route('requests.show', $trip->request_number));

        $response->assertStatus(200);
        $response->assertSee('Infrastructure Audit Surabaya');
        $response->assertSee('Surabaya');
    }

    public function test_show_travel_request_returns_404_for_nonexistent_id(): void
    {
        $response = $this->actingAs($this->user)->get(route('requests.show', 'TRQ-9999-9999'));

        $response->assertStatus(404);
    }

    // =========================================================================
    // Check-in
    // =========================================================================

    public function test_checkin_updates_trip_and_user_location(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
            'destination_city' => 'Semarang',
            'checked_in' => false,
        ]);

        $response = $this->actingAs($this->user)->post(route('requests.checkin', $trip->request_number), [
            'location' => 'Kantor Cabang Semarang Pandanaran',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('travel_requests', [
            'id' => $trip->id,
            'checked_in' => true,
            'checkin_location' => 'Kantor Cabang Semarang Pandanaran',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'last_checkin_city' => 'Semarang',
            'last_checkin_location' => 'Kantor Cabang Semarang Pandanaran',
        ]);
    }

    public function test_checkin_defaults_to_destination_city_when_no_location_given(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
            'destination_city' => 'Bandung',
            'checked_in' => false,
        ]);

        $this->actingAs($this->user)->post(route('requests.checkin', $trip->request_number));

        $this->assertDatabaseHas('travel_requests', [
            'id' => $trip->id,
            'checked_in' => true,
            'checkin_location' => 'Bandung',
        ]);
    }

    // =========================================================================
    // Settlements
    // =========================================================================

    public function test_settlements_index_renders(): void
    {
        $response = $this->actingAs($this->user)->get(route('settlements.index'));

        $response->assertStatus(200);
    }

    public function test_settlements_index_shows_user_settlement_history(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'completed',
        ]);

        Settlement::factory()->create([
            'user_id' => $this->user->id,
            'travel_request_id' => $trip->id,
            'settlement_number' => 'SET-2026-TEST1',
        ]);

        $response = $this->actingAs($this->user)->get(route('settlements.index'));

        $response->assertStatus(200);
        $response->assertSee('SET-2026-TEST1');
    }

    public function test_store_settlement_creates_record_and_expense_items(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'completed',
            'cash_advance_requested' => 500000, // advance LESS than actual, so reimbursement
            'approver_id' => $this->manager->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('settlements.store'), [
            'travel_request_id' => $trip->id,
            'notes' => 'Test settlement notes',
            'items' => [
                [
                    'category' => 'Transportasi',
                    'merchant_name' => 'PT Garuda Indonesia',
                    'expense_date' => now()->subDays(2)->format('Y-m-d'),
                    'amount' => 750000,
                    'description' => 'Tiket pesawat pulang pergi',
                ],
                [
                    'category' => 'Konsumsi',
                    'merchant_name' => 'Restoran Padang',
                    'expense_date' => now()->subDay()->format('Y-m-d'),
                    'amount' => 150000,
                    'description' => 'Makan siang koordinasi',
                ],
            ],
        ]);

        $response->assertRedirect(route('settlements.index'));
        $response->assertSessionHas('success');

        $settlement = Settlement::where('travel_request_id', $trip->id)->first();
        $this->assertNotNull($settlement);
        $this->assertEquals(900000, $settlement->total_actual_expense); // 750k + 150k
        $this->assertEquals('reimbursement', $settlement->settlement_type); // 900k actual > 500k advance
        $this->assertEquals(400000, $settlement->difference_amount); // 900k - 500k

        $this->assertDatabaseCount('settlement_expense_items', 2);
    }

    public function test_store_settlement_calculates_refund_when_actual_less_than_advance(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
            'cash_advance_requested' => 2000000, // advance higher than actual spend
            'approver_id' => $this->manager->id,
        ]);

        $this->actingAs($this->user)->post(route('settlements.store'), [
            'travel_request_id' => $trip->id,
            'items' => [
                [
                    'category' => 'Transportasi',
                    'merchant_name' => 'Bus DAMRI',
                    'expense_date' => now()->subDays(2)->format('Y-m-d'),
                    'amount' => 500000,
                    'description' => 'Bus ke airport',
                ],
            ],
        ]);

        $settlement = Settlement::where('travel_request_id', $trip->id)->first();
        $this->assertNotNull($settlement);
        $this->assertEquals('refund', $settlement->settlement_type);
        $this->assertEquals(1500000, $settlement->difference_amount); // 2000000 - 500000
    }

    public function test_store_settlement_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('settlements.store'), []);

        $response->assertSessionHasErrors(['travel_request_id', 'items']);
    }

    public function test_store_settlement_validates_item_fields(): void
    {
        $trip = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'approved',
        ]);

        $response = $this->actingAs($this->user)->post(route('settlements.store'), [
            'travel_request_id' => $trip->id,
            'items' => [
                [
                    'category' => '',       // required
                    'merchant_name' => '',  // required
                    'expense_date' => '',   // required
                    'amount' => 0,          // must be min:1000
                ],
            ],
        ]);

        $response->assertSessionHasErrors([
            'items.0.category',
            'items.0.merchant_name',
            'items.0.expense_date',
            'items.0.amount',
        ]);
    }

    // =========================================================================
    // Settings
    // =========================================================================

    public function test_settings_index_renders_real_user_data(): void
    {
        $response = $this->actingAs($this->user)->get(route('settings.index'));

        $response->assertStatus(200);
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->employee_id);
        $response->assertSee($this->user->department);
    }

    public function test_settings_update_persists_name_and_phone(): void
    {
        $response = $this->actingAs($this->user)->post(route('settings.update'), [
            'name' => 'Ahmad Updated Name',
            'phone' => '+62 812-9999-8888',
            'bank_name' => 'BNI',
            'bank_account_number' => '0987654321',
            'bank_account_holder' => 'Ahmad Updated Name',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Ahmad Updated Name',
            'phone' => '+62 812-9999-8888',
        ]);
    }

    public function test_settings_update_persists_bank_account_details(): void
    {
        $this->actingAs($this->user)->post(route('settings.update'), [
            'name' => $this->user->name,
            'phone' => $this->user->phone,
            'bank_name' => 'Mandiri',
            'bank_account_number' => '1122334455',
            'bank_account_holder' => 'Ahmad Karyawan Mandiri',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'bank_name' => 'Mandiri',
            'bank_account_number' => '1122334455',
            'bank_account_holder' => 'Ahmad Karyawan Mandiri',
        ]);
    }

    public function test_settings_update_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)->post(route('settings.update'), []);

        $response->assertSessionHasErrors(['name', 'bank_name', 'bank_account_number', 'bank_account_holder']);
    }

    // =========================================================================
    // Approval Tracking
    // =========================================================================

    public function test_approvals_index_renders_user_pipeline(): void
    {
        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending_approval',
            'approver_id' => $this->manager->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('approvals.index'));

        $response->assertStatus(200);
    }
}
