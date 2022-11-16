<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'ticketGroups' => Ticket::query()->orderBy('date')->get()->groupBy('date'),
        ]);
    }
}
