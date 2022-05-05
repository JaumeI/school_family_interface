<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['name' => '1er A']);
        Group::create(['name' => '2on A',]);
        Group::create(['name' => 'Aula taller']);
        Group::create(['name' => 'Extraescolar Robòtica',]);
        Group::create(['name' => '3er']);
        Group::create(['name' => '4rt',]);
        Group::create(['name' => '5è A']);
        Group::create(['name' => '6è C',]);
    }
}
