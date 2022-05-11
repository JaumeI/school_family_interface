<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create Admin user. All permissions, access to all groups and students.
        $admin = User::create([
            'name' =>  'admin',
            'email' => env('ADMIN_MAIL','admin@mail.com'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('ADMIN_PASSWORD','password')), // password
            'remember_token' => Str::random(10),
        ]);

        //Add all permissions
        $permissions = array();
        foreach (Permission::all() as $permission)
        {
            $permissions[] = $permission->id;
        }
        $admin->permissions()->attach($permissions);

        //If this is a demo, we create some example config
        if(strtolower(env('APP_DEMO', 'true'))==true){
            $groups = array();
            //admin has access to all groups
            foreach (Group::all() as $group)
            {
                $groups[] = $group->id;
            }
            $admin->groups()->attach($groups);

            $students = array();
            //admin has access to all  students
            foreach (Student::all() as $student)
            {
                $students[] = $student->id;
            }
            $admin->students()->attach($students);

            //Create demo tutor users
            // Tutor1
            $tutor1 = User::create([
                'name' =>  'tutor1',
                'email' => 'tutor1@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            $groups = array();
            $g1 = Group::inRandomOrder()->first()->id;
            do
            {
                $g2 = Group::inRandomOrder()->first()->id;
            }while($g2==$g1);
            $groups[] = $g1;
            $groups[] = $g2;
            $tutor1->groups()->attach($groups);

            // Tutor 2
            $tutor2 = User::create([
                'name' =>  'tutor2',
                'email' => 'tutor2@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);
            $groups = array();
            $g1 = Group::inRandomOrder()->first()->id;
            do
            {
                $g2 = Group::inRandomOrder()->first()->id;
            }while($g2==$g1);
            $groups[] = $g1;
            $groups[] = $g2;
            $tutor2->groups()->attach($groups);

            //Create demo family users
            $family1 = User::create([
                'name' =>  'family1',
                'email' => 'family1@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);
            // Family1 has two students
            $f1_students = array();

            $s1 = Student::inRandomOrder()->first()->id;
            do
            {
                $s2 = Student::inRandomOrder()->first()->id;
            }while($s2==$s1);
            $f1students[] = $s1;
            $f1students[] = $s2;
            $family1->students()->attach($f1_students);


            $family2 = User::create([
                'name' =>  'family2',
                'email' => 'family2@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);
            //Family 2 has 1 student
            $family2->students()->attach(Student::inRandomOrder()->first()->id);

            //Permissions for demo users
            $permissions = array();
            $permissions[] = Permission::where('name', 'see_images')->first()->id;
            $permissions[] = Permission::where('name', 'messages')->first()->id;
            $family1->permissions()->attach($permissions);
            $family2->permissions()->attach($permissions);

            //Tutors have same permissions as families and:
            $permissions[] = Permission::where('name', 'manage_tags')->first()->id;
            $permissions[] = Permission::where('name', 'upload_images')->first()->id;
            $tutor1->permissions()->attach($permissions);
            $tutor2->permissions()->attach($permissions);

        }


    }
}
