<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the specific Test User for the Reviewer
        $user = User::factory()->create([
            'name' => 'TEST USER',
            'email' => 'test@example.com',
            'password' => Hash::make('testpass123'),
        ]);

        $statuses = ['To Do', 'In Progress', 'Done'];

        // 2. Loop to create 18 random projects
        for ($i = 1; $i <= 18; $i++) {
            $project = Project::create([
                'user_id' => $user->id,
                // Generates a random, professional-sounding project name
                'name' => fake()->catchPhrase() . ' System', 
                // Randomizes the creation/update dates so the "Recent" table sorting is tested
                'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);

            $taskTitles = [
            'Update API documentation', 'Fix navigation styling bug', 'Optimize database queries',
            'Review pull request', 'Write PHPUnit tests', 'Deploy to staging server',
            'Update NPM dependencies', 'Configure CI/CD pipeline', 'Design database schema',
            'Implement OAuth login', 'Refactor controller logic', 'Setup caching system'
        ];

        // 4. For each project, create between 2 and 7 random tasks
        for ($i = 1; $i <= 18; $i++) {
            $project = Project::create([
                'user_id' => $user->id,
                'name' => fake()->catchPhrase() . ' System', 
                'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);

            $taskCount = rand(2, 7);
            for ($j = 0; $j < $taskCount; $j++) {
                Task::create([
                    'project_id' => $project->id,
                    'title' => $taskTitles[array_rand($taskTitles)], // Picks a realistic English IT task
                    'description' => fake()->boolean(70) ? fake()->realText(150) : null, // 150 chars of real English text
                    'status' => $statuses[array_rand($statuses)],
                    'due_date' => fake()->boolean(50) ? fake()->dateTimeBetween('now', '+1 month') : null,
                ]);
            }
        }
        }
    }
}