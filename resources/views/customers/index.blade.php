@extends('layouts.app')

@section('content')
<h1 class="dash-title">Customer</h1>
<a class="btn btn-primary f-right" href="{{route('customers.create')}}">Create</a>
<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Concat</th>
                    <th>Address</th>
                    <th>Remarks</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->number}}</td>
                    <td>{{$customer->address}}</td>
                    <td>{{$customer->remarks}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{route('customers.edit', $customer->id)}}"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection