<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use Intervention\Image\Facades\Image;


class RecipesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $recipes = Recipe::whereIn('user_id', $users)->orWhere('user_id', auth()->user()->id)->with('user')->latest()->paginate();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();
        $recipeIngredients = [
            []
        ];
        return view('recipes.create', compact('ingredients', 'recipeIngredients'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'instructions' => '',
            'image' => ['required','image'],
        ]);
        $imagePath = request('image')->store('uploads', 'public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        $recipe = auth()->user()->recipes()->create([
            'name' => $data['name'],
            'instructions' => $data['instructions'],
            'image' => $imagePath,
        ]);
        $count = request('count');
        for($i=1; $i <= $count; $i+=1){
            //dd(request('sel_'.$i));
            if(request('sel_'.$i)!=null){
                $recipe->ingredients()->attach(request('sel_'.$i),
                ['quantity' => request('q_'.$i)]);
            }
        }
        /*foreach (request()->recipeIngredients as $ingredient){
            $recipe->ingredients()->attach($ingredient['ingredient_id'],
            ['quantity' => $ingredient['quantity']]);
        }*/
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->ingredients->delete();
        $recipe->delete();
        return redirect('/profile/' . auth()->user()->id);
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        $ingredients = Ingredient::all();
        return view('recipes.edit', compact('recipe'), compact('ingredients'));
    }

    public function update(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $data = request()->validate([
            'name' => 'required',
            'instructions' => '',
            'image' => 'image',
        ]);

        
        if (request('image'))
        {
            $imagePath = request('image')->store('uploads', 'public');
            
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $recipe->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/' . auth()->user()->id);
    }


    public function ajax(Request $request){
        return(response()->json(['result'=>$request->file]));
    }

}
