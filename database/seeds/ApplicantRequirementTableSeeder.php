<?php

use Illuminate\Database\Seeder;
use App\ApplicantRequirement;

class ApplicantRequirementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($id = 1; $id < 26; $id++){
            $faker1 = \Faker\Factory::create();
            $arrayOfSkills = ['PHP', 'WordPress', 'JavaScript', 'Python',
            'Ruby On Rails', 'AngularJS', 'Angular 5', 'React',
            'VueJS', 'NodeJs', 'C', 'C#', 'C++', 'Visual Studio', 
            'IOS Development', 'Android Development', 'DevOps', 'Web Development', 'Mobile Development'];
            $noOfSkills = $faker1->numberBetween(3, count($arrayOfSkills));
            for($j = 0; $j < $noOfSkills; $j++){
                $faker2 = \Faker\Factory::create();
                $randInd = $faker2->unique()->numberBetween(0, count($arrayOfSkills) - 1);
                ApplicantRequirement::create([
                    'applicant_id' => $id,
                    'skill' => $arrayOfSkills[$randInd],
                    'years_exp' => $faker2->numberBetween(0, 10)
                    ]);
                unset($arrayOfSkills[$randInd]);
                $arrayOfSkills = array_values($arrayOfSkills);
            }
        }
    }
}
