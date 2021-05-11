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
        return view('recipes.create', compact('ingredients'));
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
        auth()->user()->recipes()->create([
            'name' => $data['name'],
            'instructions' => $data['instructions'],
            'image' => $imagePath,
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function destroy(Recipe $recipe)
    {
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

}
