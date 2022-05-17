<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagsTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_show_list_page_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_tags']);

        $this->actingAs($user)
            ->get(route('tags'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_tags']);

        Tag::create(['name' => 'Primer tag']);

        $this->actingAs($user)
            ->get(route('tags'))
            ->assertStatus(200)
            ->assertSee('Primer tag');
    }

    public function test_can_store_tag(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_tags']);

        $this->actingAs($user)
            ->post(route('tags.store'), [
                'name' => 'Segon tag'
            ])
            ->assertRedirect(route('tags'));

        $this->assertDatabaseCount('tags', 1);

        $this->assertDatabaseHas('tags', [
            'name' => 'Segon tag'
        ]);
    }

    // edit
    public function test_can_edit_tag(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_tags']);

        $tag = Tag::create(['name' => 'Primer tag']);

        $this->actingAs($user)
            ->post(route('tags.store'),[
                'id' => $tag->id,
                'name' => 'Tag Modificat'
            ])
            ->assertRedirect(route('tags'));

        $this->assertDatabaseCount('tags', 1);

        $this->assertDatabaseHas('tags', [
            'name' => 'Tag Modificat'
        ]);

    }

    public function test_can_delete_tag(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_tags']);

        $tag = Tag::create(['name' => 'Primer tag']);
        Tag::create(['name' => 'Segon tag']);

        $image = Image::create(['path' => 'enero', 'name' => 'cosas.jpg', 'uploader_id' => 99]);

        $tag->images()->attach($image->id);

        $this->actingAs($user)
            ->delete(route('tags.destroy', $tag))
            ->assertRedirect(route('tags'));

        $this->assertDatabaseCount('tags', 1);

        $this->assertDatabaseMissing('tags', ['name' => 'Primer tag']);
        $this->assertDatabaseMissing('image_tag', ['image_id' => $image->id, 'tag_id' => $tag->id]);
        $this->assertdatabaseHas('tags', ['name' => 'Segon tag']);
    }
}
