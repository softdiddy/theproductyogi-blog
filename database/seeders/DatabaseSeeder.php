<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create user
        User::create([
            'name' => 'Mohammed Lawal Abubakar',
            'email' => 'softdiddy@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'), // Hash the password
        ]);

        User::create([
            'name' => 'Amina Abubakar',
            'email' => 'tata@gmail.com',
            'role' => 'user',
            'password' => Hash::make('12345678'), // Hash the password
        ]);

        //create user post
        $adminUser = User::where('email', 'softdiddy@gmail.com')->first();
        $regularUser = User::where('email', 'tata@gmail.com')->first();

        Post::create([
            'user_id' => $adminUser->id,
            'title' => 'First Admin Post',
            'body' => 'This is the body of the first admin post.',
        ]);

        Post::create([
            'user_id' => $regularUser->id,
            'title' => 'First User Post',
            'body' => 'This is the body of the first user post.',
        ]);
    }
}
