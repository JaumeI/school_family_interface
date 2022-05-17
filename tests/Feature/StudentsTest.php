<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Student;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class StudentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_list_page_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_students']);

        $this->actingAs($user)
            ->get(route('students'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_students']);

        Student::create(['name' => 'Primer alumne']);

        $this->actingAs($user)
            ->get(route('students'))
            ->assertStatus(200)
            ->assertSee('Primer alumne');
    }

    public function test_can_store_student(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_students']);

        $this->actingAs($user)
            ->post(route('students.store'), [
                'name' => 'Segon alumne'
            ])
            ->assertRedirect(route('students'));

        $this->assertDatabaseCount('students', 1);

        $this->assertDatabaseHas('students', [
            'name' => 'Segon alumne'
        ]);
    }

    // edit
    public function test_can_edit_student(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_students']);

        $student = Student::create(['name' => 'Primer alumne']);

        $this->actingAs($user)
            ->post(route('students.store'),[
                'id' => $student->id,
                'name' => 'Alumne Modificat'
            ])
            ->assertRedirect(route('students'));

        $this->assertDatabaseCount('students', 1);

        $this->assertDatabaseHas('students', [
            'name' => 'Alumne Modificat'
        ]);

    }

    public function test_can_delete_student(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['manage_students']);

        $student = Student::create(['name' => 'Primer alumne']);
        Student::create(['name' => 'Segon alumne']);

        $group = Group::create(['name' => 'grupete']);

        $student->groups()->attach($group->id);



        $this->actingAs($user)
            ->delete(route('students.destroy', $student))
            ->assertRedirect(route('students'));

        $this->assertSoftDeleted('students',['id' => $student->id]);
        $this->assertdatabaseHas('students', ['name' => 'Segon alumne']);
    }
}
