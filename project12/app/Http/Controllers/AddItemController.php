<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddItemController extends Controller
{
    public function index()
    {
        return view('additem'); // Assuming 'additem.blade.php' exists in the 'resources/views' directory
    }
}

