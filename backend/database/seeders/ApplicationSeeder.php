<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Application::insert([
            [
                'company_name' => 'Google',
                'job_title' => 'Backend Engineer',
                'status' => 'applied',
                'applied_date' => now()->subDays(10),
                'notes' => 'Applied via careers page',
                'job_link' => 'https://careers.google.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'Amazon',
                'job_title' => 'Software Engineer',
                'status' => 'interview',
                'applied_date' => now()->subDays(7),
                'notes' => 'Recruiter reached out',
                'job_link' => 'https://amazon.jobs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'Meta',
                'job_title' => 'Full Stack Developer',
                'status' => 'rejected',
                'applied_date' => now()->subDays(15),
                'notes' => 'Did not pass screening',
                'job_link' => 'https://metacareers.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
