<?php

use Illuminate\Database\Seeder;
use App\ApplicantAdditionalData;

class ApplicantAdditionalDataSeeder extends Seeder
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
        for ($i = 0; $i < 25; $i++) {
            ApplicantAdditionalData::create([
                'user_id' => $faker->unique()->numberBetween(1, 25),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'resume_path' => '',
                'date_of_birth' => $faker->dateTimeThisCentury->format('Y-m-d') 
                ]);
        }
    }
}
