<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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

    public function update(Request $request){
        $request->validate([
            'spare_part_id' => 'required|exists:spareparts,id',
            'action' => 'required|in:increase,decrease'
        ]);
        $sparePartId = $request->input('spare_part_id');
        $action = $request->input('action');
        $cart = session()->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['spare_part_id'] == $sparePartId) {
                if ($action == 'increase') {
                    $item['quantity'] += 1;
                } elseif ($action == 'decrease' && $item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                }
            }
        }
        session(['cart' => $cart]);
        return back();

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

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }

        $total = 0;
        foreach ($cart as $item) {
            $part = \App\Models\SparePart::find($item['spare_part_id']);
            if ($part) {
                $total += $part->price * $item['quantity'];
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'completed'
        ]);

        foreach ($cart as $item) {
            $part = \App\Models\SparePart::find($item['spare_part_id']);
            if ($part) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'spare_part_id' => $part->id,
                    'quantity'      => $item['quantity'],
                    'price'         => $part->price
                ]);
            }
        }

        session()->forget('cart');

        return response()->json(['success' => true]);
    }

}

