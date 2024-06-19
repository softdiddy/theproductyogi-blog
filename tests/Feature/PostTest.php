<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_post_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/posts', [
            'title' => '',
            'body' => '',
        ]);

        $response->assertSessionHasErrors(['title', 'body']);
    }

    /** @test */
    public function it_creates_a_post_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/posts', [
            'title' => 'A valid title',
            'body' => 'A valid body content',
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'A valid title',
            'body' => 'A valid body content',
        ]);

        $response->assertRedirect(route('posts.index'));
    }

    /** @test */
    public function it_prevents_duplicate_post_titles()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Post::create([
            'title' => 'Unique title',
            'body' => 'Post body content',
            'user_id' => $user->id,
        ]);

        $response = $this->post('/posts', [
            'title' => 'Unique title',
            'body' => 'Another post body content',
        ]);

        $response->assertSessionHasErrors(['title']);
    }

}
