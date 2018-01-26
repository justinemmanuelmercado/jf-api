<?php

use Illuminate\Database\Seeder;
use App\BusinessAdditionalData;

class BusinessAdditionalDataSeeder extends Seeder
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
            BusinessAdditionalData::create([
                'user_id' => $faker->unique()->numberBetween(26, 50),
                'business_name' => $faker->company,
                'description' => $faker->realText(1000) 
                ]);
        }
    }
}
