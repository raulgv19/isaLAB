<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminRole = $this->createRole(['role_name' => User::ROLE_ADMIN]);
        $this->clientRole = $this->createRole(['role_name' => User::ROLE_SOCIO]);

    }

    /**
     * Test unauthenticated users cannot access view
     *
     * @return void
    */
    public function testUnauthenticatedUsersCannotAccessView()
    {
        $this->assertGuest();

        $response = $this->get('/admin/users');
        $response->assertRedirect('/login');
        $response->assertSeeText('Redirecting to'.' '.URL::to('/login'));
    }

    /**
     * Test client users cannot access view
     *
     * @return void
    */
    public function testClientUsersCannotAccessView()
    {
        $this->signInUserAsRole($this->clientRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('/admin/users');
        $response->assertRedirect('/');
        $response->assertSeeText('Redirecting to'.' '.URL::to('/'));
    }

    /**
     * Test admin users can access view
     *
     * @return void
    */
    public function testAdminUsersCannotAccessView()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->get('/admin/users');
        $response->assertViewIs('admin.users.index');
    }

    /**
     * Test Admin User can access edit user
     *
     * @return void
    */
    public function testAdminUsersCanAccessEditUser()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $user = $this->createUser();

        $response = $this->get('admin/users/'.$user->id.'/edit');
        $response->assertViewIs('admin.users.edit');
    }

    /**
     * Test Admin User can update user
     *
     * @return void
    */
    public function testAdminUsersCanUpdateUser()
    {
        $this->signInUserAsRole($this->adminRole);
        $this->assertAuthenticatedAs($this->user);

        $user = $this->createUser();

        $userData = ([
            'name' => 'newName',
            'email' => 'newmail@test.com',
        ]);

        $user->update($userData);
        $user = $user->fresh();

        $this->assertEquals($user->name, $userData['name']);
        $this->assertEquals($user->email, $userData['email']);
    }

}
