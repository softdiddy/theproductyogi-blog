<?php


namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_user_creation()
    {
        // Attempt to create a user with invalid data
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'not-matching'
        ]);

        // Assert validation errors
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function it_creates_a_user_successfully()
    {
        // Create a user with valid data
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // Assert user is stored in the database
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com'
        ]);

        // Assert the response is a redirect (assuming redirect after registration)
        $response->assertRedirect('/home');
    }

    /** @test */
    public function it_prevents_duplicate_users()
    {
        // Create a user
        User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => Hash::make('password123')
        ]);

        // Attempt to create another user with the same email
        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // Assert validation error for duplicate email
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_hashes_passwords_before_saving()
    {
        // Create a user with valid data
        $response = $this->post('/register', [
            'name' => 'Jake Doe',
            'email' => 'jakedoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        // Retrieve the user from the database
        $user = User::where('email', 'jakedoe@example.com')->first();

        // Assert the password is hashed
        $this->assertTrue(Hash::check('password123', $user->password));
    }
}
