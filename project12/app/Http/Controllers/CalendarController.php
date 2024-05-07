<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{   
    public function processDate(Request $request)
    {
        $selectedDate = $request->input('selected_date');
        // Handle processing of selected date (e.g., save to database)
        return redirect()->back()->with('success', 'Date processed successfully!');
    } 
}
