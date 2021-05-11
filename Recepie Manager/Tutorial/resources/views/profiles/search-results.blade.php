@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search Results:</h2>
    <p>{{ $users->count() }} result(s) for {{ request()->input('search')}}</p>

  
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li></li>
            @endforeach
        </ul>
    </div>
    @endif


    @foreach ($users as $user)
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 100px;">
                        </div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$user->id}}">
                                <span class="text-dark">{{ $user->name}}</span>
                            </a>
                        </div>
                        <div class="pl-5">
                            @if (!(auth()->user()->following->contains($user->id)))  
                                <td>
                                    <!--<a href="#" class="pl-3">Follow</a>-->
                                    <follow-button user-id="{{$user->id}}" follows="{{ (auth()->user()->following->contains($user->id)) }}"></follow-button>
                                </td>       
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection