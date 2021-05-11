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
        dd(request());
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
        foreach (request()->recipeIngredients as $ingredient){
            $recipe->ingredients()->attach($ingredient['ingredient_id'],
            ['quantity' => $ingredient['quantity']]);
        }
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function ajax(Request $request){
        return(response()->json(['result'=>$request->file]));
    }
}
