<?php

namespace Tests\Feature;

use App\Models\Student;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class GroupsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_list_page_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_groups']);

        $this->actingAs($user)
            ->get(route('groups'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_groups']);

        Group::create(['name' => 'Primer grup']);

        $this->actingAs($user)
            ->get(route('groups'))
            ->assertStatus(200)
            ->assertSee('Primer grup');
    }

    public function test_can_store_group(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_groups']);

        $this->actingAs($user)
            ->post(route('groups.store'), [
                'name' => 'Segon group'
            ])
            ->assertRedirect(route('groups'));

        $this->assertDatabaseCount('groups', 1);

        $this->assertDatabaseHas('groups', [
            'name' => 'Segon group'
        ]);
    }

    // edit
    public function test_can_edit_group(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_groups']);

        $group = Group::create(['name' => 'Primer group']);

        $this->actingAs($user)
            ->post(route('groups.store'),[
                'id' => $group->id,
                'name' => 'Group Modificat'
            ])
            ->assertRedirect(route('groups'));

        $this->assertDatabaseCount('groups', 1);

        $this->assertDatabaseHas('groups', [
            'name' => 'Group Modificat'
        ]);

    }

    public function test_can_delete_group(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_groups']);

        $group = Group::create(['name' => 'Primer grup']);
        Group::create(['name' => 'Segon grup']);

        $student = Student::create(['name' => 'juanjose']);

        $group->students()->attach($student->id);



        $this->actingAs($user)
            ->delete(route('groups.destroy', $group))
            ->assertRedirect(route('groups'));

        $this->assertSoftDeleted('groups',['id' => $group->id]);
        $this->assertdatabaseHas('groups', ['name' => 'Segon grup']);
    }
}
