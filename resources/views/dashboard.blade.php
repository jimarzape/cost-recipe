@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a class="btn btn-primary f-right" href="{{route('recipe.create')}}">Create</a>
                </div>

                <div class="card-body table-responsive">
                   <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Recipe Name</th>
                                <th>Servings</th>
                                <th>Costs</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($_recipe as $recipe)
                            <tr>
                                <td>{{$recipe->name}}</td>
                                <td class="text-right">{{number_format($recipe->serving_count)}}</td>
                                <td class="text-right"><span class="f-left">₱</span>{{number_format($recipe->total_cost, 2)}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{route('recipe.view', $recipe->id)}}"><i class="fa fa-folder-open-o"></i></a>
                                    <a class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
                <div class="card-footer">
                    {{$_recipe->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
