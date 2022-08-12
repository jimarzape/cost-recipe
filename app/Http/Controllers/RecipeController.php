<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Materials;
use App\Models\Ingredients;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['_recipe'] = Recipe::orderBy('name')->paginate(20);
        return view('recipe', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe                 = new Recipe;
        $recipe->name           = $request->name;
        $recipe->description    = $request->description;
        $recipe->serving_count  = $request->servings;
        $recipe->srp            = $request->srp;
        $recipe->save();
        $total_cost = 0;
        if($request->has('ingredient'))
        {
            $ingredients = $request->ingredient;
            $brand = $request->brand;
            $scale = $request->scale;
            $unit = $request->unit;
            $cost = $request->cost;
            foreach($ingredients as $key => $ingredient)
            {
                $ing = new Ingredients;
                $ing->recipe_id = $recipe->id;
                $ing->name = $ingredient;
                $ing->brand = $brand[$key];
                $ing->cost = $cost[$key];
                $ing->scale = $scale[$key];
                $ing->unit = $unit[$key];
                $ing->save();

                $total_cost += $cost[$key];
            }
        }

        $recipe->total_cost = $total_cost;
        $recipe->save(); 
        

        return redirect()->to(route('recipe'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['recipe'] = Recipe::where('id', $id)->with('ingredients')->first();
        return view('view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['recipe'] = Recipe::where('id', $id)->with('ingredients')->first();
        return view('edit', $data);
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
        $recipe                 = new Recipe;
        $recipe->exists         = true;
        $recipe->id             = $id;
        $recipe->name           = $request->name;
        $recipe->description    = $request->description;
        $recipe->serving_count  = $request->servings;
        $recipe->srp            = $request->srp;
        $recipe->save();
        $total_cost = 0;

        if($request->has('ingredient'))
        {
            Ingredients::where('recipe_id', $id)->delete();
            $ingredients = $request->ingredient;
            $brand = $request->brand;
            $scale = $request->scale;
            $unit = $request->unit;
            $cost = $request->cost;
            foreach($ingredients as $key => $ingredient)
            {
                $ing = new Ingredients;
                $ing->recipe_id = $recipe->id;
                $ing->name = $ingredient;
                $ing->brand = $brand[$key];
                $ing->cost = $cost[$key];
                $ing->scale = $scale[$key];
                $ing->unit = $unit[$key];
                $ing->save();
                $total_cost += $cost[$key];
            }
        }

        $recipe->total_cost = $total_cost;
        $recipe->save(); 
        

        return redirect()->to(route('recipe'));
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
