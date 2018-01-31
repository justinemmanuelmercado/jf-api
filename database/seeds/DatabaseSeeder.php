<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(BusinessJobsTableSeeder::class);
        $this->call(BusinessAdditionalDataSeeder::class);
        $this->call(BusinessJobsRequirementTableSeeder::class);
        $this->call(ApplicantAdditionalDataSeeder::class);
        $this->call(ApplicantRequirementTableSeeder::class);

    }
}
