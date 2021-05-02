@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Recipe</h1>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Recipe Name</label>
    
                    
                    <input id="name" 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name"
                            value="{{ old('name') }}" 
                            required autocomplete="name" autofocus>
    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="form-group row">
                    <label for="instructions" class="col-md-4 col-form-label">Instructions:</label>
    
                    
                    <textarea name="instructions" 
                                id="instructions" 
                                cols="30" 
                                rows="10"
                                class="form-control @error('instructions') is-invalid @enderror"
                                required autocomplete="name" autofocus></textarea>
    
                    @error('instructions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="row">
                    <label for="ingredient" class="col-md-4 col-form-label">Add Ingredient</label>
                    <label for="quantity" class="col-md-4 col-form-label">Quantity</label>
                    <label for="measurements" class="col-md-4 col-form-label">Measurement</label>
                </div>

                <div class="form-group row">
                    <div class="dropdown">
                        <select class="browser-default custom-select" name="ingredient">
                            @foreach ($ingredients as $ingredient)
                                <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="text" name="quantity" id="">

                    <div class="dropdown">
                        <select class="browser-default custom-select" name="measurement">
                            <option value="gr">gr</option>
                            <option value="ml">ml</option>
                            <option value="unit">unit</option>
                            <option value="Tbsp">Tbsp</option>
                            <option value="tsp">tsp</option>
                        </select>
                    </div>


    
                    @error('ingredients')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

            

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Recipe Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">

                    @error('image')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Recipe</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
