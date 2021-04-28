@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-3">
            <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 p-3">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->name }}</h1>
            @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
            @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-5"> <strong>{{ $user->posts->count()}}</strong> recipes</div>
                <div class="pr-5"> <strong>23k</strong> followers</div>
                <div class="pr-5"> <strong>212</strong> following</div>
            </div>
        </div>
    </div>

    <div class="row pt-4">
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" alt="" class="w-100">
            </a>
        </div> 
        @endforeach
        
    
    </div>
</div>
@endsection
