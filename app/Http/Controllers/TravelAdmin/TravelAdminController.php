<?php

namespace App\Http\Controllers\TravelAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelAdminController extends Controller
{
    /**
     * Display Travel Admin dashboard and booking queue.
     */
    public function index()
    {
        return view('travel-admin.index');
    }

    /**
     * Display booking and ticketing fulfillment page for a request.
     */
    public function show(string $id = 'TRQ-2023-0891')
    {
        return view('travel-admin.show', ['requestId' => $id]);
    }

    /**
     * Display travel vendor agreements and monthly recap.
     */
    public function vendors()
    {
        return view('travel-admin.vendors');
    }
}
