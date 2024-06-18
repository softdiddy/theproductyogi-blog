@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 postbox">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
        </div>
        <div class="col-md-12 post-wraper">
            @foreach ($posts as $post)
            <a style="color:#000;" href="{{ route('posts.show', $post) }}"><div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $post->user->name }}</h5>
                <p>{{ $post->title }}</p>
                <h6 class="card-subtitle mb-2 text-muted"><i>{{ $post->created_at }}</i></h6>
                <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
               @if($post->user_id == auth()->user()->id)
               
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                <a  href="{{ route('posts.edit', $post) }}" style="color:green;" class="card-link">Edit</a>
                
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:red; background: none;border: none;" class="card-link">Delete</button>
                </form>
            
                @endif
            </div>
        </div></a>
            @endforeach
        </div>
    </div>
</div>
@endsection
