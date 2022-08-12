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
        
        $data['sold']       = OrderItem::leftjoin('orders','orders.id','order_items.orders_id')
                                ->whereIn('orders.status', array(1,2))
                                ->select(\DB::raw('sum(order_items.qty) as qty'))
                                ->first();

        $data['revenue']    = Order::whereIn('orders.status', array(1,2))->select(\DB::raw('sum(total_net) as total_net'))->first();

        $data['open']       = OrderItem::leftjoin('orders','orders.id','order_items.orders_id')
                                    ->whereIn('orders.status', array(0))
                                    ->select(\DB::raw('sum(order_items.qty) as open'))
                                    ->first();
        $data['lists']      = Order::whereIn('orders.status', array(1,2))->with('customer','items')->get();

        $data['charts']     = OrderItem::leftjoin('orders','orders.id','order_items.orders_id')
                                        ->leftjoin('recipes','recipes.id','order_items.recipe_id')
                                        ->whereIn('orders.status', array(1,2))
                                        ->select(\DB::raw('sum(order_items.qty) as total'),'recipes.name')
                                        ->groupBy('order_items.recipe_id')
                                        ->get();
                                        
        return view('home', $data);
    }
}
