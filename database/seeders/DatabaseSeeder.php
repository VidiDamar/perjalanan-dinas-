<?php

namespace Database\Seeders;

use App\Models\Settlement;
use App\Models\SettlementExpenseItem;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Atasan / Approver
        $atasan = User::updateOrCreate(
            ['email' => 'atasan@gmail.com'],
            [
                'name' => 'Budi Santoso (Atasan)',
                'password' => Hash::make('password123'),
                'role' => 'atasan',
                'employee_id' => 'MGR-0104',
                'department' => 'Engineering & IT Infrastructure',
                'job_level' => 'Manager',
                'phone' => '+62 811-2345-6789',
                'bank_name' => 'BCA',
                'bank_account_number' => '1234567890',
                'bank_account_holder' => 'Budi Santoso',
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
                'department' => 'Engineering & IT Infrastructure',
                'job_level' => 'Senior Specialist',
                'phone' => '+62 812-9876-5432',
                'bank_name' => 'BCA',
                'bank_account_number' => '8920192831',
                'bank_account_holder' => 'Ahmad Pegawai Santoso',
                'manager_id' => $atasan->id,
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
                'department' => 'General Affairs & Corporate Travel',
                'job_level' => 'Supervisor',
                'phone' => '+62 813-8899-0011',
                'bank_name' => 'Mandiri',
                'bank_account_number' => '137001829910',
                'bank_account_holder' => 'Siti Rahma',
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
                'department' => 'Finance & Accounting',
                'job_level' => 'Supervisor',
                'phone' => '+62 815-7766-5544',
                'bank_name' => 'BCA',
                'bank_account_number' => '5432109876',
                'bank_account_holder' => 'Hendra Wijaya',
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
                'department' => 'IT & Operations Management',
                'job_level' => 'Manager',
                'phone' => '+62 811-9988-7766',
                'bank_name' => 'BCA',
                'bank_account_number' => '9988776655',
                'bank_account_holder' => 'PT Jaya Abadi',
            ]
        );

        // Seed Real Travel Requests for Ahmad Pegawai ($user)
        // SPPD 1: Upcoming & Approved (TRQ-2023-0891)
        $trip1 = TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0891'],
            [
                'user_id' => $user->id,
                'purpose' => 'Client Meeting & Technical Coordination - TechCorp Infra',
                'origin_city' => 'Jakarta (CGK)',
                'destination_city' => 'Surabaya (SUB)',
                'start_date' => now()->addDays(2)->format('Y-m-d'),
                'end_date' => now()->addDays(4)->format('Y-m-d'),
                'duration_days' => 3,
                'transport_mode' => 'Flight',
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
                'checked_in' => false,
            ]
        );

        // SPPD 2: Pending Approval (TRQ-2023-0902)
        TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0902'],
            [
                'user_id' => $user->id,
                'purpose' => 'Workshop Cloud Architect & Partner Summit',
                'origin_city' => 'Jakarta (CGK)',
                'destination_city' => 'Bali (DPS)',
                'start_date' => now()->addDays(8)->format('Y-m-d'),
                'end_date' => now()->addDays(11)->format('Y-m-d'),
                'duration_days' => 4,
                'transport_mode' => 'Flight',
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
                'status' => 'pending_approval',
                'approver_id' => $atasan->id,
            ]
        );

        // SPPD 3: Completed with Settlement (TRQ-2023-0855)
        $trip3 = TravelRequest::updateOrCreate(
            ['request_number' => 'TRQ-2023-0855'],
            [
                'user_id' => $user->id,
                'purpose' => 'Implementasi Jaringan & Training Cabang Semarang',
                'origin_city' => 'Jakarta (GMR)',
                'destination_city' => 'Semarang (SRG)',
                'start_date' => now()->subDays(10)->format('Y-m-d'),
                'end_date' => now()->subDays(7)->format('Y-m-d'),
                'duration_days' => 3,
                'transport_mode' => 'Train',
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
                'cash_advance_status' => 'disbursed',
                'cash_advance_disbursed_at' => now()->subDays(11),
                'cash_advance_ref' => 'BCA-TXN-88129031',
                'checked_in' => true,
                'checkin_location' => 'Kantor Cabang Semarang Trans Jawa',
                'checkin_at' => now()->subDays(10),
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
    }
}
