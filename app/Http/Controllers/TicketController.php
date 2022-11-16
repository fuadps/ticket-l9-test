<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index');
    }

    public function store(Request $request)
    {
        # 1 nov - 3 nov
        $validator = Validator::make($request->all(), [
            'user' => 'required|min:3',
            'guest' => 'nullable', 'min:3',
            'date' => 'required|date|before_or_equal:2022-11-03|after_or_equal:2022-11-01'
        ]);

        $validator->after(function() use($validator, $request) {
            $totalClaimedTicket = Ticket::query()
                ->where('date', $request->input('date'))
                ->count() + 1; // plus 1 with user

            if($request->input('guest'))
                $totalClaimedTicket++;

            $isNotAvailableToClaim = $totalClaimedTicket > 5;

            if ($isNotAvailableToClaim) {
                $validator->errors()->add(
                    'ticket', 'Ticket for this date already been fully claimed!'
                );
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $validator->validated();

        Ticket::create([
            'name' => $input['user'],
            'date' => $input['date'],
            'claimed_at' => now()->toDateString(),
        ]);

        if($request->input('guest')) {
            Ticket::create([
                'name' => $input['guest'],
                'date' => $input['date'],
                'claimed_at' => now(),
                'type' => 'guest',
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Ticket successfully claimed!'
        ]);
    }
}
