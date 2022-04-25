<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
/**
 * @mixin \Eloquent
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //admin permissions
        Permission::create(['name' =>  'manage_users']);
        Permission::create(['name' =>  'manage_students']);
        Permission::create(['name' =>  'manage_groups']);
        Permission::create(['name' =>  'manage_permissions']);

        //tutor permissions
        Permission::create(['name' =>  'manage_tags',]);
        Permission::create(['name' =>  'upload_images']);

        //mixed permissions
        Permission::create(['name' =>  'see_images']);
        Permission::create(['name' =>  'start_thread']);
        Permission::create(['name' =>  'messages']);
    }
}
