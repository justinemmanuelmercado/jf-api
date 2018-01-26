<?php

use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 25; $i++) {
            $type = $faker->randomNumber(2);
            if($type % 2 === 0){
                $type_final = 1;
            } else {
                $type_final = 2;            
            }
            User::create([
                'email' => $faker->unique()->email,
                'password' => '1',
                'type' => 2
                ]);
        }
    }
}
