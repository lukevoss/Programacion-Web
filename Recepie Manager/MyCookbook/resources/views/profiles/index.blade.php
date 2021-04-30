@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-3">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 p-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->name }}</div>
                    <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                </div>

            @can('update', $user->profile)
                <a href="/p/create">Add New Recipe</a>
            @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-5"> <strong>{{ $recipeCount }}</strong> recipes</div>
                <div class="pr-5"> <strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"> <strong>{{ $followingCount }}</strong> following</div>
            </div>
        </div>
    </div>

    <div class="row pt-4">
        @foreach ($user->recipes as $recipe)
        <div class="col-4 pb-4">
            <a href="/p/{{ $recipe->id }}">
                <img src="/storage/{{ $recipe->image }}" alt="" class="w-100">
            </a>
        </div> 
        @endforeach
        
    
    </div>
</div>
@endsection
