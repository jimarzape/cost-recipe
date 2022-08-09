@extends('layouts.app')

@section('content')
@php
$status = array(
    0 => 'Pending',
    1 => 'Paid',
    2  => 'Delivered'
);
@endphp
<h1 class="dash-title">Orders</h1>
<a class="btn btn-primary f-right" href="{{route('orders.create')}}">Create</a>
<div class="row">
    <div class="col-md-12">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Status</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Total Items</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($_order as $order)
                <tr>
                    <td>#{{$order->id}}</td>
                    <td>
                        {{$order->customer->name}}
                    </td>
                    <td>
                        {{$status[$order->status]}}
                    </td>
                    <td>{{date('M d, Y', strtotime($order->date_ordered))}}</td>
                    <td>
                        <ul class="">
                            @foreach($order->items as $items)
                            <li>{{$items->recipe->name}} - {{$items->qty}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{route('orders.edit', $order->id)}}"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection