<?php

use Illuminate\Database\Seeder;
use App\BusinessJobRequirement;

class BusinessJobsRequirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayOfSkills = ['PHP', 'WordPress', 'JavaScript', 'Python',
        'Ruby On Rails', 'AngularJS', 'Angular 5', 'React',
        'VueJS', 'NodeJs', 'C', 'C#', 'C++', 'Visual Studio', 
        'IOS Development', 'Android Development', 'DevOps', 'Web Development', 'Mobile Development'];
        for ($id = 1; $id < 101; $id++) {
            $faker1 = \Faker\Factory::create();
            $noOfSkills = $faker1->numberBetween(3, count($arrayOfSkills));
            for($j = 0; $j < $noOfSkills; $j++){
                $faker2 = \Faker\Factory::create();
                BusinessJobRequirement::create([
                    'job_id' => $id,
                    'requirement' => $arrayOfSkills[$faker2->unique()->numberBetween(0, count($arrayOfSkills) - 1)],
                    'years_exp' => $faker2->numberBetween(0, 6)
                    ]);
            }
        }
    }
}
