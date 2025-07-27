<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'spare_part_id' => 'required|exists:spareparts,id'
        ]);
        $sparePartId = $request->input('spare_part_id');
        $cart = session()->get('cart', []);

        // Varsa quantity +1, yoksa ekle
        $found = false;
        foreach ($cart as &$item) {
            if ($item['spare_part_id'] == $sparePartId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $cart[] = ['spare_part_id' => $sparePartId, 'quantity' => 1];
        }
        session(['cart' => $cart]);
        return response()->json(['success' => true]);
    }

    public function show()
    {
        $cart = session('cart', []);
        $items = [];
        foreach ($cart as $item) {
            $part = SparePart::find($item['spare_part_id']);
            if ($part) {
                $items[] = [
                    'spare_part' => $part,
                    'quantity' => $item['quantity'],
                ];
            }
        }
        return view('cart', compact('items'));
    }

    public function remove(Request $request)
    {
        $request->validate([
            'spare_part_id' => 'required|exists:spareparts,id'
        ]);
        $cart = session('cart', []);
        $cart = array_filter($cart, function ($item) use ($request) {
            return $item['spare_part_id'] != $request->input('spare_part_id');
        });
        session(['cart' => array_values($cart)]);
        return back();
    }
}

