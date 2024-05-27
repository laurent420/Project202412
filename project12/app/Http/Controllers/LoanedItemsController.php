<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class LoanedItemsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $loanedItems = Booking::where('user_id', $user->id)->with('item')->get();

        return view('loaneditems', compact('loanedItems'));
    }
}
