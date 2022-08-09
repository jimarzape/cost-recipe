@extends('layouts.app')

@section('content')
<h1 class="dash-title">Tables</h1>
<div class="row ">

    <div class="col-md-12 table-responsive">
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Recipe Name</th>
                    <th>Servings</th>
                    <th>Costs</th>
                    <th>SRP (50%)</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($_recipe as $recipe)
                <tr>
                    <td>{{$recipe->name}}</td>
                    <td class="text-right">{{number_format($recipe->serving_count)}}</td>
                    <td class="text-right"><span class="f-left">₱</span>{{number_format($recipe->total_cost, 2)}}</td>
                    <td class="text-right"><span class="f-left">₱</span>{{number_format(($recipe->total_cost * 1.5), 2)}}</td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="{{route('recipe.view', $recipe->id)}}"><i class="fa fa-folder-open-o"></i></a>
                        <a class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{$_recipe->render()}}
    </div>
</div>
@endsection
