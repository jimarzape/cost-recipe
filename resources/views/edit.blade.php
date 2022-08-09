@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <form class="col-md-12" action="{{route('recipe.update', $recipe->id)}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                {{ __('Edit') }}
            </div>

            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Recipe Title</label>
                            <input type="text" class="form-control" name="name" value="{{$recipe->name}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Servings</label>
                        <input type="number" class="form-control text-right" value="{{$recipe->serving_count}}" min="1" name="servings" required />
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description / Instructions</label>
                            <textarea class="form-control" rows="5" name="description">{{$recipe->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 t">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Ingredient</th>
                                    <th>Brand (optional)</th>
                                    <th>Scale</th>
                                    <th>Unit</th>
                                    <th>Cost</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="tbl-ingredient">
                                @foreach($recipe->ingredients as $ingredients)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="ingredient[]" value="{{$ingredients->name}}" required >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$ingredients->brand}}" name="brand[]" >
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" step="any" value="{{$ingredients->scale}}" name="scale[]" >
                                    </td>
                                    <td>
                                        <select class="form-control" name="unit[]">
                                            <option value="g" {{$ingredients->unit == 'g' ? 'selected="selected"' : ''}}>g</option>
                                            <option value="pc" {{$ingredients->unit == 'pc' ? 'selected="selected"' : ''}}>pc</option>
                                            <option value="can" {{$ingredients->unit == 'can' ? 'selected="selected"' : ''}}>can</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" step="any" value="{{$ingredients->cost}}" name="cost[]" >
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-rm"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right">
                                        <button type="button" class="btn btn-primary btn-sm btn-add"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-secondary" type="submit" href="{{route('recipe.view', $recipe->id)}}">Cancel</a>
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="{{asset('js/create.js?'.time())}}"></script>
@endsection