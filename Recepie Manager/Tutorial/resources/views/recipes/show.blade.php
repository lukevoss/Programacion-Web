@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $recipe->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $recipe->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$recipe->user->id}}">
                                <span class="text-dark">{{ $recipe->user->name}}</span>
                            </a>
                            @if ($recipe->user->id != Auth::user()->id)         
                                <a href="#" class="pl-3">Follow</a>
                            @endif
                        </div>
                    </div>
                    
                </div>

                <hr>
                
                <div class="d-flex align-items-center">
                    <div class="col-8 pl-0">
                        <h4><strong>{{ $recipe->name }}</strong></h4>
                    </div>
                    
                    @if ($recipe->user->id == Auth::user()->id)
                    <div class="col-4 pr-1">  
                        <a href="/p/{{$recipe->id}}/edit">
                            <button class="btn btn-primary ml-5" type="submit" id="editRecipe"><i class="fa fa-edit fa-lg "></i></button>               
                        </a>
                    </div>       
                    @endif
                </div>
               
                <p>{!! nl2br($recipe->instructions) !!}</p>

                    <div class="card shadow border-0 mb-2">
                        <div class="card-body p-4">
                            <h5 class="h5 mb-1"><strong>Ingredient-List</strong></h5>
                            <ul class="list-group">
                                @foreach ($recipe->ingredients as $ingredient)
                                <li class="list-group-item rounded-0">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="customCheck1" type="checkbox">
                                        <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck1">
                                            <td>{{ $ingredient->name }}</td>
                                            <td>{{ $ingredient->pivot->quantity.' '.$ingredient->measurement }}</td>
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
    
            </div>
        </div>
    </div>
</div>
@endsection
