@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="height: 230px">
        <div class="col-3">
            <img src="../photos/profile.jpg" class="rounded-circle p-5 h-25" alt="" srcset="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <a href="/p/create">Add New Post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> Posts</div>
                <div class="pr-5"><strong>23k</strong> Followers</div>
                <div class="pr-5"><strong>212</strong> Following</div>
            </div>
            <div class="pt-3"><strong>{{ $user->profile->title }}</strong></div>
            <p> {{ $user->profile->description }} </p>
            <div><a href={{ $user->profile->url }}>Facebook.com/kareem.kimooz27</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
                <img src="/storage/{{ $post->image }}" class="w-100">
                <p>{{ $post->caption }}</p>
            </div>
        @endforeach
    </div>

</div>
@endsection
