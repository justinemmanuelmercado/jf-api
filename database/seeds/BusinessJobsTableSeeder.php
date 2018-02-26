<?php

use Illuminate\Database\Seeder;
use App\BusinessJob;

class BusinessJobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        //
        for ($i = 0; $i < 100; $i++) {
            BusinessJob::create([
                'business_id' => $faker->numberBetween(25, 50),
                'job_title' => $faker->jobTitle,
                'description' => $faker->realText(1000) 
                ]);
        }
    }
}
