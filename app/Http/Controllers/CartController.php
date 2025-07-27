<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparePart;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity', 1);

        // Ürün var mı kontrol et
        $product = SparePart::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => $quantity,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cart_count' => count($cart),
        ]);
    }

        // Sepet urunlerini getir (dropdown icin)
        public function items(){
            $cart = session()->get('cart', []);
            return response()->json([
                'cart' => array_values($cart), // array_values: index sifirdan baslasin
                'cart_count' => count($cart),
            ]);

        }

        // Sepetten Urun Cikar
        public function remove(Request $request){
        $id = $request->input('id');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])){
            unset($cart[$id]);
        }

        session(['cart' => $cart]);
        return response()->json([
            'status' => 'success',
            'cart_count' => count($cart),
        ]);


    }

}
