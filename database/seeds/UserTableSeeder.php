<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            $type = $faker->randomNumber(2);
            if($type % 2 === 0){
                $type_final = 1;
            } else {
                $type_final = 2;            
            }
            User::create([
                'email' => $faker->unique()->email,
                'password' => '$2y$10$W41Z.GsEeW5b/Qm1OzUtQOhuGCPl2nZJLXt6tiB0CrEwvb5vOw1sa',
                'type' => 1
                ]);
        }
        for ($i = 0; $i < 25; $i++) {
            $type = $faker->randomNumber(2);
            if($type % 2 === 0){
                $type_final = 1;
            } else {
                $type_final = 2;            
            }
            User::create([
                'email' => $faker->unique()->email,
                'password' => '$2y$10$W41Z.GsEeW5b/Qm1OzUtQOhuGCPl2nZJLXt6tiB0CrEwvb5vOw1sa',
                'type' => 2
                ]);
        }
    }
}
