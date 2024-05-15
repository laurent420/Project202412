// app/Http/Controllers/SearchController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YourModel;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = User::search($query)->get();

        return view('search-results', ['results' => $results, 'query' => $query]);
    }
}

