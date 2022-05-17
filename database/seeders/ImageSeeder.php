<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\User;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=1;$i<=11;$i++)
        {
            do{
                $user = User::inRandomOrder()->first();
            }while(!$user->hasPermissionTo('upload_images'));

            $randstudents = Student::inRandomOrder()->limit(rand(1,5))->get('id');
            $randtags = Tag::inRandomOrder()->limit(rand(1,5))->get('id');

            $image = Image::create([
                'path' => 'storage/images/studentimages//202205/',
                'name' => $i.'.jpg',
                'uploader_id' => $user->id,
            ]);

            $image->students()->attach($randstudents);
            $image->tags()->attach($randtags);

        }

    }
}
