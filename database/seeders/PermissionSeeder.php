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
        Permission::create([
            'name' =>  'manage_users',
            'public_name' => 'Usuaris',
            ]);
        Permission::create([
            'name' =>  'manage_students',
            'public_name' => 'Alumnes',
            ]);
        Permission::create([
            'name' =>  'manage_groups',
            'public_name' => 'Grups',
            ]);
        Permission::create([
            'name' =>  'manage_permissions',
            'public_name' => 'Permisos',
            ]);
        Permission::create([
            'name' =>  'manage_tags',
            'public_name' => 'Etiquetes',
            ]);
        Permission::create([
            'name' =>  'upload_images',
            'public_name' => 'Pujar Imatges',
            ]);
        Permission::create([
            'name' =>  'see_images',
            'public_name' => 'Veure Imatges',
            ]);
        Permission::create([
            'name' =>  'edit_images',
            'public_name' => 'Editar Imatges',
        ]);
        Permission::create([
            'name' =>  'messages',
            'public_name' => 'Missatges',
            ]);
    }
}
