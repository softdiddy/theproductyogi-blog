<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_post_creation()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate logging in as the user
        $this->actingAs($user);

        // Attempt to create a post with invalid data
        $response = $this->post('/posts', [
            'title' => '',
            'body' => '',
        ]);

        // Assert validation errors
        $response->assertSessionHasErrors(['title', 'body']);
    }

    /** @test */
    public function it_creates_a_post_successfully()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate logging in as the user
        $this->actingAs($user);

        // Create a post with valid data
        $response = $this->post('/posts', [
            'title' => 'A valid title',
            'body' => 'A valid body content',
        ]);

        // Assert post is stored in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'A valid title',
            'body' => 'A valid body content',
        ]);

        // Assert the response is a redirect to posts index
        $response->assertRedirect(route('posts.index'));
    }

    /** @test */
    public function it_prevents_duplicate_post_titles()
    {
        // Create a user
        $user = User::factory()->create();

        // Simulate logging in as the user
        $this->actingAs($user);

        // Create a post
        Post::create([
            'title' => 'Unique title',
            'body' => 'Post body content',
            'user_id' => $user->id,
        ]);

        // Attempt to create another post with the same title
        $response = $this->post('/posts', [
            'title' => 'Unique title',
            'body' => 'Another post body content',
        ]);

        // Assert validation error for duplicate title
        $response->assertSessionHasErrors(['title']);
    }

/** @test */
public function it_updates_a_post_successfully()
{
    // Create a user
    $user = User::factory()->create();

    // Create a post
    $post = Post::create([
        'title' => 'Old title',
        'body' => 'Old body content',
        'user_id' => $user->id,
    ]);

    // Ensure post is created
    $this->assertNotNull($post);

    // Simulate logging in as the user
    $this->actingAs($user);

    // Update the post with valid data
    $response = $this->put('/posts/' . $post->id, [
        'title' => 'Updated title',
        'body' => 'Updated body content',
    ]);

    // Refresh post instance to get updated data
    $post->refresh();

    // Assert the post is updated in the database
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated title',
        'body' => 'Updated body content',
    ]);

    // Assert the response is a redirect (assuming redirect after update)
    $response->assertRedirect(route('posts.index'));
}


/** @test */
public function it_deletes_a_post_successfully()
{
    // Create a user
    $user = User::factory()->create();

    // Create a post
    $post = Post::create([
        'title' => 'Post title',
        'body' => 'Post body content',
        'user_id' => $user->id,
    ]);

    // Ensure post is created
    $this->assertNotNull($post);

    // Simulate logging in as the user
    $this->actingAs($user);

    // Delete the post
    $response = $this->delete('/posts/' . $post->id);

    // Assert the post is deleted from the database
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);

    // Assert the response is a redirect (assuming redirect after deletion)
    $response->assertRedirect(route('posts.index'));
}

}
