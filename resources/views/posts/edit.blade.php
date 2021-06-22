@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p/{{ $post->id }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    Edit Post
                </div>
                <div class="row">
                    <input type="text" name="caption" class="form-control" placeholder="" value="{{ old('caption') ?? $post->caption }}">
                    <input type="hidden" value="{{ $post->id }}" value="PUT">
					<input type="file" name="image" value="" class="form-control-file mt-3">
					<input type="submit" value="Submit" class="btn btn-primary mt-3">
                </div>
            </div>
            
        </div>
    </form>
</div>
@endsection
