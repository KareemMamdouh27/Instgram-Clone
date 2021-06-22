<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); 
        $posts = Post::whereIn('user_id', $users)->with('user')->OrderBy('created_at', 'DESC')->get();

        return view ('posts.index' , compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => '',
            'caption' => 'required',
            'image'   => 'required|image',
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(\public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image'   => $imagePath,
        ]);

        return redirect('/profile/'. auth()->user()->id);   

    }

    public function show(\App\Models\Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        return view('posts.edit')
            ->with('post', Post::where('id', $id)->first());
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'caption' => 'required',
            'image'   => 'required|image'
        ]);

        $post->update($data);
        
        if( request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(\public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $post->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/'. auth()->user()->id);

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/')
            ->with('message','Your post has been deleted');
    }
}
