<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display Super Admin executive overview and traveler check-in radar.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Display employee master data and approval structure management.
     */
    public function users()
    {
        return view('admin.users');
    }

    /**
     * Display travel policy rules and cost ceiling matrix.
     */
    public function policies()
    {
        return view('admin.policies');
    }

    /**
     * Display system audit logs and activity trail.
     */
    public function auditLogs()
    {
        return view('admin.audit-logs');
    }
}
