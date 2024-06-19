<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
{
    $query = Post::query();

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('body', 'like', '%' . $request->search . '%');
    }

    $posts = $query->latest()->get();

    return view('posts.index', compact('posts'));
}

    public function create()
    {
        return view('posts.create');
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|unique:posts|max:255',
    //         'body' => 'required',
    //     ]);

    //     // Retrieve the authenticated user
    //     $user = Auth::user();

    //     // Create a new post associated with the authenticated user
    //     $post = new Post([
    //         'title' => $validatedData['title'],
    //         'body' => $validatedData['body'],
    //     ]);

    //     // Associate the post with the user
    //     $user->posts()->save($post);

    //     return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    // }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'body' => 'required',
    ]);

    // Retrieve the authenticated user
    $user = Auth::user();

    // Create a new post associated with the authenticated user
    $post = new Post([
        'title' => $validatedData['title'],
        'body' => $validatedData['body'],
        'user_id' => $user->id,
    ]);

    // Save the post
    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // public function update(Request $request, Post $post)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|unique:posts,title,' . $post->id . '|max:255',
    //         'body' => 'required',
    //     ]);

    //     $post->update($validatedData);

    //     return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    // }


    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id . '|max:255',
            'body' => 'required',
        ]);
    
        $post->update($validatedData);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
    
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
