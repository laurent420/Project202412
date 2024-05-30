<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Example in SearchController
public function search(Request $request)
{
    $query = $request->input('query');
    // Perform the search on your database
    // Return the results
}

}
