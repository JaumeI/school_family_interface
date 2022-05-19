<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Image;
use App\Models\Student;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ImagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_list_page_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['see_images']);

        $this->actingAs($user)
            ->get(route('images'))
            ->assertStatus(200);
    }
    public function test_can_show_list_page_as_editor_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['edit_images']);

        $this->actingAs($user)
            ->get(route('images'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['see_images']);


        $student = Student::create(['name' => 'alumne']);

        $user->students()->attach($student->id);

        $image = Image::create(['path' => 'cami', 'name' => 'coses.jpg', 'uploader_id' => 99]);
        $image->students()->attach($student->id);

        $this->actingAs($user)
            ->get(route('images'))
            ->assertStatus(200)
            ->assertSee('coses.jpg');
    }

    public function test_can_show_list_pageas_editor(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['edit_images', 'see_images']);

        $image = Image::create(['path' => 'cami', 'name' => 'coses.jpg', 'uploader_id' => 99]);

        $this->actingAs($user)
            ->get(route('images'))
            ->assertStatus(200)
            ->assertSee('coses.jpg');
    }

    public function test_can_store_image(): void
    {
        //Storage::fake('public');
        //Storage::disk('public')->makeDirectory('images/studentimages');

        $user = $this->createUserWithPermissions(permissions: ['upload_images', 'edit_images']);

        $this->actingAs($user)
            ->post(route('images.store'), [
                'id' => 1,
                'image' => UploadedFile::fake()->image('alumnes.jpg'),
            ])
            ->assertRedirect(route('images'));

        //$this->assertCount(1, Storage::disk('public')->allFiles('images/studentimages/'.now()->format('Ym')));

       $this->assertDatabaseCount('images', 1);

        $this->assertDatabaseHas('images', [
            'path' => 'storage/images/studentimages/'.now()->format('Ym').'/'
        ]);
    }

    // edit
    public function test_can_edit_image(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['edit_images']);
        $image = Image::create(['path' => 'enero', 'name' => 'cosas.jpg', 'uploader_id' => 99]);
        $tag = Tag::create(['name' => 'Primer tag']);
        $tag2 = Tag::create(['name' => 'Segon tag']);
        $student = Student::create(['name' => 'alumne']);
        $student2 = Student::create(['name' => 'alumne2']);

        $image->students()->attach($student->id);
        $image->tags()->attach($tag->id);

        $this->assertDatabaseHas('image_student', [
            'image_id' => $image->id,
            'student_id' => $student->id,
        ]);

        $this->assertDatabaseHas('image_tag', [
            'image_id' => $image->id,
            'tag_id' => $tag->id,
        ]);

        $this->actingAs($user)
            ->post(route('images.store'),[
                'id' => $image->id,
                'destination_students' => $student2->id,
                'destination_tags' => $tag2->id,
            ])
            ->assertRedirect(route('images'));


        $this->assertDatabaseHas('image_student', [
            'image_id' => $image->id,
            'student_id' => $student2->id,
        ]);

       $this->assertDatabaseHas('image_tag', [
            'image_id' => $image->id,
            'tag_id' => $tag2->id,
        ]);

        $this->assertdatabaseMissing('image_student', [
            'image_id' => $image->id,
            'student_id' => $student->id,
        ]);

       $this->assertdatabaseMissing('image_tag', [
            'image_id' => $image->id,
            'tag_id' => $tag->id,
        ]);

    }

    public function test_can_delete_image(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['edit_images']);

        $tag = Tag::create(['name' => 'Primer tag']);
        Tag::create(['name' => 'Segon tag']);

        $image = Image::create(['path' => 'enero', 'name' => 'cosas.jpg', 'uploader_id' => 99]);

        $tag->images()->attach($image->id);

        $this->actingAs($user)
            ->delete(route('images.destroy', $image))
            ->assertRedirect(route('images'));

        $this->assertDatabaseCount('images', 0);

    }
}
