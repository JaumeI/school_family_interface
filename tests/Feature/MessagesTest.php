<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Message;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class MessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_list_when_empty(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['messages']);

        $this->actingAs($user)
            ->get(route('messages'))
            ->assertStatus(200);
    }

    public function test_can_show_list_page(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['messages']);
        $userDest = User::factory()->create();

        Message::create([
            'content' => 'Lorem Ipsum',
            'user_from' => $user->id,
            'user_to' => $userDest->id,
        ]);

        $this->actingAs($user)
            ->get(route('messages'))
            ->assertStatus(200)
            ->assertSee($userDest->name);
    }

    public function test_can_store_new_message(): void
    {
        $user = $this->createUserWithPermissions(permissions: ['messages']);
        $userDest = User::factory()->create();

        $this->actingAs($user)
            ->post(route('messages.store'), [
                'content' => 'Lorem Ipsum',
                'otherid' => $userDest->id,
            ])->assertRedirect();

        $this->assertDatabaseCount('messages', 1);

        $this->assertDatabaseHas('messages', [
            'content' => 'Lorem Ipsum',
            'user_from' => $user->id,
            'user_to' => $userDest->id,
        ]);
    }
}
