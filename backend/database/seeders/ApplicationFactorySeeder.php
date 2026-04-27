<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For each user, create applications
        User::all()->each(function ($user) {
            Application::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
