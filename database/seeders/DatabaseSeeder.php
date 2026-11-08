<?php

namespace Database\Seeders;

use App\Models\ApprovalDelegation;
use App\Models\AuditLog;
use App\Models\Settlement;
use App\Models\SettlementExpenseItem;
use App\Models\TravelPolicy;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Seed Travel Policies Matrix
        $policies = [
            [
                'job_level' => 'Staff',
                'grade_label' => 'Grade 1 · Pelaksana Operasional',
                'hotel_limit' => 500000,
                'per_diem_limit' => 250000,
                'flight_class' => 'Ekonomi (Non-Fleksi)',
                'train_class' => 'Eksekutif',
                'director_threshold' => 10000000,
                'sla_hours' => 48,
                'enforcement_mode' => 'warn_justify',
            ],
            [
                'job_level' => 'Senior Specialist',
                'grade_label' => 'Grade 2 · Senior Specialist & Officer',
                'hotel_limit' => 750000,
                'per_diem_limit' => 300000,
                'flight_class' => 'Ekonomi (Garuda / Batik)',
                'train_class' => 'Eksekutif',
                'director_threshold' => 10000000,
                'sla_hours' => 48,
                'enforcement_mode' => 'warn_justify',
            ],
            [
                'job_level' => 'Manager',
                'grade_label' => 'Grade 3 · Manager & Division Head',
                'hotel_limit' => 1200000,
                'per_diem_limit' => 450000,
                'flight_class' => 'Ekonomi Fleksi',
                'train_class' => 'Eksekutif / Luxury',
                'director_threshold' => 10000000,
                'sla_hours' => 48,
                'enforcement_mode' => 'warn_justify',
            ],
            [
                'job_level' => 'Direktur',
                'grade_label' => 'Grade 4 · Direksi & C-Level Executives',
                'hotel_limit' => 2500000,
                'per_diem_limit' => 800000,
                'flight_class' => 'Bisnis / Eksekutif',
                'train_class' => 'Luxury / Compartment',
                'director_threshold' => 10000000,
                'sla_hours' => 48,
                'enforcement_mode' => 'warn_justify',
            ],
        ];

        foreach ($policies as $policy) {
            TravelPolicy::updateOrCreate(['job_level' => $policy['job_level']], $policy);
        }

        // 0b. Akun Direktur (Approver Level 2)
        $direktur = User::updateOrCreate(
            ['email' => 'direktur@gmail.com'],
            [
                'name' => 'Septianto Raharso',
                'password' => Hash::make('password123'),
                'role' => 'atasan',
                'employee_id' => 'DIR-0002',
                'nik_ktp' => '3174011975040001',
                'birth_date' => '1975-04-12',
                'department' => 'Executive Board',
                'job_level' => 'Direktur',
                'phone' => '+62 811-1000-2000',
                'bank_name' => 'BCA',
                'bank_account_number' => '7001122334',
                'bank_account_holder' => 'Septianto Raharso',
            ]
        );

        // 1. Akun Atasan / Approver (Level 1)
        $atasan = User::updateOrCreate(
            ['email' => 'atasan@gmail.com'],
            [
                'name' => 'Budi Santoso (Atasan)',
                'password' => Hash::make('password123'),
                'role' => 'atasan',
                'employee_id' => 'MGR-0104',
                'nik_ktp' => '3173041983050002',
                'birth_date' => '1983-05-14',
                'department' => 'Engineering & IT Infrastructure',
                'job_level' => 'Manager',
                'phone' => '+62 811-2345-6789',
                'bank_name' => 'BCA',
                'bank_account_number' => '1234567890',
                'bank_account_holder' => 'Budi Santoso',
                'manager_id' => $direktur->id,
            ]
        );

        // 2. Akun Pegawai / User biasa
        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Ahmad Pegawai (Karyawan)',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'employee_id' => 'EMP-0921',
                'nik_ktp' => '3175021990080004',
                'birth_date' => '1990-08-19',
                'department' => 'Engineering & IT Infrastructure',
                'job_level' => 'Senior Specialist',
                'phone' => '+62 812-9876-5432',
                'bank_name' => 'BCA',
                'bank_account_number' => '8920192831',
                'bank_account_holder' => 'Ahmad Pegawai Santoso',
                'manager_id' => $atasan->id,
                'second_approver_id' => $direktur->id,
                'last_checkin_city' => 'Surabaya, Jawa Timur',
                'last_checkin_location' => 'Hotel Santika Premiere Gubeng',
                'last_checkin_at' => now()->subHours(2),
            ]
        );

        // 3. Akun Admin Travel
        User::updateOrCreate(
            ['email' => 'travel@gmail.com'],
            [
                'name' => 'Siti Rahma (Admin Travel)',
                'password' => Hash::make('password123'),
                'role' => 'travel_admin',
                'employee_id' => 'GA-0421',
                'nik_ktp' => '3171061992110008',
                'birth_date' => '1992-11-08',
                'department' => 'General Affairs & Corporate Travel',
                'job_level' => 'Supervisor',
                'phone' => '+62 813-8899-0011',
                'bank_name' => 'Mandiri',
                'bank_account_number' => '137001829910',
                'bank_account_holder' => 'Siti Rahma',
                'manager_id' => $atasan->id,
            ]
        );

        // 4. Akun Tim Keuangan (Finance)
        $finance = User::updateOrCreate(
            ['email' => 'finance@gmail.com'],
            [
                'name' => 'Hendra Wijaya (Tim Keuangan)',
                'password' => Hash::make('password123'),
                'role' => 'finance',
                'employee_id' => 'FIN-0220',
                'nik_ktp' => '3172021988030005',
                'birth_date' => '1988-03-22',
                'department' => 'Finance & Accounting',
                'job_level' => 'Supervisor',
                'phone' => '+62 815-7766-5544',
                'bank_name' => 'BCA',
                'bank_account_number' => '5432109876',
                'bank_account_holder' => 'Hendra Wijaya',
                'manager_id' => $direktur->id,
            ]
        );

        // 5. Akun Super Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'employee_id' => 'ADM-0001',
                'nik_ktp' => '3171011985010001',
                'birth_date' => '1985-01-01',
                'department' => 'IT & Operations Management',
                'job_level' => 'Manager',
                'phone' => '+62 811-9988-7766',
                'bank_name' => 'BCA',
                'bank_account_number' => '9988776655',
                'bank_account_holder' => 'PT Jaya Abadi',
            ]
        );

        // Rekan Manager untuk Delegasi & Karyawan Tambahan untuk Radar
        $rudiManager = User::updateOrCreate(
            ['email' => 'rudi@gmail.com'],
            [
                'name' => 'Rudi Hermawan',
                'password' => Hash::make('password123'),
                'role' => 'atasan',
                'employee_id' => 'MGR-0108',
                'department' => 'Project Operations',
                'job_level' => 'Manager',
                'phone' => '+62 811-3344-5566',
                'bank_name' => 'Mandiri',
                'bank_account_number' => '14000998877',
                'bank_account_holder' => 'Rudi Hermawan',
                'manager_id' => $direktur->id,
            ]
        );

        $dianaManager = User::updateOrCreate(
            ['email' => 'diana@gmail.com'],
            [
                'name' => 'Diana Kartika',
                'password' => Hash::make('password123'),
                'role' => 'atasan',
                'employee_id' => 'MGR-0112',
                'department' => 'Quality Assurance',
                'job_level' => 'Manager',
                'phone' => '+62 812-4455-6677',
                'bank_name' => 'BCA',
                'bank_account_number' => '6677889900',
                'bank_account_holder' => 'Diana Kartika',
                'manager_id' => $direktur->id,
            ]
        );

        $rina = User::updateOrCreate(
            ['email' => 'rina@gmail.com'],
            [
                'name' => 'Rina Melati',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'employee_id' => 'EMP-0810',
                'nik_ktp' => '3273011994070003',
                'birth_date' => '1994-07-11',
                'department' => 'Engineering & IT Infrastructure',
                'job_level' => 'Senior Specialist',
                'phone' => '+62 813-2233-4455',
                'bank_name' => 'Mandiri',
                'bank_account_number' => '137001829910',
                'bank_account_holder' => 'Rina Melati',
                'manager_id' => $atasan->id,
                'second_approver_id' => $direktur->id,
                'last_checkin_city' => 'Bandung, Jawa Barat',
                'last_checkin_location' => 'IDC Data Center Batununggal',
                'last_checkin_at' => now()->subHours(3),
            ]
        );

        // Seed Real Travel Requests for Ahmad Pegawai ($user)
        // SPPD 1: Upcoming & Approved (TRQ-2023-0891)
        TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0891'],
            [
                'user_id' => $user->id,
                'cost_center' => 'CC-101',
                'purpose' => 'Client Meeting & Technical Coordination - TechCorp Infra',
                'origin_city' => 'Jakarta (CGK)',
                'destination_city' => 'Surabaya (SUB)',
                'start_date' => now()->addDays(2)->format('Y-m-d'),
                'end_date' => now()->addDays(4)->format('Y-m-d'),
                'duration_days' => 3,
                'transport_mode' => 'Flight',
                'operator_name' => 'Garuda Indonesia (GA)',
                'flight_hotel_preference' => 'Garuda Indonesia GA-312 pagi. Hotel Santika Premiere Gubeng (Deluxe Room).',
                'estimated_transport' => 2550000,
                'estimated_hotel' => 1300000,
                'estimated_per_diem' => 900000,
                'estimated_other' => 0,
                'total_estimated_budget' => 4750000,
                'cash_advance_requested' => 900000,
                'document_name' => 'Surat_Tugas_TechCorp_Surabaya.pdf',
                'policy_status' => 'in_policy',
                'policy_notes' => 'Plafon biaya transportasi dan akomodasi memenuhi Travel Policy PT Jaya Abadi.',
                'status' => 'approved',
                'approval_date' => now()->subDay(),
                'approver_id' => $atasan->id,
                'pnr_code' => 'GAK78Q',
                'e_ticket_number' => '126-2391029311',
                'flight_departure_info' => 'GA-312 (CGK-SUB) 26 Okt, 08:30 WIB',
                'flight_return_info' => 'GA-319 (SUB-CGK) 28 Okt, 17:00 WIB',
                'hotel_name' => 'Hotel Santika Premiere Gubeng Surabaya',
                'hotel_room_type' => 'Deluxe Room King Bed (Free Breakfast)',
                'hotel_confirmation_code' => 'SNT-SUB-89211',
                'actual_ticket_cost' => 2480000,
                'actual_hotel_cost' => 1250000,
                'cash_advance_status' => 'disbursed',
                'cash_advance_disbursed_at' => now()->subDay(),
                'cash_advance_ref' => 'BCA-TXN-902198301',
                'cash_advance_method' => 'BCA Corporate Direct Transfer',
                'checked_in' => false,
            ]
        );

        // SPPD 2: Pending Approval (TRQ-2023-0902)
        TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0902'],
            [
                'user_id' => $user->id,
                'cost_center' => 'CC-101',
                'purpose' => 'Workshop Cloud Architect & Partner Summit',
                'origin_city' => 'Jakarta (CGK)',
                'destination_city' => 'Bali (DPS)',
                'start_date' => now()->addDays(8)->format('Y-m-d'),
                'end_date' => now()->addDays(11)->format('Y-m-d'),
                'duration_days' => 4,
                'transport_mode' => 'Flight',
                'operator_name' => 'Garuda Indonesia (GA)',
                'flight_hotel_preference' => 'Penerbangan kelas ekonomi siang. Hotel bintang 4 dekat venue summit di Nusa Dua.',
                'estimated_transport' => 3100000,
                'estimated_hotel' => 2550000,
                'estimated_per_diem' => 1200000,
                'estimated_other' => 0,
                'total_estimated_budget' => 6850000,
                'cash_advance_requested' => 1200000,
                'document_name' => 'Undangan_Partner_Summit_Bali.pdf',
                'policy_status' => 'out_of_policy',
                'policy_notes' => 'Catatan: Estimasi hotel per malam melebihi plafon standar senior specialist (justifikasi: high season event summit).',
                'out_of_policy_reason' => 'Lokasi konvensi di Nusa Dua pada masa peak season tidak memiliki hotel rekanan di bawah Rp 750.000/malam.',
                'status' => 'pending_approval',
                'approver_id' => $atasan->id,
            ]
        );

        // SPPD 3: Completed with Settlement (TRQ-2023-0855)
        $trip3 = TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0855'],
            [
                'user_id' => $user->id,
                'cost_center' => 'CC-102',
                'purpose' => 'Implementasi Jaringan & Training Cabang Semarang',
                'origin_city' => 'Jakarta (GMR)',
                'destination_city' => 'Semarang (SRG)',
                'start_date' => now()->subDays(10)->format('Y-m-d'),
                'end_date' => now()->subDays(7)->format('Y-m-d'),
                'duration_days' => 3,
                'transport_mode' => 'Train',
                'operator_name' => 'PT Kereta Api Indonesia (KAI)',
                'estimated_transport' => 800000,
                'estimated_hotel' => 900000,
                'estimated_per_diem' => 900000,
                'estimated_other' => 100000,
                'total_estimated_budget' => 2700000,
                'cash_advance_requested' => 1000000,
                'document_name' => 'Surat_Tugas_Semarang.pdf',
                'status' => 'completed',
                'approval_date' => now()->subDays(12),
                'approver_id' => $atasan->id,
                'pnr_code' => 'KAI992B',
                'e_ticket_number' => 'KAI-88291022',
                'actual_ticket_cost' => 750000,
                'actual_hotel_cost' => 900000,
                'cash_advance_status' => 'disbursed',
                'cash_advance_disbursed_at' => now()->subDays(11),
                'cash_advance_ref' => 'BCA-TXN-88129031',
                'cash_advance_method' => 'BCA Corporate Direct Transfer',
                'checked_in' => true,
                'checkin_location' => 'Kantor Cabang Semarang Trans Jawa',
                'checkin_at' => now()->subDays(10),
            ]
        );

        // SPPD 4: Rina Melati (TRQ-2023-0870) - Approved, pending ticket & cash advance
        TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0870'],
            [
                'user_id' => $rina->id,
                'cost_center' => 'CC-101',
                'purpose' => 'Instalasi Server IDC Bandung',
                'origin_city' => 'Jakarta (GMR)',
                'destination_city' => 'Bandung (BDG)',
                'start_date' => now()->addDays(6)->format('Y-m-d'),
                'end_date' => now()->addDays(7)->format('Y-m-d'),
                'duration_days' => 2,
                'transport_mode' => 'Train',
                'operator_name' => 'PT Kereta Api Indonesia (KAI)',
                'flight_hotel_preference' => 'Kereta Whoosh / Argo Parahyangan. Ibis Styles Bandung (1 Malam).',
                'estimated_transport' => 600000,
                'estimated_hotel' => 700000,
                'estimated_per_diem' => 900000,
                'estimated_other' => 700000,
                'total_estimated_budget' => 2900000,
                'cash_advance_requested' => 900000,
                'document_name' => 'Surat_Tugas_IDC_Bandung.pdf',
                'policy_status' => 'in_policy',
                'policy_notes' => 'Sesuai dengan standar plafon jabatan Senior Specialist.',
                'status' => 'approved',
                'approval_date' => now()->subDays(2),
                'approver_id' => $atasan->id,
                'cash_advance_status' => 'pending',
                'checked_in' => true,
                'checkin_location' => 'IDC Data Center Batununggal',
                'checkin_at' => now()->subHours(3),
            ]
        );

        // Seed Settlement for Trip 3
        $settlement = Settlement::updateOrCreate(
            ['settlement_number' => 'SET-2023-0104'],
            [
                'travel_request_id' => $trip3->id,
                'user_id' => $user->id,
                'cash_advance_amount' => 1000000,
                'total_actual_expense' => 1450000,
                'difference_amount' => 450000,
                'settlement_type' => 'reimbursement',
                'notes' => 'Terdapat biaya BBM kendaraan dinas dan makan malam koordinasi lembur teknisi lokal.',
                'status' => 'submitted',
            ]
        );

        // Seed 4 Expense Items for Settlement
        SettlementExpenseItem::updateOrCreate(
            ['settlement_id' => $settlement->id, 'merchant_name' => 'SPBU Shell MT Haryono Semarang'],
            [
                'expense_date' => now()->subDays(9)->format('Y-m-d'),
                'category' => 'BBM/Tol',
                'amount' => 450000,
                'description' => 'Pengisian BBM V-Power Diesel mobil dinas operasional site.',
                'is_verified' => true,
            ]
        );

        SettlementExpenseItem::updateOrCreate(
            ['settlement_id' => $settlement->id, 'merchant_name' => 'Tol Trans Jawa (Gardu Banyumanik)'],
            [
                'expense_date' => now()->subDays(9)->format('Y-m-d'),
                'category' => 'BBM/Tol',
                'amount' => 380000,
                'description' => 'Tarif jalan tol Trans Jawa rute dinas cabang.',
                'is_verified' => true,
            ]
        );

        SettlementExpenseItem::updateOrCreate(
            ['settlement_id' => $settlement->id, 'merchant_name' => 'Resto Pesta Keboen Semarang'],
            [
                'expense_date' => now()->subDays(8)->format('Y-m-d'),
                'category' => 'Konsumsi',
                'amount' => 420000,
                'description' => 'Makan malam koordinasi penandatanganan serah terima server.',
                'is_verified' => true,
            ]
        );

        SettlementExpenseItem::updateOrCreate(
            ['settlement_id' => $settlement->id, 'merchant_name' => 'Parkir Stasiun & Lokasi Proyek'],
            [
                'expense_date' => now()->subDays(7)->format('Y-m-d'),
                'category' => 'Parkir/Lainnya',
                'amount' => 200000,
                'description' => 'Biaya parkir inap dan retribusi resmi.',
                'is_verified' => true,
            ]
        );

        // Seed Approval Delegations History
        ApprovalDelegation::updateOrCreate(
            ['delegator_id' => $atasan->id, 'delegate_id' => $rudiManager->id, 'start_date' => '2023-08-10'],
            [
                'end_date' => '2023-08-15',
                'reason' => 'Cuti Tahunan',
                'notify_hr' => true,
                'is_active' => false,
                'processed_count' => 4,
            ]
        );

        ApprovalDelegation::updateOrCreate(
            ['delegator_id' => $atasan->id, 'delegate_id' => $dianaManager->id, 'start_date' => '2023-02-02'],
            [
                'end_date' => '2023-02-07',
                'reason' => 'Dinas Luar Negeri (Jepang)',
                'notify_hr' => true,
                'is_active' => false,
                'processed_count' => 6,
            ]
        );

        // Seed Audit Logs
        if (AuditLog::count() === 0) {
            AuditLog::create([
                'user_id' => $atasan->id,
                'actor_name' => 'Budi Santoso',
                'actor_role' => 'Head of Engineering',
                'action' => 'APPROVE_SPPD',
                'target_ref' => 'TRQ-2023-0891',
                'description' => 'Menyetujui SPPD TRQ-2023-0891 (Ahmad Pegawai · Rp 4.750.000)',
                'ip_address' => '192.168.1.45',
                'user_agent' => 'Chrome Win64',
                'status' => 'Success',
            ]);

            AuditLog::create([
                'user_id' => null,
                'actor_name' => 'Siti Rahma',
                'actor_role' => 'Corporate Travel Desk',
                'action' => 'ISSUE_TICKET',
                'target_ref' => 'TRQ-2023-0891',
                'description' => 'Menerbitkan E-Tiket Garuda GA-312 & Voucher Hotel Santika Gubeng (PNR: GAK78Q)',
                'ip_address' => '192.168.1.18',
                'user_agent' => 'Firefox Win64',
                'status' => 'Success',
            ]);

            AuditLog::create([
                'user_id' => $finance->id,
                'actor_name' => 'Hendra Wijaya',
                'actor_role' => 'Finance Supervisor',
                'action' => 'DISBURSE_CASH',
                'target_ref' => 'TRQ-2023-0891',
                'description' => 'Pencairan uang muka Rp 900.000 via BCA Transfer Ref: BCA-TXN-902198301',
                'ip_address' => '192.168.1.22',
                'user_agent' => 'Edge Win64',
                'status' => 'Success',
            ]);

            AuditLog::create([
                'user_id' => null,
                'actor_name' => 'Super Administrator',
                'actor_role' => 'System Admin',
                'action' => 'UPDATE_POLICY',
                'target_ref' => 'Grade 2',
                'description' => 'Penyesuaian batas plafon hotel Grade 2 dari Rp 700.000 menjadi Rp 750.000 / malam',
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Chrome Win64',
                'status' => 'Success',
            ]);
        }
    }
}
