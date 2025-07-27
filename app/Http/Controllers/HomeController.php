<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Filtre parametreleri
        $query = SparePart::query();

        // (Filtreler burada ileride eklenir.)

        $spareParts = $query->get();

        return view('home', compact('spareParts'));
    }
}
