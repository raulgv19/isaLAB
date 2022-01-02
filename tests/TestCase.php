<?php

namespace Tests;

use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInUserAsRole($role = null){
        $user = User::factory()->create();
        $this->user = $user;
        $this->role = $role;

        $this->user->roles()->attach($this->role);
        DB::table('role_user')->insert(['role_id'=> $this->role->id, 'user_id' => $this->user->id]);

        $this->actingAs($this->user);
        
        return $this;
    }

    function createUser($attributes = []){
        return User::factory()->create($attributes);
    }
    function createActivity($attributes = []){
        return Activity::factory()->create($attributes);
    }
    function createRole($attributes = []){
        return Role::factory()->create($attributes);
    }

    function assignRole($user, $role){
        $user->roles()->attach($role);
        DB::table('role_user')->insert(['role_id'=> $role->id, 'user_id' => $user->id]);
    }
}
