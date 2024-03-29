<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Recipe;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['_order'] = Order::orderBy('status')->orderBy('date_ordered','asc')->with('customer','items')->paginate(20);
        return view('orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['_recipe'] = Recipe::orderBy('name')->get();
        $data['_customer'] = Customer::orderBy('name')->get();
        return view('orders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order                  = new Order;
        $order->customers_id    = $request->customers_id;
        $order->status          = $request->status;
        $order->remarks         = $request->remarks == null ? '' : $request->remarks;
        $order->date_ordered    = $request->date_ordered;
        $total_sold = 0;
        $total_net  = 0;
        $total_cost = 0;
        $order->save();
        if($request->has('recipe_id'))
        {
            $_recipe = $request->recipe_id;
            $qty = $request->qty;
            foreach($_recipe as $key => $recipe)
            {
            
                $data = Recipe::where('id', $recipe)->first();
                if($data)
                {
                    $sold   =  $data->srp * $qty[$key];
                    $cost   = $data->total_cost * $qty[$key];
                    $net    = $total_sold - $total_net;

                    $total_sold += $sold;
                    $total_net  += $net;
                    $total_cost += $cost;

                    $item               = new OrderItem;
                    $item->orders_id    = $order->id;
                    $item->recipe_id    = $recipe;
                    $item->qty          = $qty[$key];
                    $item->cost         = $data->total_cost;
                    $item->srp          = $data->srp;
                    $item->total_sold   = $sold;
                    $item->total_cost   = $cost;
                    $item->total_net    = $net;
                    $item->save();
                }
                
            }
        }

        $order->total_sold = $total_sold;
        $order->total_net = $total_net;
        $order->total_cost = $total_cost;
        $order->save();

        return redirect()->to(route('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['order'] = Order::where('id', $id)->with('customer','items')->first();
        $data['_recipe'] = Recipe::orderBy('name')->get();
        $data['_customer'] = Customer::orderBy('name')->get();
        return view('orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order                  = new Order;
        $order->exists          = true;
        $order->id              = $id;
        $order->customers_id    = $request->customers_id;
        $order->status          = $request->status;
        $order->remarks         = $request->remarks == null ? '' : $request->remarks;
        $order->date_ordered    = $request->date_ordered;
        $order->save();

        
        $total_sold = 0;
        $total_net  = 0;
        $total_cost = 0;
        $order->save();

        OrderItem::where('orders_id',$id)->delete();
        if($request->has('recipe_id'))
        {
            $_recipe = $request->recipe_id;
            $qty = $request->qty;
            foreach($_recipe as $key => $recipe)
            {
            
                $data = Recipe::where('id', $recipe)->first();
                if($data)
                {
                    $sold   =  $data->srp * $qty[$key];
                    $cost   = $data->total_cost * $qty[$key];
                    $net    = $sold - $cost;

                    $total_sold += $sold;
                    $total_net  += $net;
                    $total_cost += $cost;

                    $item               = new OrderItem;
                    $item->orders_id    = $order->id;
                    $item->recipe_id    = $recipe;
                    $item->qty          = $qty[$key];
                    $item->cost         = $data->total_cost;
                    $item->srp          = $data->srp;
                    $item->total_sold   = $sold;
                    $item->total_cost   = $cost;
                    $item->total_net    = $net;
                    $item->save();
                }
                
            }
        }
        
        $order->total_sold  = $total_sold;
        $order->total_net   = $total_net;
        $order->total_cost  = $total_cost;
        $order->save();

        return redirect()->to(route('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
