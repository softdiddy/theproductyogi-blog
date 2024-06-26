@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Post</div>

                <div class="card-body">
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="body" name="body" rows="5">{{ $post->body }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
