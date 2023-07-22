<?php

use App\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 10 dummy users
        for ($i = 0; $i < 10; $i++) {
            Task::create([
                'title' => $faker->title,
                'due_date' => $faker->due_date,
                'priority' => $faker->priority,
                'description' => $faker->description,
            ]);
        }
    }
}
