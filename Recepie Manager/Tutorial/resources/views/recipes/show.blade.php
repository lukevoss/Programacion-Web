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
                    <div class="pl-5">
                        @if ($recipe->user->id == Auth::user()->id)  
                            <form action="/p/{{$recipe->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-primary ml-4" type="submit">Delete Post</button>               
                            </form>       
                        @endif
                    </div>
                </div>

                <hr>
                
                <div class="d-flex align-items-center">
                    <div class="pr-5">
                        <h4><strong>{{ $recipe->name }}</strong></h4>
                    </div>
                    
                    @if ($recipe->user->id == Auth::user()->id)
                    <div class="pl-5">  
                        <a href="/p/{{$recipe->id}}/edit">
                            <button class="btn btn-primary ml-4" type="submit">Edit Post</button>               
                        </a>
                    </div>       
                    @endif
                </div>
               
                <p>{!! nl2br($recipe->instructions) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
