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
                    <div class="h4 ">{{ $user->name }}</div>
                    <div class="pr-0">
                        @if ($user->id != Auth::user()->id)
                        <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                        @endif
                    </div>
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
                    <figure class="rounded bg-white shadow-sm">
                        <img src="/storage/{{ $recipe->image }}" alt="" class="w-100 card-img-top">
                        <figcaption class="p-4 card-img-bottom">
                          <h2 class="h5 font-weight-bold mb-2 font-italic"><span class="text-dark">{{ $recipe->name }}</span></h2>
                        </figcaption>
                      </figure>
                </a>
            </div>
        @endforeach
    
    </div>
</div>
@endsection
