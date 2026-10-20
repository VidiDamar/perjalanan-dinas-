<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    /**
     * Display Finance dashboard and financial highlights.
     */
    public function index()
    {
        return view('finance.index');
    }

    /**
     * Display cash advance / uang muka disbursement queue.
     */
    public function cashAdvances()
    {
        return view('finance.cash-advances');
    }

    /**
     * Display settlement and reimbursement list.
     */
    public function settlements()
    {
        return view('finance.settlements');
    }

    /**
     * Display settlement review page with receipt preview and balance calculation.
     */
    public function reviewSettlement(string $id = 'SET-2023-0104')
    {
        return view('finance.settlement-review', ['settlementId' => $id]);
    }

    /**
     * Display financial reporting and accounting export page.
     */
    public function reports()
    {
        return view('finance.reports');
    }
}
