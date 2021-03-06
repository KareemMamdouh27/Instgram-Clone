<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postsCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();
        return view('profiles.index', compact('user','follows' , 'postsCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url'   => 'required|url',
            'image' => 'image',
        ]);

        if( request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(\public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $user->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/'. auth()->user()->id);   
    }
}
