@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 post-wraper">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <p>By {{ $post->user->name }}</p>
                    <p>{{ $post->body }}</p>

                    <h4>Comments</h4>
                    @foreach ($post->comments as $comment)
                        <div class="card mt-3">
                            <div class="card-body">
                                <p>{{ $comment->body }}</p>
                                <p>By {{ $comment->user->name }}</p>
                            </div>
                        </div>
                    @endforeach

                    @auth
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-3">
                            @csrf

                            <div class="form-group">
                                <label for="body">Comment</label>
                                <textarea class="form-control" id="body" name="body" rows="3">{{ old('body') }}</textarea>
                                @error('body')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
