@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" >
            
            <div class="card">
                <div class="card-header">
                    {{ __($recipe->name) }}
                    <a class="f-right" href="{{route('recipe.edit', $recipe->id)}}"><i class="fa fa-pencil"></i></a>
                </div>

                <div class="card-body table-responsive">
                   <div class="row">
                        <div class="col-md-12">
                           <table class="table table-bordered">
                                <tr>
                                    <td width="20%">Servings</td>
                                    <td>{{$recipe->serving_count}}</td>
                                    <td width="10%">Total cost</td>
                                    <td class="text-right"><span class="f-left">₱</span>{{number_format($recipe->total_cost, 2)}}</td>
                                    <td width="15%">Cost per serving</td>
                                    <td class="text-right"><span class="f-left">₱</span>{{number_format(($recipe->total_cost / $recipe->serving_count), 2)}}</td>
                                </tr>
                                <tr>
                                    <td>Description / Instructions</td>
                                    <td colspan="5">{!!nl2br($recipe->description)!!}</td>
                                </tr>
                           </table>
                        </div>
                        <div class="col-md-12 t">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ingredient</th>
                                        <th>Brand (optional)</th>
                                        <th  class="text-center">Cost</th>
                                        <th  class="text-center">Scale</th>
                                        <th width="10%" class="text-center">Times <input class="form-control text-center times-unit" type="number" value="1"></th>
                                    </tr>
                                </thead>
                                <tbody class="tbl-ingredient">
                                    @foreach($recipe->ingredients as $ingredients)
                                    <tr>
                                        <td>
                                            {{$ingredients->name}}
                                        </td>
                                        <td>
                                            {{$ingredients->brand}}
                                        </td>
                                        <td class="text-right">
                                            <span class="f-left">₱</span>{{number_format($ingredients->cost,2)}}
                                        </td>
                                        <td class="text-center">
                                            <span class="unit-reference">{{$ingredients->scale}}</span> {{$ingredients->unit}}
                                        </td>
                                        <td class="text-center">
                                            <span class="unit-times">{{$ingredients->scale}}</span> {{$ingredients->unit}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              
                            </table>
                        </div>
                   </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/create.js?'.time())}}"></script>
@endsection