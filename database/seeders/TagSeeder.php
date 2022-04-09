<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Nadal']);
        Tag::create(['name' => 'Curs 20/21']);
        Tag::create(['name' => 'Curs 21/22']);
        Tag::create(['name' => 'Mallorca', 'description' => 'Viatge final de curs 20/21']);
        Tag::create(['name' => 'Castanyada']);
        Tag::create(['name' => 'Carnestoltes']);
        Tag::create(['name' => 'Manualitats','description' => 'Treballs realitzats a plàstica']);
    }
}
