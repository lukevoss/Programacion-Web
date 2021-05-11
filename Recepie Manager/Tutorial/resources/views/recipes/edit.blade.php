@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-8 offset-2">
        <div class="row">
            <div class= "col-11 pl-0">
                <h1>Edit Recipe</h1>
            </div>
            <div class="col-1 "> 
                <form action="/p/{{$recipe->id}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" name="delete" id="delete"><i class="fa fa-trash fa-2x"></i></button>               
                </form>       
            </div>
        </div>
    </div>
    
    <form action="/p/{{$recipe->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">

                

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Recipe Name</label>
    
                    
                    <input id="name" 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name"
                            value="{{ $recipe->name }}" 
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
                                required autocomplete="name" autofocus>{{ $recipe->instructions }}</textarea>
    
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
                                                        <select class="browser-default custom-select" name="ingredient">
                                                            @foreach ($ingredients as $ingredient)
                                                                <option value="{{$ingredient->id}}">{{$ingredient->name}} - measured in {{$ingredient->measurement}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> 
                                                </td>
                                                <td>
                                                    <input type="number" name="quantity" id="">
                                                </td>
                                                <td></td>
                                            </tr>
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
                    <button class="btn btn-primary" name="update" id="update">Update Recipe</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@php
$ids = array();
foreach ($ingredients as $ingredient) {
    array_push($ids, $ingredient->id);
}
@endphp
<script>var ids = <?php echo json_encode($ids); ?>;</script>
<script>var names = <?php echo json_encode($ids); ?>;</script>
<script>var measurements = <?php echo json_encode($ids); ?>;</script>
