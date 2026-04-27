<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserFactorySeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user (for login)
        User::create([
            'name' => 'Abhi Patel',
            'email' => 'abhi@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create random users
        User::factory(10)->create();
    }
}
