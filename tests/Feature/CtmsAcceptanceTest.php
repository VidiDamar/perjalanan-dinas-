<?php

namespace Tests\Feature;

use App\Models\Settlement;
use App\Models\TravelPolicy;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CtmsAcceptanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_tc01_login_redirects_each_role_to_their_workspace_dashboard(): void
    {
        $roles = [
            'user@gmail.com' => route('dashboard', absolute: false),
            'atasan@gmail.com' => route('approver.dashboard', absolute: false),
            'travel@gmail.com' => route('travel-admin.dashboard', absolute: false),
            'finance@gmail.com' => route('finance.dashboard', absolute: false),
            'admin@gmail.com' => route('admin.dashboard', absolute: false),
        ];

        foreach ($roles as $email => $expectedRedirect) {
            $response = $this->post('/login', [
                'email' => $email,
                'password' => 'password123',
            ]);

            $response->assertRedirect($expectedRedirect);
            $this->post('/logout');
        }
    }

    public function test_tc02_rbac_blocks_unauthorized_role_and_other_users_sppd(): void
    {
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();
        $otherEmployee = User::factory()->create([
            'role' => 'user',
            'job_level' => 'Senior Specialist',
        ]);

        $otherTrip = TravelRequest::create([
            'user_id' => $otherEmployee->id,
            'request_number' => 'TRQ-2026-9999',
            'purpose' => 'Kunjungan Proyek Rahasia',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Medan',
            'start_date' => '2026-11-10',
            'end_date' => '2026-11-12',
            'duration_days' => 3,
            'transport_mode' => 'Pesawat',
            'estimated_transport' => 2000000,
            'estimated_hotel' => 0,
            'estimated_per_diem' => 900000,
            'total_estimated_budget' => 2900000,
            'status' => 'pending_approval',
        ]);

        $this->actingAs($employee)
            ->get(route('admin.policies'))
            ->assertForbidden();

        $this->actingAs($employee)
            ->get(route('finance.dashboard'))
            ->assertForbidden();

        $this->actingAs($employee)
            ->get(route('requests.show', $otherTrip->request_number))
            ->assertForbidden();
    }

    public function test_tc03_submitting_sppd_without_supporting_document_is_rejected_when_required(): void
    {
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();

        $response = $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Audit Cabang Surabaya',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Surabaya',
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-03',
            'transport_mode' => 'Pesawat',
            'estimated_transport' => 1500000,
            'estimated_hotel' => 1200000,
            'require_document' => '1',
            'action' => 'submit',
        ]);

        $response->assertSessionHasErrors('document');
    }

    public function test_tc04_out_of_policy_hotel_requires_justification_and_flags_request(): void
    {
        Storage::fake('local');
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();

        // 2 nights x Rp 750.000 limit = Rp 1.500.000 max. Submitting Rp 2.200.000 without reason fails:
        $failResponse = $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Kunjungan Klien VIP',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Bali',
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-03',
            'transport_mode' => 'Pesawat',
            'estimated_transport' => 2000000,
            'estimated_hotel' => 2200000,
            'require_justification' => '1',
            'document' => UploadedFile::fake()->create('undangan.pdf', 120, 'application/pdf'),
            'action' => 'submit',
        ]);

        $failResponse->assertSessionHasErrors('out_of_policy_reason');

        // Submitting with justification succeeds and marks policy_status = out_of_policy
        $passResponse = $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Kunjungan Klien VIP',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Bali',
            'start_date' => '2026-11-01',
            'end_date' => '2026-11-03',
            'transport_mode' => 'Pesawat',
            'estimated_transport' => 2000000,
            'estimated_hotel' => 2200000,
            'require_justification' => '1',
            'out_of_policy_reason' => 'Hotel mitra standar penuh karena KTT Internasional.',
            'document' => UploadedFile::fake()->create('undangan.pdf', 120, 'application/pdf'),
            'action' => 'submit',
        ]);

        $trip = TravelRequest::where('purpose', 'Kunjungan Klien VIP')->firstOrFail();
        $passResponse->assertRedirect(route('requests.show', $trip->request_number));
        $this->assertEquals('out_of_policy', $trip->policy_status);
        $this->assertEquals('pending_approval', $trip->status);
    }

    public function test_tc05_and_tc06_approver_can_request_revision_or_reject_sppd(): void
    {
        $approver = User::where('email', 'atasan@gmail.com')->firstOrFail();
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();

        // Request revision on TRQ-2023-0891
        $this->actingAs($approver)->post(route('approver.requests.revision', 'TRQ-2023-0891'), [
            'revision_notes' => 'Mohon pilih maskapai yang lebih ekonomis.',
        ])->assertRedirect(route('approver.dashboard'));

        $this->assertDatabaseHas('travel_requests', [
            'request_number' => 'TRQ-2023-0891',
            'status' => 'revision_required',
            'revision_notes' => 'Mohon pilih maskapai yang lebih ekonomis.',
        ]);

        // Employee resubmits revised request
        $this->actingAs($employee)->put(route('requests.update', 'TRQ-2023-0891'), [
            'purpose' => 'Audit Infrastruktur Server Cabang (Revisi)',
            'destination_city' => 'Surabaya, Jawa Timur',
            'estimated_transport' => 1600000,
            'estimated_hotel' => 1300000,
            'estimated_per_diem' => 900000,
        ])->assertRedirect(route('requests.show', 'TRQ-2023-0891'));

        $this->assertDatabaseHas('travel_requests', [
            'request_number' => 'TRQ-2023-0891',
            'status' => 'pending_approval',
        ]);

        // Reject TRQ-2023-0902
        $this->actingAs($approver)->post(route('approver.requests.reject', 'TRQ-2023-0902'), [
            'rejection_reason' => 'Dapat dilakukan secara daring via Zoom.',
        ])->assertRedirect(route('approver.dashboard'));

        $this->assertDatabaseHas('travel_requests', [
            'request_number' => 'TRQ-2023-0902',
            'status' => 'rejected',
            'rejection_reason' => 'Dapat dilakukan secara daring via Zoom.',
        ]);
    }

    public function test_tc07_multi_level_approval_routes_above_threshold_to_director(): void
    {
        Storage::fake('local');
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();
        $manager = User::where('email', 'atasan@gmail.com')->firstOrFail();
        $director = User::where('email', 'direktur@gmail.com')->firstOrFail();

        // Create SPPD > Rp 10.000.000
        $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Instalasi Data Center Regional',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Balikpapan',
            'start_date' => '2026-11-10',
            'end_date' => '2026-11-14',
            'transport_mode' => 'Pesawat',
            'estimated_transport' => 8500000,
            'estimated_hotel' => 2800000,
            'document' => UploadedFile::fake()->create('spk.pdf', 100, 'application/pdf'),
            'action' => 'submit',
        ]);

        $trip = TravelRequest::where('purpose', 'Instalasi Data Center Regional')->firstOrFail();
        $this->assertEquals(1, $trip->current_approval_level);
        $this->assertEquals(2, $trip->required_approval_level);
        $this->assertEquals($manager->id, $trip->approver_id);

        // Level 1 Manager approves -> escalates to Level 2 Director
        $this->actingAs($manager)->post(route('approver.requests.approve', $trip->request_number));
        $trip->refresh();

        $this->assertEquals('pending_approval', $trip->status);
        $this->assertEquals(2, $trip->current_approval_level);
        $this->assertEquals($director->id, $trip->approver_id);

        // Level 2 Director approves -> final status approved
        $this->actingAs($director)->post(route('approver.requests.approve', $trip->request_number));
        $trip->refresh();

        $this->assertEquals('approved', $trip->status);
    }

    public function test_tc08_active_delegation_routes_new_sppd_to_delegate(): void
    {
        Storage::fake('local');
        $manager = User::where('email', 'atasan@gmail.com')->firstOrFail();
        $delegate = User::where('email', 'rudi@gmail.com')->firstOrFail();
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();

        $this->actingAs($manager)->post(route('approver.delegation.store'), [
            'delegate_id' => $delegate->id,
            'start_date' => now()->subDay()->toDateString(),
            'end_date' => now()->addDays(5)->toDateString(),
            'reason' => 'Dinas Luar Negeri',
        ])->assertRedirect(route('approver.delegation'));

        $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Maintenance Router Cabang',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Yogyakarta',
            'start_date' => '2026-11-15',
            'end_date' => '2026-11-16',
            'transport_mode' => 'Kereta Api',
            'estimated_transport' => 800000,
            'estimated_hotel' => 0,
            'document' => UploadedFile::fake()->create('surat.pdf', 100, 'application/pdf'),
            'action' => 'submit',
        ]);

        $trip = TravelRequest::where('purpose', 'Maintenance Router Cabang')->firstOrFail();
        $this->assertEquals($delegate->id, $trip->approver_id);
    }

    public function test_tc09_travel_admin_cannot_book_unapproved_sppd_and_can_book_approved_sppd(): void
    {
        $travelAdmin = User::where('email', 'travel@gmail.com')->firstOrFail();
        $approver = User::where('email', 'atasan@gmail.com')->firstOrFail();

        // TRQ-2023-0902 is initially pending_approval -> booking attempt must fail
        $this->actingAs($travelAdmin)->post(route('travel-admin.bookings.store', 'TRQ-2023-0902'), [
            'pnr_code' => 'GAX991',
            'operator_name' => 'Garuda Indonesia',
            'actual_ticket_cost' => 2350000,
        ])->assertSessionHasErrors('booking');

        // Approve TRQ-2023-0902 first
        $this->actingAs($approver)->post(route('approver.requests.approve', 'TRQ-2023-0902'));

        // Now Travel Admin issues ticket & hotel voucher
        $this->actingAs($travelAdmin)->post(route('travel-admin.bookings.store', 'TRQ-2023-0902'), [
            'pnr_code' => 'GAK78Q',
            'operator_name' => 'Garuda Indonesia (GA-312)',
            'actual_ticket_cost' => 2350000,
            'hotel_confirmation_code' => 'HTL-9920184',
            'hotel_name' => 'Hotel Santika Premiere Gubeng',
            'actual_hotel_cost' => 1500000,
        ])->assertRedirect(route('travel-admin.dashboard'));

        $this->assertDatabaseHas('travel_requests', [
            'request_number' => 'TRQ-2023-0902',
            'status' => 'ticket_issued',
            'pnr_code' => 'GAK78Q',
        ]);
    }

    public function test_tc10_and_tc11_to_tc14_finance_cash_advance_and_settlement_scenarios(): void
    {
        Storage::fake('local');
        $finance = User::where('email', 'finance@gmail.com')->firstOrFail();
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();

        // TC-10: Disburse cash advance for TRQ-2023-0891
        $this->actingAs($finance)->post(route('finance.cash-advances.disburse', 'TRQ-2023-0891'), [
            'cash_advance_ref' => 'BCA-TXN-2026001',
        ])->assertRedirect(route('finance.cash-advances'));

        $this->assertDatabaseHas('travel_requests', [
            'request_number' => 'TRQ-2023-0891',
            'cash_advance_status' => 'disbursed',
            'cash_advance_ref' => 'BCA-TXN-2026001',
        ]);

        // TC-11: Finance rejects settlement SET-2023-0104
        $this->actingAs($finance)->post(route('finance.settlements.reject', 'SET-2023-0104'), [
            'finance_notes' => 'Struk taksi buram, mohon unggah ulang.',
        ])->assertRedirect(route('finance.settlements'));

        $this->assertDatabaseHas('settlements', [
            'settlement_number' => 'SET-2023-0104',
            'status' => 'rejected',
            'finance_notes' => 'Struk taksi buram, mohon unggah ulang.',
        ]);

        // TC-12: Employee resubmits settlement with Actual (1.150.000) > Cash Advance (600.000 on TRQ-2023-0855) -> Reimbursement (+550.000)
        $trip = TravelRequest::where('request_number', 'TRQ-2023-0855')->firstOrFail();
        $this->actingAs($employee)->post(route('settlements.store'), [
            'travel_request_id' => $trip->id,
            'notes' => 'Perbaikan struk taksi jelas',
            'items' => [
                [
                    'category' => 'Transportasi Lokal',
                    'merchant_name' => 'Bluebird Group',
                    'expense_date' => '2023-10-16',
                    'amount' => 250000,
                ],
                [
                    'category' => 'Uang Makan & Per Diem',
                    'merchant_name' => 'Uang Saku Harian',
                    'expense_date' => '2023-10-16',
                    'amount' => 900000,
                ],
            ],
        ])->assertRedirect(route('settlements.index'));

        $settlement = Settlement::where('settlement_number', 'SET-2023-0104')->firstOrFail();
        $this->assertEquals('submitted', $settlement->status);
        $this->assertEquals('reimbursement', $settlement->settlement_type);

        // TC-13: Settlement with Actual (600.000) < Cash Advance (900.000 on TRQ-2023-0891) -> Refund (-300.000)
        $trip891 = TravelRequest::where('request_number', 'TRQ-2023-0891')->firstOrFail();
        $this->actingAs($employee)->post(route('settlements.store'), [
            'travel_request_id' => $trip891->id,
            'refund_transfer_proof' => 'BCA-REFUND-8891',
            'items' => [
                [
                    'category' => 'Uang Makan & Per Diem',
                    'merchant_name' => 'Konsumsi Lapangan',
                    'expense_date' => '2023-10-25',
                    'amount' => 600000,
                ],
            ],
        ]);

        $refundSettlement = Settlement::where('travel_request_id', $trip891->id)->firstOrFail();
        $this->assertEquals(300000, (float) $refundSettlement->difference_amount);
        $this->assertEquals('refund', $refundSettlement->settlement_type);

        // TC-14: Settlement with Actual == Cash Advance -> Balanced (0)
        $trip902 = TravelRequest::where('request_number', 'TRQ-2023-0902')->firstOrFail();
        $ca902 = (float) $trip902->cash_advance_requested;
        $this->actingAs($employee)->post(route('settlements.store'), [
            'travel_request_id' => $trip902->id,
            'items' => [
                [
                    'category' => 'Uang Makan & Per Diem',
                    'merchant_name' => 'Pengeluaran Sesuai Kasbon',
                    'expense_date' => '2023-10-28',
                    'amount' => $ca902,
                ],
            ],
        ]);

        $balancedSettlement = Settlement::where('travel_request_id', $trip902->id)->firstOrFail();
        $this->assertEquals(0, (float) $balancedSettlement->difference_amount);
        $this->assertEquals('balanced', $balancedSettlement->settlement_type);
    }

    public function test_tc15_private_document_download_checks_authorization(): void
    {
        Storage::fake('local');
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();
        $stranger = User::factory()->create(['role' => 'user']);

        Storage::disk('local')->put('documents/test_doc.pdf', 'PDF-CONTENT');
        $trip = TravelRequest::where('request_number', 'TRQ-2023-0891')->firstOrFail();
        $trip->update(['document_path' => 'documents/test_doc.pdf']);

        $this->actingAs($employee)
            ->get(route('requests.document', $trip->request_number))
            ->assertOk();

        $this->actingAs($stranger)
            ->get(route('requests.document', $trip->request_number))
            ->assertForbidden();
    }

    public function test_tc16_and_tc17_finance_csv_export_and_super_admin_policy_update(): void
    {
        $finance = User::where('email', 'finance@gmail.com')->firstOrFail();
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail();

        // TC-16: Finance CSV export
        $csvResponse = $this->actingAs($finance)->get(route('finance.reports.export'));
        $csvResponse->assertOk();
        $this->assertStringContainsString('text/csv', $csvResponse->headers->get('Content-Type'));

        // TC-17: Super Admin updates Travel Policy
        $this->actingAs($admin)->post(route('admin.policies.update'), [
            'policies' => [
                'Senior Specialist' => [
                    'hotel_limit' => 850000,
                    'per_diem_limit' => 350000,
                    'flight_class' => 'Ekonomi (Garuda / Batik)',
                    'train_class' => 'Eksekutif',
                ],
            ],
            'director_threshold' => 12000000,
            'sla_hours' => 24,
            'enforcement_mode' => 'warn_justify',
        ])->assertRedirect(route('admin.policies'));

        $policy = TravelPolicy::where('job_level', 'Senior Specialist')->firstOrFail();
        $this->assertEquals(850000, (float) $policy->hotel_limit);
        $this->assertEquals(350000, (float) $policy->per_diem_limit);
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'UPDATE_POLICY',
        ]);
    }

    public function test_tc18_end_to_end_happy_path_across_all_5_roles(): void
    {
        Storage::fake('local');
        $employee = User::where('email', 'user@gmail.com')->firstOrFail();
        $approver = User::where('email', 'atasan@gmail.com')->firstOrFail();
        $travelAdmin = User::where('email', 'travel@gmail.com')->firstOrFail();
        $finance = User::where('email', 'finance@gmail.com')->firstOrFail();

        // 1. Employee submits SPPD
        $this->actingAs($employee)->post(route('requests.store'), [
            'purpose' => 'Implementasi Core System Cabang',
            'origin_city' => 'Jakarta',
            'destination_city' => 'Semarang',
            'start_date' => '2026-12-01',
            'end_date' => '2026-12-03',
            'transport_mode' => 'Kereta Api',
            'estimated_transport' => 900000,
            'estimated_hotel' => 1400000,
            'document' => UploadedFile::fake()->create('tugas_semarang.pdf', 100, 'application/pdf'),
            'action' => 'submit',
        ]);

        $trip = TravelRequest::where('purpose', 'Implementasi Core System Cabang')->firstOrFail();
        $this->assertEquals('pending_approval', $trip->status);

        // 2. Approver approves SPPD
        $this->actingAs($approver)->post(route('approver.requests.approve', $trip->request_number));
        $trip->refresh();
        $this->assertEquals('approved', $trip->status);

        // 3. Travel Admin issues ticket & hotel booking
        $this->actingAs($travelAdmin)->post(route('travel-admin.bookings.store', $trip->request_number), [
            'pnr_code' => 'KAI-8812',
            'operator_name' => 'KA Argo Muria',
            'actual_ticket_cost' => 880000,
            'hotel_confirmation_code' => 'VCH-SMG-01',
            'hotel_name' => 'Hotel Padma Semarang',
            'actual_hotel_cost' => 1400000,
        ]);
        $trip->refresh();
        $this->assertEquals('ticket_issued', $trip->status);

        // 4. Finance disburses Cash Advance
        $this->actingAs($finance)->post(route('finance.cash-advances.disburse', $trip->request_number), [
            'cash_advance_ref' => 'BCA-E2E-9988',
        ]);
        $trip->refresh();
        $this->assertEquals('disbursed', $trip->cash_advance_status);

        // 5. Employee performs check-in & submits Settlement
        $this->actingAs($employee)->post(route('requests.checkin', $trip->request_number), [
            'location' => 'Semarang, Jawa Tengah',
        ]);

        $this->actingAs($employee)->post(route('settlements.store'), [
            'travel_request_id' => $trip->id,
            'notes' => 'Selesai implementasi tepat waktu',
            'items' => [
                [
                    'category' => 'Transportasi Lokal',
                    'merchant_name' => 'Taksi Bandara',
                    'expense_date' => '2026-12-01',
                    'amount' => 150000,
                ],
                [
                    'category' => 'Uang Makan & Per Diem',
                    'merchant_name' => 'Konsumsi Harian',
                    'expense_date' => '2026-12-02',
                    'amount' => 950000,
                ],
            ],
        ]);

        $settlement = Settlement::where('travel_request_id', $trip->id)->firstOrFail();
        $this->assertEquals('submitted', $settlement->status);

        // 6. Finance audits & approves Settlement -> Settlement paid & SPPD completed
        $this->actingAs($finance)->post(route('finance.settlements.approve', $settlement->settlement_number));

        $settlement->refresh();
        $trip->refresh();
        $this->assertEquals('paid', $settlement->status);
        $this->assertEquals('completed', $trip->status);
    }
}
