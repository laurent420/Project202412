namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure the User model is imported

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Perform the search query on the User model
        $results = User::where('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->get();

        // Return the search results view with the results
        return view('search-results', ['results' => $results, 'query' => $query]);
    }
}
