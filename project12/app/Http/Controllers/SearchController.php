<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function handleSearch(Request $request)
    {
        $query = $request->input('query');

        // Perform the search
        $results = User::where('column', 'Like', "%{$query}%")->get();

         // Return the results...
         return view('search_results', ['results' => $results]);
         
    }
}
