<?php

namespace Tests;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();

        Model::unguard();
    }

    protected function createUserWithPermissions(array $userData = [], array $permissions = []): User
    {
        $user = User::factory()->create($userData);

        $user->permissions()->attach(
            collect($permissions)->map(
                fn(string $code) => Permission::create(['code' => $code, 'name' => Str::random(5)])->id
            )->toArray()
        );

        return $user;
    }
}
