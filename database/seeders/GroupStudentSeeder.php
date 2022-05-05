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
            $groups[] = Group::inRandomOrder()->limit(1)->first()->id;
            $groups[] = Group::inRandomOrder()->limit(1)->first()->id;
            $student->groups()->attach($groups);
        }

    }
}
