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
            'code' =>  'manage_users',
            'name' => 'Usuaris',
            ]);
        Permission::create([
            'code' =>  'manage_students',
            'name' => 'Alumnes',
            ]);
        Permission::create([
            'code' =>  'manage_groups',
            'name' => 'Grups',
            ]);
        Permission::create([
            'code' =>  'manage_permissions',
            'name' => 'Permisos',
            ]);
        Permission::create([
            'code' =>  'manage_tags',
            'name' => 'Etiquetes',
            ]);
        Permission::create([
            'code' =>  'upload_images',
            'name' => 'Pujar Imatges',
            ]);
        Permission::create([
            'code' =>  'see_images',
            'name' => 'Veure Imatges',
            ]);
        Permission::create([
            'code' =>  'edit_images',
            'name' => 'Editar Imatges',
        ]);
        Permission::create([
            'code' =>  'messages',
            'name' => 'Missatges',
            ]);
    }
}
