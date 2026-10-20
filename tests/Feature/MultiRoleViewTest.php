<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiRoleViewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_approver_views_render_successfully(): void
    {
        $response = $this->get(route('approver.dashboard'));
        $response->assertOk();
        $response->assertSee('Persetujuan Perjalanan Dinas');

        $responseDetail = $this->get(route('approver.requests.show', 'TRQ-2023-0891'));
        $responseDetail->assertOk();
        $responseDetail->assertSee('TRQ-2023-0891');

        $responseDelegation = $this->get(route('approver.delegation'));
        $responseDelegation->assertOk();
        $responseDelegation->assertSee('Delegasi Wewenang');
    }

    public function test_travel_admin_views_render_successfully(): void
    {
        $response = $this->get(route('travel-admin.dashboard'));
        $response->assertOk();
        $response->assertSee('Operasional Travel Desk');

        $responseDetail = $this->get(route('travel-admin.bookings.show', 'TRQ-2023-0891'));
        $responseDetail->assertOk();
        $responseDetail->assertSee('Penerbitan Dokumen Tiket');

        $responseVendors = $this->get(route('travel-admin.vendors'));
        $responseVendors->assertOk();
        $responseVendors->assertSee('Rekapitulasi Kemitraan Vendor');
    }

    public function test_finance_views_render_successfully(): void
    {
        $response = $this->get(route('finance.dashboard'));
        $response->assertOk();
        $response->assertSee('Manajemen Kasbon');

        $responseCash = $this->get(route('finance.cash-advances'));
        $responseCash->assertOk();
        $responseCash->assertSee('Pencairan Uang Muka');

        $responseSettlements = $this->get(route('finance.settlements'));
        $responseSettlements->assertOk();
        $responseSettlements->assertSee('Audit Pertanggungjawaban');

        $responseReview = $this->get(route('finance.settlements.review', 'SET-2023-0104'));
        $responseReview->assertOk();
        $responseReview->assertSee('SET-2023-0104');

        $responseReports = $this->get(route('finance.reports'));
        $responseReports->assertOk();
        $responseReports->assertSee('Laporan Keuangan');
    }

    public function test_admin_views_render_successfully(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertOk();
        $response->assertSee('Executive Dashboard');

        $responseUsers = $this->get(route('admin.users'));
        $responseUsers->assertOk();
        $responseUsers->assertSee('Master Karyawan');

        $responsePolicies = $this->get(route('admin.policies'));
        $responsePolicies->assertOk();
        $responsePolicies->assertSee('Travel Policy Engine');

        $responseLogs = $this->get(route('admin.audit-logs'));
        $responseLogs->assertOk();
        $responseLogs->assertSee('Audit Trail');
    }

    public function test_quick_role_switcher_redirects_and_authenticates(): void
    {
        $response = $this->get(route('switch-role', 'atasan'));
        $response->assertRedirect(route('approver.dashboard'));
        $this->assertAuthenticated();
        $this->assertEquals('atasan', auth()->user()->role);

        $responseFinance = $this->get(route('switch-role', 'finance'));
        $responseFinance->assertRedirect(route('finance.dashboard'));
        $this->assertEquals('finance', auth()->user()->role);
    }
}
