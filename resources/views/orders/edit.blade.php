@extends('layouts.app')

@section('content')
<h1 class="dash-title">Edit Order</h1>
<form class="row" method="POST" action="{{route('orders.update', $order->id)}}">
    @csrf
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Customer</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Customer</label>
                    <select class="form-control" name="customers_id">
                        <option>Select Customer</option>
                        @foreach($_customer as $customer)
                        <option value="{{$customer->id}}" {{$order->customers_id == $customer->id ? 'selected="selected"' : ''}}>{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Order Date</label>
                    <input type="date" value="{{$order->date_ordered}}" class="form-control" name="date_ordered">
                </div>
                <div class="form-group">
                    <label>Order Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{$order->status == 0 ? 'selected="selected"' : ''}}>Pending</option>
                        <option value="1" {{$order->status == 1 ? 'selected="selected"' : ''}}>Paid</option>
                        <option value="2" {{$order->status == 2 ? 'selected="selected"' : ''}}>Delivered</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" rows="5" name="remarks">{{$order->remarks}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Items</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-item">
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <select class="form-control" name="recipe_id[]" require>
                                    <option value="">Select Item</option>
                                    @foreach($_recipe as $recipe)
                                    <option value="{{$recipe->id}}" {{$item->recipe_id == $recipe->id ? 'selected="selected"' : ''}}>{{$recipe->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" step="any" value="{{$item->qty}}" class="form-control" name="qty[]" require>
                            </td>
                            <td class="text-center">
                                <a class="btn-rm btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <button type="button" class="btn btn-primary btn-sm btn-add"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer text-right">
                <a href="{{route('orders')}}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>  
        </div>
    </div>
</form>
<div class="hide">
    <table >
        <tbody class="item-reference">
        <tr>
            <td>
                <select class="form-control" name="recipe_id[]" require>
                    <option value="">Select Item</option>
                    @foreach($_recipe as $recipe)
                    <option value="{{$recipe->id}}">{{$recipe->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" step="any" value="1" class="form-control" name="qty[]" require>
            </td>
            <td class="text-center">
                <a class="btn-rm btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
            </td>
        </tr>
    </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="{{asset('js/order.js?'.time())}}"></script>
@endsection