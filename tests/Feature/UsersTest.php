<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Permission;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_list_page_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_users']);

        $this->actingAs($user)
            ->get(route('users'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_users']);



        $this->actingAs($user)
            ->get(route('users'))
            ->assertStatus(200)
            ->assertSee($user->name);
    }

    public function test_can_store_user(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_users']);

        $this->actingAs($user)
            ->post(route('users.store'), [
                'name' => 'Segon usuari',
                'email' => 'asdas@ddkk.com',
                'password' => 'password',
            ])
            ->assertRedirect(route('users'));

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', [
            'name' => 'Segon usuari'
        ]);

    }

    // edit
    public function test_can_edit_user(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_users']);

        $user2 = User::create([
            'name' => 'Segon usuari',
            'email' => 'asdas@ddkk.com',
            'password' => 'password',
        ]);

        $this->actingAs($user)
            ->post(route('users.store'),[
                'id' => $user2->id,
                'name' => 'Usuari Modificat',
                'email' => 'asdas@ddkk.com',
            ])
            ->assertRedirect(route('users'));

        $this->assertDatabaseCount('users', 2);

        $this->assertDatabaseHas('users', [
            'name' => 'Usuari Modificat'
        ]);

    }

    public function test_can_delete_user(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_users']);

        $user2 = User::create([
            'name' => 'Segon usuari',
            'email' => 'asdas@ddkk.com',
            'password' => 'password',
        ]);

        $group = Group::create(['name'=>'grup']);
        $student = Student::create(['name' => 'student']);

        $user2->groups()->attach($group->id);
        $user2->students()->attach($student->id);
        $user2->permissions()->attach(Permission::all('id'));



        $this->actingAs($user)
            ->delete(route('users.destroy', $user2))
            ->assertRedirect(route('users'));

        $this->assertSoftDeleted('users',['id' => $user2->id]);
        $this->assertdatabaseHas('users', ['name' => 'Segon usuari']);
    }
}
