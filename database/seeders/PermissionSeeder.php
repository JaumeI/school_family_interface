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
        Permission::create(['name' =>  'manage_users', 'menu_entry' => true, 'menu_name' => 'Usuaris']);
        Permission::create(['name' =>  'manage_students','menu_entry' => true, 'menu_name' => 'Alumnes']);
        Permission::create(['name' =>  'manage_groups','menu_entry' => true, 'menu_name' => 'Grups']);
        Permission::create(['name' =>  'manage_permissions',]);

        //tutor permissions
        Permission::create(['name' =>  'manage_tags',]);
        Permission::create(['name' =>  'upload_images','menu_entry' => true, 'menu_name' => 'Imatges']);

        //mixed permissions
        Permission::create(['name' =>  'see_images','menu_entry' => true, 'menu_name' => 'Àlbums']);
        Permission::create(['name' =>  'start_message_thread',]);
        Permission::create(['name' =>  'send_message','menu_entry' => true, 'menu_name' => 'Missatges']);
    }
}
