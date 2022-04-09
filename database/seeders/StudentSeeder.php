<?php

namespace Database\Seeders;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create(['name' => 'student1']);
        Student::create(['name' => 'student2']);
        Student::create(['name' => 'student3']);
        Student::create(['name' => 'student4']);
        Student::create(['name' => 'student5']);
        Student::create(['name' => 'student6']);
        Student::create(['name' => 'student7']);
        Student::create(['name' => 'student8']);
        Student::create(['name' => 'student9']);
    }
}
