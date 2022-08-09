@extends('layouts.app')

@section('content')
<h1 class="dash-title">Edit Customer</h1>
<form class="row justify-content-center" method="POST" action="{{route('customers.update', $customer->id)}}">
    @csrf
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="name" value="{{$customer->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" name="number" value="{{$customer->number}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Customer Birthday</label>
                    <input type="date" name="bday" value="{{$customer->bday}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Customer Address</label>
                    <textarea class="form-control" name="address" rows="3">{{$customer->address}}</textarea>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="remarks" rows="3">{{$customer->remarks}}</textarea>
                </div>
                <div class="form-group text-right">
                    <a href="{{route('customers')}}" class="btn btn-secondary">Cancel</a>
                    <button class="btn btn-primary">Save</button>
                </div>
                
            <div>
        </div>
    </div>
</form>
@endsection