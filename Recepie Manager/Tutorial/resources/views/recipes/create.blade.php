@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        @php
        $NIng = 2;
        $ids = array();
        $names = array();
        $measurements = array();
        foreach ($ingredients as $ingredient) {
            array_push($ids, $ingredient->id);
            array_push($names, $ingredient->name);
            array_push($measurements, $ingredient->measurement);
        }
        $ids_encoded = json_encode($ids);
        $names_encoded = json_encode($names);
        $measurements_encoded = json_encode($measurements);
        @endphp
        <input type="hidden" id="h_NIng" value="{{$NIng}}">
        <input type="hidden" id="h_id" value="{{$ids_encoded}}">
        <input type="hidden" id="h_name" value="{{$names_encoded}}">
        <input type="hidden" id="h_measurement" value="{{$measurements_encoded}}">

        <input type="hidden" name="count" id="count" value="{{$NIng}}">
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
                                value="{{ old('instructions') }}"
                                class="form-control @error('instructions') is-invalid @enderror"
                                required autocomplete="name" autofocus></textarea>
    
                    @error('instructions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="ingredients" class="col-md-4 col-form-label">Ingredients:</label>
                    <div class="container">
                        <div class="card rounded-1 border-1 ">
                            <div class="card-body p-2">
                                
                                <!--  Bootstrap table-->
                                <div class="table-responsive">
                                    <table class="table" name="ingredients">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Ingredient</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <div class="dropdown">
                                                        <select class="browser-default custom-select" name="sel_1" id="sel_1">
                                                            @foreach ($ingredients as $ingredient)
                                                                <option value="{{$ingredient->id}}">{{$ingredient->name}} - measured in {{$ingredient->measurement}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <input type="number" name="q_1" id="q_1">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <input type="hidden" name="count" id="count" value="1">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Add rows button-->
                                <a class="btn btn-primary rounded-0 btn-block" id="insertRow" href="#!" onclick="">Add new row</a>
                            </div>
                        </div>
                    </div>
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

