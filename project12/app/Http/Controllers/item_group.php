<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemGroup; // Zorg ervoor dat je het juiste model importeert
use Illuminate\Support\Facades\Log; // Importeer de Log facade

class item_group extends Controller
{
    public function remove($id)
    {
        Log::info('Remove method called with ID: ' . $id); // Log het ID
        $item = ItemGroup::find($id); // Gebruik ItemGroup in plaats van Item

        if ($item) {
            try {
                $item->delete();
            } catch (\Exception $e) {
                Log::error($e);
                return redirect()->route('dashboard')->with('error', 'Error occurred while removing item.');
            }

            return redirect()->route('dashboard')->with('success', 'Item successfully removed.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Item not found.');
        }
    }
}