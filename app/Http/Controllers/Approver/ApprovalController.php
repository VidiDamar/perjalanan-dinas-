<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display the Approver dashboard and pending queue.
     */
    public function index()
    {
        return view('approver.index');
    }

    /**
     * Display a specific SPPD request for approval review and policy check.
     */
    public function show(string $id = 'TRQ-2023-0891')
    {
        return view('approver.show', ['requestId' => $id]);
    }

    /**
     * Display approval delegation management view.
     */
    public function delegation()
    {
        return view('approver.delegation');
    }
}
