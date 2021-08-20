<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'ip' => $request->ip()
        ]);

        return redirect()->back();
    }
}
