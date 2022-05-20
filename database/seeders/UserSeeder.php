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
        $admin->permissions()->attach(Permission::all('id'));

        //If this is a demo, we create some example config
        if(strtolower(env('APP_DEMO', 'true'))==true){

            //We add all groups and students to the admin
            $admin->groups()->attach(Group::all('id'));
            $admin->students()->attach(Student::all('id'));



            //Create demo family users
            for($i=1;$i<=5;$i++)
            {
                $family = User::create([
                    'name' =>  'family'.$i,
                    'email' => 'family'.$i.'@mail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('p4ssword'), // password
                    'remember_token' => Str::random(10),
                ]);
                $family->students()->attach(Student::inRandomOrder()->limit(rand(1,3))->get('id'));
                $family->permissions()->attach(Permission::where('code', 'see_images')->orWhere('code', 'messages')->get('id'));
            }

            //Create demo tutor users
            for($i=1;$i<=5;$i++)
            {
                $tutor = User::create([
                    'name' =>  'tutor'.$i,
                    'email' => 'tutor'.$i.'@mail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'), // password
                    'remember_token' => Str::random(10),
                ]);
                $tutor->groups()->attach(Group::inRandomOrder()->limit(rand(1,4))->get('id'));
                $tutor->permissions()->attach(Permission::where('code', 'see_images')
                    ->orWhere('code', 'messages')
                    ->orWhere('code', 'manage_tags')
                    ->orWhere('code', 'upload_images')
                    ->get('id'));
            }
        }


    }
}
