<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming User is the model for users

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('name', 'LIKE', "%$query%")
                       ->orWhere('email', 'LIKE', "%$query%")
                       ->get();

        return view('search', ['query' => $query, 'results' => $results]);
    }
}
