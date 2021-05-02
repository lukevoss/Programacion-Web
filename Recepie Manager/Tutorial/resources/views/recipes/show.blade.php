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
                
                <h4><strong>{{ $recipe->name }}</strong></h4>
                <p>{!! nl2br($recipe->instructions) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
