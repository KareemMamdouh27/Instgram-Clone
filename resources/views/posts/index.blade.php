@extends('layouts.app')

@section('content')
<div class="container">

    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="container border-dark align-items-center text-center">
            <span> </span>
            <input type="text" name="text" placeholder="Whats on your mind ?" class="form-control">
            <div class="mt-3">
                <input type="file" name="file" class="form-control-file" >
                <input type="submit" value="Post" class="btn btn-primary">
            </div>
        </div>
    </form>

    <hr class="mb-5 mt-5">

    @foreach ($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="/p/{{ $post->id }}"><img src="/storage/{{ $post->image }}" class="w-100"></a>
            </div>
        </div>
        <div class="row pb-5 pt-2">
            <div class="col-6 offset-3">
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
            </div>
            
        </div>
    @endforeach


</div>
@endsection
