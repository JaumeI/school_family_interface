<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();
        foreach ($students as $student)
        {
            $groups = Array();
            $g1 = Group::inRandomOrder()->first()->id;
            do
            {
                $g2 = Group::inRandomOrder()->first()->id;
            }while($g2==$g1);
            $groups[] = $g1;
            $groups[] = $g2;

            $student->groups()->attach($groups);

        }

    }
}
