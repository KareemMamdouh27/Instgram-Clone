@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>

        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class="pr-3">
                    <img src="/storage/{{ $post->user->profile->image }}" class="w-100 rounded-circle" style="max-width: 40px">
                </div>
                
                <div>
                    <div class="font-weight-bold">
                        <a href="/profile/{{ $post->user->id }}" class="text-dark">{{ $post->user->username }}</a>
                        <a href="#" class="pl-3">Follow</a>
                    </div>
                </div>
            </div>

            <hr>

            <h6 class="">Created At: {{ $post->created_at }}</h6>
            <p>{{ $post->caption }}</p>
            <div>
                <a class="font-weight-bold text-dark" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}: </a>{{ $post->caption }}
            </div>

            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <span class="float-right ml-2">
                    <form action="/p/{{$post->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="/p"><button class="btn btn-danger form-control pr-3 ">Delete</button></a>
                    </form>
                </span>
                <span class="float-right">
                    <a href="/p/{{$post->id}}/edit" class="btn btn-outline-primary">
                        Edit
                    </a>
                </span>
            @endif
        </div>
    </div>
</div>
@endsection
