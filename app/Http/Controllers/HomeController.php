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

        $query
            ->when($request->model,         fn($q) => $q->where('model', $request->model))
            ->when($request->year,          fn($q) => $q->where('year', $request->year))
            ->when($request->category,      fn($q) => $q->where('category', $request->category))
            ->when($request->part_brand,    fn($q) => $q->where('part_brand', $request->part_brand))
            ->when($request->min_price,     fn($q) => $q->where('price', '>=', $request->min_price))
            ->when($request->max_price,     fn($q) => $q->where('price', '<=', $request->max_price));

        $spareParts = $query->orderBy('created_at', 'desc')->get();

        return view('home', compact('spareParts'));
    }
}
