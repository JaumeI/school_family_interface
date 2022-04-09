<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
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

        //Create Admin user
        $admin = User::create([
            'name' =>  'admin',
            'email' => env('ADMIN_MAIL','admin@mail.com'),
            'email_verified_at' => now(),
            'password' => Hash::make(env('ADMIN_PASSWORD','password')), // password
            'remember_token' => Str::random(10),
        ]);

        //Add Admin permissions
        $admin_permissions = array();
        $admin_permissions[] = Permission::where('name', 'manage_users')->first()->id;
        $admin_permissions[] = Permission::where('name', 'manage_students')->first()->id;
        $admin_permissions[] = Permission::where('name', 'manage_groups')->first()->id;
        $admin_permissions[] = Permission::where('name', 'manage_permissions')->first()->id;
        $admin->permissions()->attach($admin_permissions);

        //If this is a demo, we create some example users
        echo env('APP_DEMO');
        if(strtolower(env('APP_DEMO', 'true'))==1 ){
            //Create demo tutor users
            $tutor1 = User::create([
                'name' =>  'tutor1',
                'email' => 'tutor1@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            $tutor2 = User::create([
                'name' =>  'tutor2',
                'email' => 'tutor2@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            //Create demo family users
            $family1 = User::create([
                'name' =>  'family1',
                'email' => 'family1@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            $family2 = User::create([
                'name' =>  'family2',
                'email' => 'family2@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ]);

            //Family permissions
            $permissions = array();
            $permissions[] = Permission::where('name', 'see_images')->first()->id;
            $permissions[] = Permission::where('name', 'start_message_thread')->first()->id;
            $permissions[] = Permission::where('name', 'send_message')->first()->id;
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
