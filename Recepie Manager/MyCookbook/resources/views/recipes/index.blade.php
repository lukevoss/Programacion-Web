@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ( $recipes as $recipe)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/{{ $recipe->id }}">
                    <img src="/storage/{{ $recipe->image }}" class="w-100">
                </a>
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-6 offset-3">
                <div>
                    <div class="d-flex align-items-center pb-3">
                        <div class="pr-3">
                            <img src="{{ $recipe->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px;">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="/profile/{{$recipe->user->id}}">
                                    <span class="text-dark">{{ $recipe->user->name}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p>{{ $recipe->caption }}</p>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $recipes->links() }}
        </div>
    </div>
</div>
@endsection


