@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="height: 230px">
        <div class="col-3">
            <a href="/storage/{{ $user->profile->image }}" alt="" srcset=""><img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100"></a>
        </div>
        
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a> 
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postsCount }}</strong> Posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> Followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> Following</div>
            </div>
            <div class="pt-3"><strong>{{ $user->profile->title }}</strong></div>
            <p> {{ $user->profile->description }} </p>
            <div><a href={{ $user->profile->url }}>Facebook.com/kareem.kimooz27</a></div>
            <hr>
        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}"> 
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
            </div>
        @endforeach
    </div>


</div>

@endsection
