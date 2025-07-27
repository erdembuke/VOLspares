<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard(){
        $sparePartCount = \App\Models\SparePart::count();
        $userCount = \App\Models\User::count();
        $orderCount = \App\Models\Order::count(); // EKLE

        return view('admin.dashboard', compact('sparePartCount', 'userCount', 'orderCount'));

    }
}
