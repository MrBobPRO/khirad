<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        //escape site hack
        $book = Book::find($request->book_id);
        if($book->free) return redirect()->back();

        Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'book_id' => $request->book_id,
            'ip' => $request->ip()
        ]);

        return redirect()->back();
    }


    #-------------------------Webmaster routes start------------------------------
        public function webmaster_index()
        {
            $orders = Order::latest()->paginate(40);
            $allOrders = Order::orderBy('name', 'asc')->select('name', 'id')->get();
            $ordersCount = $allOrders->count();
    
            return view('webmaster.orders.index', compact('orders', 'allOrders', 'ordersCount'));
        }
    
        public function webmaster_single($id)
        {
            $order = Order::find($id);
    
            $order->new = false;
            $order->save();
    
            return view('webmaster.orders.single', compact('order'));
        }
    
        public function webmaster_remove(Request $request)
        {
            Order::find($request->id)->delete();

            return redirect()->route('webmaster.orders.index');
        }
    
    #-------------------------Webmaster routes end------------------------------\
}
