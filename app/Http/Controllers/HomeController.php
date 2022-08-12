<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $data['sold']   = OrderItem::leftjoin('orders','orders.id','order_items.orders_id')
                            ->whereIn('orders.status', array(1,2))
                            ->select(\DB::raw('sum(order_items.qty) as qty'))
                            ->first();

        $data['revenue'] = Order::whereIn('orders.status', array(1,2))->select(\DB::raw('sum(total_net) as total_net'))->first();

        $data['open']    = OrderItem::leftjoin('orders','orders.id','order_items.orders_id')
                                    ->whereIn('orders.status', array(0))
                                    ->select(\DB::raw('sum(order_items.qty) as open'))
                                    ->first();
        return view('home', $data);
    }
}
