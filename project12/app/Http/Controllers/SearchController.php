public function search(Request $request)
{
    $query = $request->input('query');

    // Implement your search logic here
    // For example, if you're searching users:
    $users = User::where('name', 'LIKE', "%{$query}%")->get();

    // Then return a view with the results
    return view('search.results', ['users' => $users]);
}

